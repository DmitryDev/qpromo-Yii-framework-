<?php
defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');
class m130320_124105_product_pricecode extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PRODUCT, 'price_code_id', 'INT');
	}

	public function down()
	{
		$this->dropColumn(TBL_PRODUCT, 'price_code_id');
		return false;
	}
}