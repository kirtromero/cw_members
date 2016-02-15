<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Theme;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Volrac\YppContent\Models\Content;
use Volrac\YppContent\Models\Dvd;
use Volrac\YppContent\Models\Favorite;
use Volrac\YppContent\Models\Tag;
use Volrac\YppContent\Facades\YppContent;
use Volrac\YppContent\Models\Dvdseries;
use Input;

class UpdateController extends YppController
{
	public function index($type = '')
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
					$orderBy = "publish_date";
					$sortName = "Newest";
					break;
			}

		} else {
			$order = "";
			$orderBy = "publish_date";
			$sortName = "Newest";
		}

		$network = $this->network;

		$theme = $network->theme;

		$theme = check_for_tour_theme($theme);

		Theme::setActive($theme);

		$data = $this->data;

		$contents = Content::ofNetwork($this->network->id)->published();

		$type_heading = 'All Updates';
		$show_filter = true;

		if($type != '')
		{
			$show_filter = false;
			if($type == 'photos')
			{
				$contents->hasType('photos');
				$type_heading = 'Updates with Photos';
			}
			else
			{
				$contents->hasType('videos');
				$type_heading = 'Updates with Videos';
			}
		}

		$data['page_title'] = $this->network->name.' Updates';

		$data['type_heading'] = $type_heading;

		$data['show_filter'] = $show_filter;

		$data['contents'] = $contents->orderBy($orderBy,'desc')->paginate( config('yppmembers.per_page') );

		$this->breadcrumbs->addCrumb($type_heading);

		$tags = Tag::ofNetwork($network->id)->mostUsedInNetwork($network->id)->paginate( config('yppmembers.per_page') );

		$ids = array(0);
		foreach($tags as $tag)
		{
			$tag_data = $tag->getTopThumb($ids, $this->network->id);

	        $tag->top_thumb = $tag_data['thumb'];
	        $ids[] = $tag_data['id'];
		}

		$data['tags'] = $tags;

		$data['sortname'] = $sortName;

		return Theme::view('update.index', $data);
	}

}
