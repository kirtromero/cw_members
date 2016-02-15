<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Volrac\YppContent\Models\Favorite;
use Volrac\YppContent\Models\Content;
use Volrac\YppContent\Models\Dvd;
use Volrac\YppContent\Models\Dvdseries;
use Volrac\YppContent\Models\Model;
use \Theme;

class FavoriteController extends YppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $network = $this->network;

	    $theme = $network->theme;

	    $theme = check_for_tour_theme($theme);

	    Theme::setActive($theme);

	    $data = $this->data;

	    $data['page_title'] = 'My Favorites';

	    $username = \Request::server('PHP_AUTH_USER', 'sampleuser');

	    $fav_content_ids = Favorite::ofUsername($username)->favorableType('Content')->lists('favorable_id');
	    $fav_contents = Content::whereIn('id', $fav_content_ids)->get();

	    $fav_dvd_ids = Favorite::ofUsername($username)->favorableType('Dvd')->lists('favorable_id');
	    $fav_dvds = Dvd::whereIn('id', $fav_dvd_ids)->get();

	    $fav_dvdseries_ids = Favorite::ofUsername($username)->favorableType('Dvdseries')->lists('favorable_id');
	    $fav_dvdseries = Dvdseries::whereIn('id', $fav_dvdseries_ids)->get();

	    $fav_models_ids = Favorite::ofUsername($username)->favorableType('Model')->lists('favorable_id');
	    $fav_models = Model::whereIn('id', $fav_models_ids)->get();

	    $favs = collect();
	    $favs = $favs->merge($fav_contents)->merge($fav_dvds)->merge($fav_models)->merge($fav_dvdseries);
	    $data['favorites'] = $favs->all();

	    $this->breadcrumbs->addCrumb('My Favorites');

	    return Theme::view('favorite.index', $data);
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
		$username = \Request::server('PHP_AUTH_USER', 'sampleuser');
	    $response = [];
	    $type = $request->input('type', '');
	    $id = $request->input('id', '');
	    $model = null;

	    switch($type)
	    {
		    case 'Content':
			    $model = Content::find($request->input('id'));
			    break;
		    case 'Dvd':
			    $model = Dvd::find($request->input('id'));
			    break;
		    case 'Dvdseries':
			    $model = Dvdseries::find($request->input('id'));
			    break;
		    case 'Model':
			    $model = Model::find($request->input('id'));
			    break;
	    }


		if ($username && $id && $model)
		{
			if (Favorite::ofUsername($username)->hasFavorite($type, $id)->count())
			{
				$response['success'] = false;
				$response['message'] = 'Already in your favorites.';
			}
			else
			{
				$fav = new Favorite();
				$fav->username = $username;
				$model->favorites()->save($fav);
				$response['success'] = true;
				$response['message'] = 'Successfully added to your favorites.';
			}
		}

	    return \Response::json($response);
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
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
	    $username = \Request::server('PHP_AUTH_USER', 'sampleuser');
	    $response = [];

	    $type = $request->input('type', '');
	    $id = $request->input('id', '');

	    $fav = Favorite::ofUsername($username)->hasFavorite($type, $id)->first();

	    if ($username && $id && $fav)
	    {
		    $fav->delete();
		    $response['success'] = true;
		    $response['message'] = 'Item successfully removed.';
	    }

	    return \Response::json($response);
    }
}
