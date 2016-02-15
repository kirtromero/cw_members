<?php namespace App\Http\Controllers;

use \Theme;
use Volrac\YppContent\Models\Site;
use Volrac\YppContent\Models\Content;
use Volrac\YppContent\Models\Tag;

class SiteController extends YppController
{
	public function index($domain = '', $type = '')
	{
		$site = Site::where('domain','=',$domain)->first();

		if(!$site)
		{
			return redirect('/');
		}

		$data = $this->data;

		$theme = $site->theme != '' ? $site->theme : $this->network->theme;

		$theme = check_for_tour_theme($theme);

		Theme::setActive($theme);

		$type_heading = 'All Updates';
		$show_filter = true;

		$contents = Content::ofSite($site->id)->published();

		$selected_nav = 'home';

		if($type != '')
		{
			$show_filter = false;
			if($type == 'photos')
			{
				$contents->hasType('photos');
				$type_heading = 'Updates with Photos';
				$selected_nav = 'photos';
			}
			else
			{
				$contents->hasType('videos');
				$type_heading = 'Updates with Videos';
				$selected_nav = 'videos';
			}
		}

		$data['type_heading'] = $type_heading;

		$data['show_filter'] = $show_filter;

		$data['page_title'] = $site->name;

		$data['contents'] = $contents->orderBy('publish_date','desc')->paginate( config('yppmembers.per_page') );

		$data['most_used_tags'] = Tag::ofSite($site->id)->mostUsedInSite($site->id)->take(14)->get();

		$data['selected_nav'] = $selected_nav;

		$data['show_network_header'] = false;

		$data['site'] = $site;

		$data['piwik_tracker_ids'] = config('yppmembers.use_piwik') && $site->piwik_id != 0 ? array_merge($data['piwik_tracker_ids'],[$site->piwik_id]) : $data['piwik_tracker_ids'];

		$this->breadcrumbs->addCrumb($site->name, url($site->domain));
		$this->breadcrumbs->addCrumb($type_heading);


		return Theme::view('site.index', $data);
	}

	public function listSites()
	{
		$network = $this->network;
		
		$data = $this->data;
		
		$theme = $network->theme;

		$theme = check_for_tour_theme($theme);
		
		Theme::setActive($theme);

		$sites = $network->sites()->withcontent()->orderBy('name','asc')->get();

		$ids = array(0);
		foreach($sites as $site)
		{
			$site_data = $site->getTopThumb($ids, $this->network->id);

	        $site->top_thumb = $site_data['thumb'];
	        $ids[] = $site_data['id'];
		}

		$data['page_title'] = 'All Sites in '.$network->name;
		$data['sites'] = $sites;

		$this->breadcrumbs->addCrumb('All Sites');

		return Theme::view('site.all', $data);
	}

}
