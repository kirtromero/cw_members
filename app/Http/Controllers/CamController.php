<?php namespace App\Http\Controllers;

use \Theme;

class CamController extends YppController
{
	public function index()
	{

		$data['page_title'] = 'Live cams';

		$data['tags'] = "";

		$this->breadcrumbs->addCrumb('Live Cams');

		return Theme::view('cam.index', $data);
	}
}
