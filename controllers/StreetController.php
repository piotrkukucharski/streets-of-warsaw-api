<?php


namespace app\controllers;

use app\models\StreetSearch;
use Yii;
use yii\filters\Cors;
use yii\rest\ActiveController;

class StreetController extends ActiveController
{
    public $modelClass = 'app\models\Street';
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // add CORS filter
        $behaviors['corsFilter'] = [
            'class' => Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Allow-Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'OPTIONS', 'HEAD'],
                'Access-Control-Expose-Headers' => ['*'],
            ],
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['delete'], $actions['create']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider()
    {
        $searchModel = new StreetSearch();
        return $searchModel->search(Yii::$app->request->queryParams);
    }
}
