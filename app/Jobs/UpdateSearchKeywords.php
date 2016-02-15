<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Volrac\YppContent\Models\Searchkeyword;

class UpdateSearchKeywords extends Job implements SelfHandling
{
	public $searchkeyword;
	public $username;
	public $keywords;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($keywords)
    {
	    $this->username = \Request::server('PHP_AUTH_USER', 'sampleuser');
	    $keywords = strip_tags(str_replace("'"," ",$keywords));
	    $keywords = strtolower($keywords);
	    $this->keywords = $keywords;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    $searchkeyword = new Searchkeyword();
	    $searchkeyword->username = $this->username;
	    $searchkeyword->keywords = $this->keywords;
	    $searchkeyword->save();
    }
}
