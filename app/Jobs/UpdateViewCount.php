<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

use Volrac\YppContent\Models\Content;
use Volrac\YppContent\Models\Realview;

class UpdateViewCount extends Job
{

    public $content;
    public $username;
	public $referrer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->content = Content::find($id);
        $this->username = \Request::server('PHP_AUTH_USER');

        $referer = \Request::server('HTTP_REFERER');
        $this->referrer = $referer ? $referer : '';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->content)
        {
            $this->content->increment('views');
        }

        if($this->username != '')
        {
            $realview = new Realview();
            $realview->content_id = $this->content->id;
            $realview->username = $this->username;
            $realview->referrer = $this->referrer;
            $realview->save();
        }
    }
}
