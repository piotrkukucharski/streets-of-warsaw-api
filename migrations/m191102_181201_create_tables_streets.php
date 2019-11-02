<?php

use yii\db\Migration;

/**
 * Class m191102_181201_create_tables_streets
 */
class m191102_181201_create_tables_streets extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('streets', [
			'id' => $this->primaryKey(),
			'name' => $this->text(),
			'filler_name' => $this->text(),
			'short_name' => $this->text(),
			'id_type' => $this->integer(),
		]);

		$this->addForeignKey(
			'streets_types_id_fk',
			'streets',
			'id_type',
			'types',
			'id',
			'SET NULL'
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('streets');
	}
}
