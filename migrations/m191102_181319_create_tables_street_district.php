<?php

use yii\db\Migration;

/**
 * Class m191102_181319_create_tables_street_district
 */
class m191102_181319_create_tables_street_district extends Migration
{
	/**
	 * {@inheritdoc}
	 */
	public function safeUp()
	{
		$this->createTable('street_district', [
			'id_street' => $this->integer(),
			'id_district' => $this->integer(),
		]);

		$this->addPrimaryKey('pk-street_district', 'street_district', ['id_street', 'id_district']);

		$this->addForeignKey('fk-street_district-id_street', 'street_district', 'id_street', 'streets', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('fk-street_district-id_district', 'street_district', 'id_district', 'districts', 'id', 'CASCADE', 'CASCADE');
	}

	/**
	 * {@inheritdoc}
	 */
	public function safeDown()
	{
		$this->dropTable('street_district');
	}
}
