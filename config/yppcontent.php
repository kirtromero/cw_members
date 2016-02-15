<?php

return array(

	/**** CONTENT RELATED ****/
	// allowed video types
	'video_types' => array( 'mp4', 'wmv', 'mpg', 'avi', 'flv', 'mpeg'),
	// alowed photo types
	'photo_types' => array( 'jpg', 'png', 'gif'),

	/**** PATHS ****/	
	'photos_url' => env('PHOTOS_URL', 'http://admin.yourpaysitepartner.app/photos/'),
	'videos_url' => env('VIDEOS_URL', 'http://content.yourpaysitepartner.app/yppcms/'),
	'thumb_url' => env('THUMBS_URL', 'http://thumbs.yourpaysitepartner.app'),
	'models_url' => env('MODELS_URL', 'http://content.yourpaysitepartner.app/'),
	'dvds_url' => env('DVDS_URL', 'http://content.yourpaysitepartner.app/dvds'),
	'sponsors_url' => env('FRIENDS_URL', 'http://promo.yourpaysitepartner.app/sponsors/'),
	'reviews_url' => env('REVIEWS_URL', 'http://promo.yourpaysitepartner.app/reviews/'),
	'advertisements_url' => env('ADVERTISEMENTS_URL', 'http://promo.yourpaysitepartner.app/advertisements/'),

);
