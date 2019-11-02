<?php


namespace app\controllers;

use Yii;
use yii\rest\ActiveController;

use app\models\StreetSearch;

class StreetController extends ActiveController
{
	public $modelClass = 'app\models\Street';
	public $reservedParams = ['sort', 'q'];

	public function actions()
	{
		$actions = parent::actions();
		$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
		return $actions;
	}

	public function prepareDataProvider()
	{
		$searchModel = new StreetSearch();
		return $searchModel->search(Yii::$app->request->queryParams);
	}
}
