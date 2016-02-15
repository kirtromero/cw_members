<?php namespace App\Http\Controllers;

use \Theme;
use Volrac\YppContent\Models\Tag;
use Volrac\YppContent\Models\Site;
use Input;

class TagController extends YppController
{
	public function index()
	{
		$network = $this->network;

		$theme = $network->theme;

		$theme = check_for_tour_theme($theme);

		Theme::setActive($theme);

		$data = $this->data;

		$tags = Tag::ofNetwork($network->id)->mostUsedInNetwork($network->id)->paginate( config('yppmembers.per_page') );

		$ids = array(0);
		foreach($tags as $tag)
		{
			$tag_data = $tag->getTopThumb($ids, $this->network->id);

			$tag->top_thumb = $tag_data['thumb'];
			$ids[] = $tag_data['id'];
		}

		$data['page_title'] = $this->network->name.' Tags';

		$data['tags'] = $tags;

		$this->breadcrumbs->addCrumb('Popular Tags');

		return Theme::view('tag.index', $data);
	}

	public function site($domain)
	{

		$site = Site::where('domain','=',$domain)->first();

		if(!$site)
		{
			return redirect('/');
		}

		$theme = $site->theme != '' ? $site->theme : $this->network->theme;

		$theme = check_for_tour_theme($theme);

		Theme::setActive($theme);

		$data = $this->data;

		$tags = Tag::ofSite($site->id)->mostUsedInSite($site->id)->published()->paginate( config('yppmembers.per_page') );

		$ids = array(0);
		foreach($tags as $tag)
		{
			$tag_data = $tag->getTopThumb($ids, $this->network->id);

			$tag->top_thumb = $tag_data['thumb'];
			$ids[] = $tag_data['id'];
		}

		$data['page_title'] = $site->name.' Tags';

		$data['tags'] = $tags;

		$this->breadcrumbs->addCrumb('Popular Tags', url('tags'));
		$this->breadcrumbs->addCrumb($site->name.' Tags');

		$data['piwik_tracker_ids'] = config('yppmembers.use_piwik') && $site->piwik_id != 0 ? array_merge($data['piwik_tracker_ids'],[$site->piwik_id]) : $data['piwik_tracker_ids'];

		return Theme::view('tag.index', $data);
	}

	public function contents($tag_id = 0, $slug = '')
	{

		$network = $this->network;

		$theme = $network->theme;

		$theme = check_for_tour_theme($theme);

		Theme::setActive($theme);

		$data = $this->data;

		$tags = Tag::ofNetwork($network->id)->mostUsedInNetwork($network->id)->get();

		$ids = array(0);
		foreach($tags as $item)
		{
			$tag_data = $item->getTopThumb($ids, $this->network->id);

	        $item->top_thumb = $tag_data['thumb'];
	        $ids[] = $tag_data['id'];
		}

		$data['tags'] = $tags;

		$tag = Tag::find($tag_id);

		if($tag)
		{
			if(Input::has('o')){
				$order = Input::get('o');
				switch ($order) {
					case 'v':
					$orderBy = "fake_views";
					$sortName = "Most Viewed";
					break;
					case 'r':
					$orderBy = "rating";
					$sortName = "Top Rated";
					break;
					case 'f':
					$orderBy = "favorites";
					$sortName = "Most Popular";
					break;
					default:
					$orderBy = "id";
					$sortName = "Newest";
					break;
				}

			} else {
				$order = "";
				$orderBy = "id";
				$sortName = "Newest";
			}

			$contents = $tag->contents()->ofNetwork($this->network->id)->published()->orderBy($orderBy,'desc')->paginate( config('yppmembers.per_page') );

			$data['tag'] = $tag;
			$data['page_title'] = $tag->name.' Contents';
			$data['contents'] = $contents;

			$data['sortname'] = $sortName;

			$this->breadcrumbs->addCrumb('Popular Tags', url('tags'));
			$this->breadcrumbs->addCrumb($tag->name.' Contents');

			return Theme::view('tag.contents', $data);
		}

	}

}
