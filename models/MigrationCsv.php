<?php


namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class MigrationCsv
 * @package app\models
 *
 * @property integer $id
 * @property string $hash
 * @property string created_at
 */
class MigrationCsv extends ActiveRecord
{
	public static function tableName()
	{
		return '{{%migration_csv}}';
	}

}
