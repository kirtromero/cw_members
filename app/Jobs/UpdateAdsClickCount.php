<?php namespace App\Jobs;
use Volrac\YppContent\Models\Advertisement;
use Volrac\YppContent\Models\Advertisementclick;
class UpdateAdsClickCount
{
    public function fire($job,$data)
    {
        $id = $data['id'];
        $username = ($data['username']) ? $data['username'] : "test";
        if($username != '')
        {
            $advertismentclick = new Advertisementclick();
            $advertismentclick->advertisement_id = $id;
            $advertismentclick->username = $username;
            $advertismentclick->save();
            $advertisement = Advertisement::find($id);
            $advertisement->increment('clicks');
        } else {
            $job->delete();
        }
    }
}
