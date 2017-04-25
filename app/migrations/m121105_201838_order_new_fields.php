<?php

defined('TBL_ORDER') || define('TBL_ORDER', 'order');

class m121105_201838_order_new_fields extends CDbMigration
{
	public function up()
	{
        // shipping agent is a reference book
        // 1-- ups
        // 2-- usps
        // 3-- ..... and so on
        // It could be a separate table in future but now we work with code numbers only
        
        $this->addColumn(TBL_ORDER, 'updated_at', 'DATETIME NOT NULL');
        $this->addColumn(TBL_ORDER, 'pmnt_gw_response', 'TEXT');
        $this->addColumn(TBL_ORDER, 'shipping_agent', 'INT default 1');
        $this->addColumn(TBL_ORDER, 'tracking_number', 'VARCHAR(128) default null');
	}

	public function down()
	{
		$this->dropColumn(TBL_ORDER, 'updated_at');
        $this->dropColumn(TBL_ORDER, 'pmnt_gw_response');
        $this->dropColumn(TBL_ORDER, 'shipping_agent');
        $this->dropColumn(TBL_ORDER, 'tracking_number');
	}

}