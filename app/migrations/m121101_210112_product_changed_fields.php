<?php

defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');

class m121101_210112_product_changed_fields extends CDbMigration
{
	public function up()
	{
        $this->dropColumn(TBL_PRODUCT, 'sku');
        $this->dropColumn(TBL_PRODUCT, 'quantity');
	}

	public function down()
	{
		$this->addColumn(TBL_PRODUCT, 'sku', 'int not null');
        $this->addColumn(TBL_PRODUCT, 'quantity', 'int not null');
	}
}