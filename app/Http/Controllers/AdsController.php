<?php namespace App\Http\Controllers;

use \Theme;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\UpdateAdsClickCount;
use Volrac\YppContent\Models\Advertisement;

class AdsController extends YppController
{
	public function index($ads_id = '')
	{
		$data['id'] = $ads_id;
        $data['username'] = \Request::server('PHP_AUTH_USER');
		\Queue::push('App\Jobs\UpdateAdsClickCount', $data);

		$ads =  Advertisement::find($ads_id);

		return redirect()->away(  $ads->url );
	}

}
