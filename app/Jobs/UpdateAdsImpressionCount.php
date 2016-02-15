<?php namespace App\Jobs;

use Volrac\YppContent\Models\Advertisement;
use Volrac\YppContent\Models\Advertisementimpression;

class UpdateAdsImpressionCount
{

    public function fire($job,$data)
    {

        $id = isset($data['id']) ? $data['id'] : NULL ;
        $username = isset($data['username']) ? $data['username'] : "localuser";

        if(isset($data['id']) && isset($data['username']))
        {
            $advertismentimpression = new Advertisementimpression();
            $advertismentimpression->advertisement_id = $id;
            $advertismentimpression->username = $username;
            $advertismentimpression->save();

            $advertisement = Advertisement::find($id);
            $advertisement->increment('impressions');

        } else {
            $job->delete();
        }
    }
}
