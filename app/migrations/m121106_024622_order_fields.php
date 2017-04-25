<?php

defined('TBL_ORDER') || define('TBL_ORDER', 'order');

class m121106_024622_order_fields extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_ORDER, 'shipping_phone', 'VARCHAR(25) default null');
        $this->addColumn(TBL_ORDER, 'billing_phone', 'VARCHAR(25) default null');
	}

	public function down()
	{
		$this->dropColumn(TBL_ORDER, 'shipping_phone');
        $this->dropColumn(TBL_ORDER, 'billing_phone');
	}

}