<?php
use Illuminate\Foundation\Bus\DispatchesJobs;
use Volrac\YppContent\Models\Site;
use Volrac\YppContent\Models\Area;
use Volrac\YppContent\Models\Advertisement;
use Volrac\YppContent\Models\Advertismentimpression;
use App\Jobs\UpdateAdsImpressionCount;

\Component::register('advertisement', function($area, $site_id = null) {


    $advertisement = '';
    $data = array();

    $area = Area::where('slug',$area)->first();

    // Invalid Area
    if(!$area)
    {
    	return $advertisement;
    }

    $site = Site::where('name', $site_id)->first();
	if(!$site)
	{
		$site = Site::where('domain', $site_id)->first();
	}

	if(!$site)
	{
		$site = Site::find($site_id);
	}


    // Limited to Only 1 Site
    if($site && !empty($area->site_ids) && in_array($site->id, $area->site_ids))
    {
    	$advertisement = $area->advertisements()->first();

        $data['id'] = $advertisement->id;
        $data['username'] = \Request::server('PHP_AUTH_USER');

    	$advertisement = $advertisement->show;
    }

    // If not Site provided
    if($site_id == null && empty($area->site_ids))
    {
    	$advertisement = $area->advertisements()->orderBy(\DB::raw('RAND()'))->first();

        $data['id'] = $advertisement->id;
        $data['username'] = \Request::server('PHP_AUTH_USER');
    	$advertisement = $advertisement->show;
    }

    // Add the Impression Query to Queue
    \Queue::push('App\Jobs\UpdateAdsImpressionCount', $data);

    return $advertisement;
});
