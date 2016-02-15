<?php namespace App\Http\Controllers;

use \Theme;
use Volrac\YppContent\Models\Model;
use Volrac\YppContent\Models\Site;
use Volrac\YppContent\Models\Favorite;
use \Input;

class ModelController extends YppController
{
	public function index()
	{


		$network = $this->network;

		$theme = $network->theme;

		$theme = check_for_tour_theme($theme);

		Theme::setActive($theme);

		$data = $this->data;

		if(Input::has('l')){
			$letter = Input::get('l');
			$models = Model::ofNetwork($network->id)->published()->where('name','like', $letter.'%')->paginate( config('yppmembers.per_page') );

		} else {
			$models = Model::ofNetwork($network->id)->published()->mostUsedInNetwork($network->id)->paginate( config('yppmembers.per_page') );
		}

		$data['page_title'] = $this->network->name.' Models';

		$data['models'] = $models;

		$this->breadcrumbs->addCrumb('Popular Models');

		return Theme::view('model.index', $data);
	}

	public function site($domain)
	{
		$site = Site::where('domain','=',$domain)->first();

		if(!$site)
		{
			return redirect('/');
		}

		$theme = $site->theme != '' ? $site->theme : $this->network->theme;

		$theme = check_for_tour_theme($theme);

		Theme::setActive($theme);

		$data = $this->data;

		$models = Model::ofSite($site->id)->mostUsedInSite($site->id)->paginate( config('yppmembers.per_page') );

		$data['page_title'] = $site->name.' Models';

		$data['models'] = $models;

		$this->breadcrumbs->addCrumb('Popular Models', url('models'));
		$this->breadcrumbs->addCrumb($site->name.' Models');

		$data['piwik_tracker_ids'] = config('yppmembers.use_piwik') && $site->piwik_id != 0 ? array_merge($data['piwik_tracker_ids'],[$site->piwik_id]) : $data['piwik_tracker_ids'];

		return Theme::view('model.index', $data);
	}

	public function contents($model_id = 0, $slug = '')
	{
		$network = $this->network;

		$theme = $network->theme;

		$theme = check_for_tour_theme($theme);

		Theme::setActive($theme);

		$data = $this->data;

		$model = Model::find($model_id);

		if($model)
		{
			$contents = $model->contents()->published()->ofNetwork($this->network->id)->orderBy('id','desc')->get();

			$data['page_title'] = $model->name.' Contents';
			$data['model'] = $model;
			$data['contents'] = $contents;

			$content_views = 0;
			foreach($contents as $content){
				$content_views = $content_views + $content->fake_views;
			}
			$data['content_views'] = $content_views;

			$username = \Request::server('PHP_AUTH_USER', 'sampleuser');
			$data['is_favorite'] = $username && Favorite::ofUsername($username)->hasFavorite('Model', $model->id)->count() ? 1 : 0;

			$this->breadcrumbs->addCrumb('Popular Models', url('models'));
			$this->breadcrumbs->addCrumb($model->name.' Contents');

			return Theme::view('model.contents', $data);
		}

	}

}
