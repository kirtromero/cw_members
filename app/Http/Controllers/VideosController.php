<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Volrac\YppContent\Models\Content;
use Volrac\YppContent\Models\Dvd;
use Volrac\YppContent\Models\Favorite;
use Volrac\YppContent\Models\Tag;
use Volrac\YppContent\Facades\YppContent;
use Volrac\YppContent\Models\Dvdseries;
use Input;
use \Theme;

class VideosController extends YppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

		$data['page_title'] = $network->name;

		$data['sliders'] = Content::ofNetwork($this->network->id)->published()->featured(1)->take(config('yppmembers.homepage_sliders'))->orderBy(\DB::raw("RAND()"))->get();

		$data['contents'] = Content::ofNetwork($this->network->id)->published()->featured(0)->take(config('yppmembers.homepage_contents'))->orderBy($orderBy,'desc')->paginate( config('yppmembers.per_page')  );

		$data['mostviews'] = Content::ofNetwork($this->network->id)->published()->featured(0)->take(config('yppmembers.homepage_mostviews'))->orderBy('views','desc')->get();

		$data['toprateds'] = Content::ofNetwork($this->network->id)->published()->featured(0)->take(config('yppmembers.homepage_toprateds'))->orderBy('rating','desc')->get();

		$data['most_used_tags'] = Tag::ofNetwork($this->network->id)->mostUsedInNetwork($this->network->id)->take(config('yppmembers.homepage_most_used_tags'))->get();

		$data['dvds'] = Dvd::ofNetwork($this->network->id)->take(config('yppmembers.homepage_dvds'))->orderBy('publish_date','desc')->get();

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

		return Theme::view('video.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
