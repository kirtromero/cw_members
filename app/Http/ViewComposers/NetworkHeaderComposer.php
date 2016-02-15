<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Users\Repository as UserRepository;
use Volrac\YppContent\Models\Network;
use Volrac\YppContent\Models\Tag;
use Volrac\YppContent\Models\Model;

class NetworkHeaderComposer {

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
        
        $network_sites = $network->sites()->withcontent()->orderBy('name','asc')->get();
        $most_used_tags_in_network = Tag::ofNetwork($network->id)->mostUsedInNetwork($network->id)->take(20)->get();
        $most_used_models_in_network = Model::ofNetwork($network->id)->mostUsedInNetwork($network->id)->take(20)->get();

        $view->with('network_sites', $network_sites);
        $view->with('most_used_tags_in_network', $most_used_tags_in_network);
        $view->with('most_used_models_in_network', $most_used_models_in_network);
    }

}

