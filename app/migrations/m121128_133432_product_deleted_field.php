<?php

defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');

class m121128_133432_product_deleted_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PRODUCT, 'deleted', 'BOOL DEFAULT 0');
	}

	public function down()
	{
		$this->dropColumn(TBL_PRODUCT, 'deleted');
	}

}