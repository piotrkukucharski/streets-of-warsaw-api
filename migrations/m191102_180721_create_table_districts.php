<?php

use yii\db\Migration;

/**
 * Class m191102_180721_create_tables
 */
class m191102_180721_create_table_districts extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('districts', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('districts');
	}
}
