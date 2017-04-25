<?php

defined('TBL_PRODUCT_INSTANCE') || define('TBL_PRODUCT_INSTANCE', 'product_instance');

class m121017_214110_sku_int_2_bigint extends CDbMigration
{
	public function up()
	{
        $this->alterColumn(TBL_PRODUCT_INSTANCE, 'sku', 'bigint');
	}

	public function down()
	{
        //It's not possible to return back INT type
        //if there are records with bigint data
		//$this->alterColumn(TBL_PRODUCT_INSTANCE, 'sku', 'int');
	}

	
}