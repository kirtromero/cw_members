<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \Theme;
use Volrac\YppContent\Models\Dvd;
use Volrac\YppContent\Models\Favorite;
use Volrac\YppContent\Models\Tag;
use Volrac\YppContent\Facades\YppContent;
use Volrac\YppContent\Models\Dvdseries;
use Input;

class DvdsController extends YppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dvd = new Dvd;

        $network = $this->network;

        $theme = $network->theme;

        if(Input::has('o')){

            $order = Input::get('o');
            switch ($order) {
                case 'v':
                $orderBy = "views";
                $sortName = "Most Viewed";
                $dvd->ofNetwork($network->id)->orderBy($orderBy,'DESC');
                break;
                case 'r':
                $orderBy = "rating";
                $sortName = "Top Rated";
                $dvd->ofNetwork($network->id)->orderBy($orderBy,'DESC');
                break;
                case 'f':
                $orderBy = "favorites";
                $sortName = "Most Popular";
                $dvd->ofNetwork($network->id)->orderByFavorites();
                break;
                default:
                $orderBy = "publish_date";
                $sortName = "Newest";
                $dvd->ofNetwork($network->id)->orderBy($orderBy,'DESC');
                break;
            }

        } else {
            $order = "";
            $orderBy = "publish_date";
            $sortName = "Newest";
            $dvd->ofNetwork($network->id)->orderBy($orderBy,'DESC');
        }

        $theme = check_for_tour_theme($theme);

        Theme::setActive($theme);

        $data = $this->data;

        $data['page_title'] = $this->network->name.' DVDs';

        $data['dvds'] = $dvd->paginate( config('yppmembers.per_page') );
        $data['tags'] = Tag::ofNetwork($this->network->id)->ofDvds()->get();

        $data['sortname'] = $sortName;

        $this->breadcrumbs->addCrumb('DVDs');

        return Theme::view('dvd.index', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $network = $this->network;

       $theme = $network->theme;

       Theme::setActive($theme);

       $data = $this->data;

       $dvd = Dvd::find($id);

       $data['page_title'] = $dvd->title;

       $data['dvd'] = $dvd;
       $data['models'] = $dvd->models()->get();
       $data['series'] = $dvd->series()->get();

       $contents = $dvd->contents()->get();

       $data['contents'] = $contents;

       $data['similar'] = Dvd::ofNetwork($this->network->id)->similar($dvd)->take(12)->get();

       $total_pics = 0;
       $total_vids = 0;
       $total_video_duration = 0;

       foreach ( $contents as $content ) {
         if ( $content->has_photos ) {
            $total_pics += $content->photos_count;
        }
        if ( $content->has_videos ) {
            $total_vids += $content->files()->videos()->count();
            $total_video_duration += $content->files()->videos()->sum('duration');
        }
    }

    $data['total_pics'] = $total_pics;
    $data['total_vids'] = $total_vids;
    $data['total_video_duration'] = YppContent::makeSecondsToTime($total_video_duration);

    $username = \Request::server('PHP_AUTH_USER', 'sampleuser');
    $data['is_favorite'] = $username && Favorite::ofUsername($username)->hasFavorite('Dvd', $dvd->id)->count() ? 1 : 0;

    $this->breadcrumbs->addCrumb('DVD');

    return Theme::view('dvd.show', $data);
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

    public function dvdSeries($id)
    {

        if(Input::has('o')){
            $order = Input::get('o');
            switch ($order) {
                case 'v':
                $orderBy = "views";
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

        Theme::setActive($theme);

        $data = $this->data;

        $series = Dvdseries::find($id);

        $data['series'] = $series;
        $data['dvds'] = $series->dvds()->get();

        $data['page_title'] = $series->title;

        $username = \Request::server('PHP_AUTH_USER', 'sampleuser');
        $data['is_favorite'] = $username && Favorite::ofUsername($username)->hasFavorite('Dvdseries', $series->id)->count() ? 1 : 0;

        $data['tags'] = Tag::ofNetwork($this->network->id)->ofDvds()->get();
        $data['sortname'] = $sortName;

        $this->breadcrumbs->addCrumb('DVD');

        return Theme::view('dvd.series', $data);
    }

    public function dvdTags($id,$slug="")
    {
        $tag = Tag::findOrfail($id);


        $network = $this->network;

        $theme = $network->theme;

        $dvds = Dvd::ofNetwork($network->id)->ofTag($tag);
        if(Input::has('o')){

            $order = Input::get('o');
            switch ($order) {
                case 'v':
                $orderBy = "views";
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

        $theme = check_for_tour_theme($theme);

        Theme::setActive($theme);

        $data = $this->data;

        $data['dvds'] = $dvds->orderBy($orderBy, 'DESC')->paginate( config('yppmembers.per_page') );

        $data['page_title'] = $this->network->name.' DVDs';

        $data['tags'] = Tag::ofNetwork($this->network->id)->ofDvds()->get();

        $data['sortname'] = $sortName;

        $data['tag'] =  $tag;

        $this->breadcrumbs->addCrumb('DVDs');

        return Theme::view('dvd.index', $data);
    }

}
