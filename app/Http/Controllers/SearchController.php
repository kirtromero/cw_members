<?php namespace App\Http\Controllers;

use Volrac\YppContent\Models\Content;
use Volrac\YppContent\Models\Model;
use Volrac\YppContent\Models\Tag;
use \Theme;
use \Carbon\Carbon;
use \Request;
use App\Jobs\UpdateSearchKeywords;

class SearchController extends YppController
{
	public function index($keywords = '')
	{
		if(Request::input('q','') != '')
		{
			return redirect('search/'.Request::input('q'));
		}

		$network = $this->network;

		$theme = $network->theme;

		$theme = check_for_tour_theme($theme);

		Theme::setActive($theme);

		$data = $this->data;

		$data['show_filter'] = true;

		$data['page_title'] = 'Search Results for "'.$keywords.'" in '.$network->name;

		$contents = Content::ofNetwork($this->network->id)->published()->search($keywords);

		if(\Request::input('site_id','') != '')
		{
			$contents->ofSite(\Request::input('site_id'));
		}

		if(\Request::input('type','') != '')
		{
			$contents->hasType(\Request::input('type'));
			$data['show_filter'] = false;
		}

		$data['contents'] = $contents->paginate( config('yppmembers.per_page') );

		$this->breadcrumbs->addCrumb($data['page_title']);

		return Theme::view('search.contents',$data);

	}

	public function xhrSearch(Request $request)
	{
		$q = Request::input('q', '');

		$q = strip_tags(str_replace("'"," ",$q));

		$response = [];

		if (!empty($q))
		{
			$contents = Content::ofNetwork($this->network->id)->published()->search($q)->paginate(10);
			$models = Model::ofNetwork($this->network->id)->where('name', 'LIKE', "%$q%")->paginate(10);
			$tags = Tag::ofNetwork($this->network->id)->where('name', 'LIKE', "%$q%")->paginate(10);

			$items = $contents->merge($models)->merge($tags);

			foreach( $items as $item )
			{
				$response[] = [
					'title' => $item->getAttribute('title') ? $item->title : $item->name,
					'url' => $item->link,
					'thumb' => $item->thumb,
					'type' => class_basename(get_class($item))
				];
			}

			$this->dispatch(new UpdateSearchKeywords($q));
		}

		return \Response::json($response);
	}
}
