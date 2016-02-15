<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use Volrac\YppContent\Models\Content;
use Volrac\YppContent\Models\Rating;

class UpdateRatingCount extends Job
{

    public $content;
    public $rating;
    public $username;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $rating, $username = '')
    {
        $this->content = Content::find($id);
        $this->rating = $rating;
        $this->username = 'test'; //$username;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if($this->username != '')
        {
            $rating = new Rating();
            $rating->content_id = $this->content->id;
            $rating->rating = $this->rating;
            $rating->username = $this->username;
            $rating->save();
        }
    }
}
