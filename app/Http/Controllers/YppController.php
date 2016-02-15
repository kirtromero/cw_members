<?php namespace App\Http\Controllers;

use Volrac\YppContent\Models\Network;
use Volrac\YppContent\Models\Tag;
use Volrac\YppContent\Models\Model;
use \View;
use \Request;
use \Debugbar;

class YppController extends Controller {

	public $network;
	public $data;
	public $breadcrumbs;

	public function __construct()
	{
		$network_id = config('yppmembers.network_id');

		$network = Network::find($network_id);
		if(!$network)
		{
			echo 'Invalid Network';
			exit;
		}

		$this->network = $network;

		$this->breadcrumbs = new \Creitive\Breadcrumbs\Breadcrumbs;
		$this->breadcrumbs->setListElement('ol');
		$this->breadcrumbs->setDivider(null);
		$this->breadcrumbs->setCssClasses('breadcrumb');
		$this->breadcrumbs->addCrumb($network->name, url());

		$data['breadcrumbs'] = $this->breadcrumbs;

        $data['network'] = $network;
    	$data['support_url'] = config('yppmembers.support_url');
    	$data['network_sites'] = $network->sites()->withcontent()->orderBy('name','asc')->get();
		$data['most_used_tags_in_network'] = Tag::ofNetwork($network->id)->mostUsedInNetwork($network->id)->take(20)->get();
		$data['most_used_models_in_network'] = Model::ofNetwork($network->id)->mostUsedInNetwork($network->id)->take(20)->get();
		$data['show_network_header'] = true;

		$data['piwik_tracker_ids'] = config('yppmembers.use_piwik') && $network->piwik_id != 0 ? [$network->piwik_id] : [];

    	$this->data = $data;

    }

}
