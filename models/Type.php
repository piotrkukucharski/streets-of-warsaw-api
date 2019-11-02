<?php


namespace app\models;


use yii\db\ActiveRecord;

/**
 * Class Type
 * @package app\models
 *
 * @property int $id [int(11)]
 * @property int $name [int(11)]
 */
class Type extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%types}}';
	}

}
