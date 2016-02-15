<?php

if(!function_exists('display_template'))
{
	function display_template($slug = '', $data)
	{
		
	}
}

if(!function_exists('check_for_tour_theme'))
{
	function check_for_tour_theme($theme)
	{
		// Check if set to use as Tour
		$network_tour_theme = config('yppmembers.network_tour_theme');
		
		$theme = $network_tour_theme != '' ? $network_tour_theme : $theme;

		return $theme;
	}
}