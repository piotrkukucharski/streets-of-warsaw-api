<?php


namespace app\models;


use yii\data\ActiveDataProvider;

class StreetSearch extends Street
{
	public function rules()
	{
		return [
			[['name', 'filler_name', 'short_name'], 'string'],
			[['name', 'filler_name', 'short_name'], 'safe']
		];
	}

	/**
	 * @param $params
	 * @return ActiveDataProvider
	 */
	public function search($params)
	{
		$query = Street::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => !empty($params['pageSize']) ? $params['pageSize'] : 20,
			],
		]);
		if (!empty($params['search'])) {
			$query->andFilterWhere(['like', 'name', $params['search']]);
			$query->orFilterWhere(['like', 'filler_name', $params['search']]);
			$query->orFilterWhere(['like', 'short_name', $params['search']]);
		}
		return $dataProvider;
	}
}
