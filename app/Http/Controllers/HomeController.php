<?php namespace App\Http\Controllers;

use Volrac\YppContent\Models\Content;
use Volrac\YppContent\Models\Dvd;
use Volrac\YppContent\Models\Tag;
use \Theme;

class HomeController extends YppController
{
	public function index()
	{
		$network = $this->network;

		$theme = $network->theme;

		$theme = check_for_tour_theme($theme);

		Theme::setActive($theme);

		$data = $this->data;

		$data['page_title'] = $network->name;

		$data['sliders'] = Content::ofNetwork($this->network->id)->published()->featured(1)->take(config('yppmembers.homepage_sliders'))->orderBy(\DB::raw("RAND()"))->get();

		$data['contents'] = Content::ofNetwork($this->network->id)->published()->featured(0)->take(config('yppmembers.homepage_contents'))->orderBy('publish_date','desc')->get();

		$data['mostviews'] = Content::ofNetwork($this->network->id)->published()->featured(0)->take(config('yppmembers.homepage_mostviews'))->orderBy('views','desc')->get();

		$data['toprateds'] = Content::ofNetwork($this->network->id)->published()->featured(0)->take(config('yppmembers.homepage_toprateds'))->orderBy('rating','desc')->get();

		$data['most_used_tags'] = Tag::ofNetwork($this->network->id)->mostUsedInNetwork($this->network->id)->take(config('yppmembers.homepage_most_used_tags'))->get();

		$data['dvds'] = Dvd::ofNetwork($this->network->id)->take(config('yppmembers.homepage_dvds'))->orderBy('publish_date','desc')->get();

		return Theme::view('network.home',$data);

	}

}
