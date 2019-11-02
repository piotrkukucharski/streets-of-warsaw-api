<?php

use yii\db\Migration;

/**
 * Class m191102_184302_create_tables_migration_csv
 */
class m191102_184302_create_tables_migration_csv extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('migration_csv', [
			'id' => $this->primaryKey(),
			'created_at' => $this->timestamp(),
			'hash' => $this->string(32),
		]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('migration_csv');
	}
}
