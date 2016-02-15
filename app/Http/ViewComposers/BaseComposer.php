<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;
use Volrac\YppContent\Models\Network;

class BaseComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $network_id = config('yppmembers.network_id');
        $network = Network::find($network_id);
        $page_title = $network->name;

        $view->with('network', $network);
    	$view->with('support_url', config('yppmembers.support_url'));
    }

}

