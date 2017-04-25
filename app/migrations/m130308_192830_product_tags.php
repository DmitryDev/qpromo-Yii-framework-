<?php
defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');
class m130308_192830_product_tags extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PRODUCT, 'tags', 'TEXT');
	}

	public function down()
	{        
		$this->dropColumn(TBL_PRODUCT, 'tags');        
		return true;
	}
}