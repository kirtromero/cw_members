<?php
// Updates
Route::get('adsclick/{ads_id}', 'AdsController@index');

// Search
Route::post('search-preview', 'SearchController@xhrSearch');
Route::get('search/{keywords?}', 'SearchController@index');

// Tags
Route::get('tags', 'TagController@index');
Route::get('tag/{tag_id?}/{slug?}', 'TagController@contents');

// Models
Route::get('models', 'ModelController@index');
Route::get('model/{model_id?}/{slug?}', 'ModelController@contents');

// Contents
Route::post('comment', 'ContentController@comment');
Route::post('rate', 'ContentController@rate');
Route::get('view/{id}/{slug?}', 'ContentController@view');
Route::get('download/{content_id}/{file_id}/{type?}', 'ContentController@download');
Route::get('download-zip/{content_id}/{file_id}', 'ContentController@downloadZip');

// Favorites
Route::resource('favorites', 'FavoriteController');

// Playlists
Route::resource('playlists', 'PlaylistController');

// DVDs
Route::get('dvds/series/{id?}', 'DvdsController@dvdSeries');
Route::get('dvds/tags/{id?}/{slug?}', 'DvdsController@dvdTags');
Route::resource('dvds', 'DvdsController');

// Updates
Route::get('updates/{type?}', 'UpdateController@index');

// Cam
Route::get('live', 'CamController@index');

// Site
Route::get('sites', 'SiteController@listSites');
Route::get('/{domain}/tags', 'TagController@site');
Route::get('/{domain}/models', 'ModelController@site');
Route::get('/{domain}/{type?}', 'SiteController@index');

// Main
Route::get('/', 'HomeController@index');
