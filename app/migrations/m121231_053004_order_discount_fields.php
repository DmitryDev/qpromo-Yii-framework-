<?php

defined('TBL_ORDER') || define('TBL_ORDER', 'order');

class m121231_053004_order_discount_fields extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_ORDER, 'promo_id', 'int DEFAULT NULL');
        $this->addColumn(TBL_ORDER, 'promo_percent', 'decimal(10,2) DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn(TBL_ORDER, 'promo_id');
        $this->dropColumn(TBL_ORDER, 'promo_percent');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}