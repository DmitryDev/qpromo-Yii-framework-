<?php

defined('TBL_ORDER') || define('TBL_ORDER', 'order');

class m121104_180302_order_add_shipping_method extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_ORDER, 'shipping_method', 'int not null default 1'); // 1 -- STANDARD only to fill existent test orders
        $this->addColumn(TBL_ORDER, 'shipping_amount', 'decimal(10,2) not null default 0');
	}

	public function down()
	{
		$this->dropColumn(TBL_ORDER, 'shipping_method');
		$this->dropColumn(TBL_ORDER, 'shipping_amount');
	}
}