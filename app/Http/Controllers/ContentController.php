<?php namespace App\Http\Controllers;

use Volrac\YppContent\Models\Content;
use Volrac\YppContent\Models\Site;
use Volrac\YppContent\Models\File;
use Volrac\YppContent\Models\Rating;
use Volrac\YppContent\Models\Comment;
use Volrac\YppContent\Models\Download;
use Volrac\YppContent\Models\Favorite;
use Volrac\YppContent\Models\Playlist;
use App\Jobs\UpdateViewCount;
use App\Jobs\UpdateRatingCount;
use \Carbon\Carbon;
use \Theme;

class ContentController extends YppController
{
	// Display Contents
	public function view($id, $slug = '')
	{
		$network = $this->network;

		$data = $this->data;

		$content = Content::find($id);

		if(!$content)
		{
			return redirect('/');
		}

		$job = new UpdateViewCount($id);
        $this->dispatch($job);

		$site = $content->sites()->ofNetwork($network->id)->first();
		$theme = $site->theme != '' ? $site->theme : $network->theme;

		$theme = check_for_tour_theme($theme);

		Theme::setActive($theme);

		$data['page_title'] = $content->title;
		$data['content'] = $content;
		$data['photos'] = $content->files()->photos()->get();
		$data['videos'] = $content->files()->videos()->get();

		$data['similar'] = Content::ofNetwork($this->network->id)->similar($content)->published()->take(12)->get();

		$data['type'] = 'stream';
		$data['site'] = $site;

		$data['content_sites'] = $content->sites()->ofNetwork($network->id)->orderBy('name', 'asc')->get();
		$data['content_tags'] = $content->tags()->ofNetwork($network->id)->orderBy('name', 'asc')->get();
		$data['content_models'] = $content->models()->ofNetwork($network->id)->orderBy('name', 'asc')->get();
		$data['content_dvds'] = $content->dvds()->ofNetwork($network->id)->orderBy('title', 'asc')->get();

		$this->breadcrumbs->addCrumb('Updates', url('updates'));
		$this->breadcrumbs->addCrumb($content->title);

		$username = \Request::server('PHP_AUTH_USER', 'sampleuser');
		$data['has_rated'] = $content->ratings()->where('username',$username)->first();

		$data['is_favorite'] = $username && Favorite::ofUsername($username)->hasFavorite('Content', $content->id)->count() ? 1 : 0;

		if (\Request::input('pl')){
			$param = explode(':', \Request::input('pl'));
			if (isset($param[0]) && $param[0] == 'dvd')
			{
				$data['on_dvd'] = true;
				$dvd = $content->dvds()->find(isset($param[1]) ? $param[1] : 0);
				$data['dvd'] = $dvd;
				$data['dvd_contents'] = $dvd->contents()->get();
			}
			if (isset($param[0]) && $param[0] == 'member')
			{
				$data['on_playlist'] = true;
				$playlist = Playlist::find(isset($param[1]) ? $param[1] : 0);
				$data['playlist'] = $playlist;
				$data['playlist_contents'] = $playlist->contents()->get();
			}
		}

		$data['playlists'] = Playlist::ofUsername($username)->get();

		$data['piwik_tracker_ids'] = config('yppmembers.use_piwik') && $site->piwik_id != 0 ? array_merge($data['piwik_tracker_ids'],[$site->piwik_id]) : $data['piwik_tracker_ids'];

		return Theme::view('content.view', $data);
	}

