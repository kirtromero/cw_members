<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Volrac\YppContent\Models\Playlist;
use Volrac\YppContent\Models\Content;
use \Theme;

class PlaylistController extends YppController
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

	    $data['page_title'] = 'My Playlists';

	    $username = \Request::server('PHP_AUTH_USER', 'sampleuser');

	    $data['playlists'] = Playlist::ofUsername($username)->get();

	    $this->breadcrumbs->addCrumb('My Playlists');

	    return Theme::view('playlist.index', $data);
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

	    $content_id = $request->input('content_id', 0);
	    $type = $request->input('type', '');
	    $current_list = $request->input('current_list', '');
	    $new_list_name = $request->input('new_list_name', '');
	    $list_visibility = $request->input('list_visibility', '');
	    $content = Content::find($content_id);

	    if ( !$username || !$content )
	    {
		    return \Response::json([
			    'success' => false,
			    'message' => 'Cannot save playlist.'
		    ]);
	    }

	    if ( $type == 'playlist' )
	    {
			$playlist = Playlist::ofUsername($username)->find($current_list);

		    if ($playlist)
		    {
			    if ($playlist->contents->contains($content->id))
			    {
				    $response['success'] = false;
				    $response['message'] = $content->title . ' already in playlist ' . $playlist->name . '.';
			    }
			    else
			    {
				    $playlist->contents()->attach($content->id);
				    $response['success'] = true;
				    $response['message'] = $content->title . ' successfully added in playlist ' . $playlist->name . '.';
			    }
		    }
		    else
		    {
			    $response['success'] = false;
			    $response['message'] = 'Please select a playlist.';
		    }
	    }

	    if ( $type == 'new-list' )
	    {
		    $playlist = new Playlist();
		    $playlist->username = $username;
		    $playlist->name = $new_list_name;
		    $playlist->visibility = $list_visibility;
		    $playlist->save();

		    $playlist->contents()->attach($content->id);

		    $response['success'] = true;
		    $response['message'] = $new_list_name . ' successfully created!';
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
