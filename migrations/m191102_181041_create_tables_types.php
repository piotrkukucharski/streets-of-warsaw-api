<?php

use yii\db\Migration;

/**
 * Class m191102_181041_create_tables_types
 */
class m191102_181041_create_tables_types extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('types', [
			'id' => $this->primaryKey(),
			'name' => $this->text(),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('types');
	}
}