	// Download Video
	public function download($content_id,  $file_id, $type = 'stream')
	{
		$file = File::find($file_id);

		if( !$file || !in_array($content_id, $file->content_ids) || !isset($file->$type) || $file->$type == 'null')
		{
			return redirect('/');
		}

		if(is_array($file->$type))
		{
			if (!\File::isDirectory(storage_path().'/download_content/')) {
				\File::makeDirectory(storage_path().'/download_content/',0777);
			}

			$zipfile = $file_id.".zip";
			$zip = new \ZipArchiveEx();
			$zip->open(storage_path().'/download_content/'.$zipfile, \ZIPARCHIVE::CREATE);

			foreach($file->$type as $path)
			{
				$zip->addFile($file->server_path.'/'.$type.'/'.$path, $path);
			}

			$zip->close();

			$pathToFile = storage_path().'/download_content/'.$zipfile;

			$name = $this->createFileName($content_id, $zipfile);

			$this->saveDownloadInfo( $content_id, $file_id, 'zip', $pathToFile );

			return response()->download($pathToFile,$name)->deleteFileAfterSend(true);
		}

		$pathToFile = $file->server_path.'/'.$type.'/'.$file->$type;
		$name = $this->createFileName($content_id, $file->$type, $type);

		$this->saveDownloadInfo( $content_id, $file_id, $type, $pathToFile );

		return response()->download($pathToFile,$name);
	}

	// Zip photos, send to user for download, delete zip after downloading.
	public function downloadZip($content_id, $file_id)
	{
		$file = File::find($file_id);

		if( !$file || !in_array($content_id, $file->content_ids) )
		{
			return redirect('/');
		}

		$photo_dir = $file->server_path;

		if (!\File::isDirectory(storage_path().'/download_content/')) {
			\File::makeDirectory(storage_path().'/download_content/',0777);
		}

		$zipfile = $file_id.".zip";
		$zip = new \ZipArchiveEx();
		$zip->open(storage_path().'/download_content/'.$zipfile, \ZIPARCHIVE::CREATE);

		$source = $photo_dir;
		$files = \File::files($source);

		foreach($files as $file)
		{
			$file = str_replace($source . '/', '', $file);
			$imagepath = $source."/".$file;
			$zip->addFile($imagepath, $file);
		}

		$zip->close();
		$ext = ".zip";
		$pathToFile = storage_path().'/download_content/'.$zipfile;

		$name = $this->createFileName($content_id, $zipfile);

		$this->saveDownloadInfo( $content_id, $file_id, 'zip', $pathToFile );

		return response()->download($pathToFile,$name)->deleteFileAfterSend(true);
	}

	private function saveDownloadInfo( $content_id = 0, $file_id = 0, $type = '', $pathToFile = '' ) {
		$download = new Download();
		$download->username = \Request::server('PHP_AUTH_USER', 'admin');
		$download->content_id = $content_id;
		$download->file_id = $file_id;
		$download->type = $type;
		$download->referrer = \Request::server('HTTP_REFERER', '');
		$download->file_size = filesize($pathToFile);
		$download->download_date = Carbon::now()->format('Y-m-d H:i:s');
		$download->save();
	}

	// Private function to create filenames for downloading
	private function createFileName($content_id, $orig_filename, $type = '')
	{
		$name = '';
		$content = Content::find($content_id);
		$name .= $content_id;
		$name .= '_'.str_slug($content->title);
		if($type != '')
		{
			$name .= '_'.$type;
		}

		$format = pathinfo(basename($orig_filename),PATHINFO_EXTENSION);
		$ext = '.'.$format;

		$name .= $ext;

		return $name;
	}

	public function rate()
	{
		$id = \Request::input('id',0);
		$rating = \Request::input('rating', 0);

		$content = Content::find($id);

		if($content)
		{
			if($content->ratings()->count() == 0)
			{
				$new_rating = new Rating();
	            $new_rating->content_id = $content->id;
	            $new_rating->rating = $content->rating;
	            $new_rating->save();
			}
			$avg_rating =  ($content->ratings()->sum('rating') + $rating) / ($content->ratings()->count() + 1);

			$content->rating = $avg_rating;
			$content->save();

			$job = (new UpdateRatingCount($id, $rating, \Request::server('PHP_AUTH_USER')));
        	$this->dispatch($job);
		}
	}

	public function comment()
	{
		$id = \Request::input('id', 0);
		$username = \Request::input('username', '');
		$message = \Request::input('message', '');

		$content = Content::find($id);

		if($content && $message != '')
		{
			$comment = new Comment;
			$comment->username = \Request::input('username');
			$comment->message = \Request::input('message');

			$comment->content()->associate($content);

			$comment->save();
		}

		$data['content'] = $content;

		return Theme::view('content.comments_list', $data);
	}

}
