<?php

defined('TBL_ORDER') || define('TBL_ORDER', 'order');

class m121105_004650_order_card_last4d extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_ORDER, 'card_last4d', 'VARCHAR(4) not null default "0000"');
	}

	public function down()
	{
		$this->dropColumn(TBL_ORDER, 'card_last4d');
	}
}