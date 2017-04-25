<?php

defined('TBL_PRODUCT_INSTANCE') || define('TBL_PRODUCT_INSTANCE', 'product_instance');
defined('TBL_ORDER_ITEM') || define('TBL_ORDER_ITEM', 'order_item');

class m121119_192425_instance_change_sku extends CDbMigration
{
	public function up()
	{
        $this->alterColumn(TBL_PRODUCT_INSTANCE, 'sku', 'VARCHAR(40)');
        $this->alterColumn(TBL_ORDER_ITEM, 'sku', 'VARCHAR(40)');
	}

	public function down()
	{
		//It's not possible to return back INT type
        //if there are records with bigint data
		//$this->alterColumn(TBL_PRODUCT_INSTANCE, 'sku', 'int');
	}
	
}