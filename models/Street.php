<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * Class Street
 * @package app\models
 *
 * @property int $id [int(11)]
 * @property string $name
 * @property string $filler_name
 * @property string $short_name
 * @property int $id_type [int(11)]
 * @property-read District[] $districts
 * @property-read Type $type
 */
class Street extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%streets}}';
	}

	public function getDistricts()
	{
		return $this->hasMany(District::className(), ['id' => 'id_district'])
			->viaTable('street_district', ['id_street' => 'id']);
	}

	public function getType()
	{
		return $this->hasMany(Type::className(), ['id' => 'id_type']);
	}

}
