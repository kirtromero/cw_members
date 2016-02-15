<?php

return array(
	'network_id' => env('NETWORK_ID','1'),
	'per_page' => env('PER_PAGE','24'),
	'support_url' => env('SUPPORT_URL', 'https://yourpaysitepartner.atlassian.net/servicedesk/customer/portal/2'),
	'themes_path' => 'themes/',

	'use_piwik' => env('USE_PIWIK', true),
	'piwik_url' => env('PIWIK_URL', 'http://piwik.app'),

	'network_tour_theme' => env('NETWORK_TOUR_THEME',''),

	'homepage_sliders' => env('HOMEPAGE_SLIDERS', 6),
	'homepage_contents' => env('HOMEPAGE_CONTENTS', 12),
	'homepage_mostviews' => env('HOMEPAGE_MOSTVIEWS', 3),
	'homepage_toprateds' => env('HOMEPAGE_TOPRATEDS', 3),
	'homepage_most_used_tags' => env('HOMEPAGE_MOST_USED_TAGS', 14),
	'homepage_dvds' => env('HOMEPAGE_DVDS', 6),
);
