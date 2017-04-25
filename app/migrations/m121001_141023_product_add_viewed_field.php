<?php

defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');

class m121001_141023_product_add_viewed_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PRODUCT, 'viewed', 'INTEGER NOT NULL DEFAULT 1');
	}

	public function down()
	{
		$this->dropColumn(TBL_PRODUCT, 'viewed');		
	}

}