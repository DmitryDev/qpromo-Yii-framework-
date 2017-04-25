<?php
defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');

class m130305_235806_product_new_release_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PRODUCT, 'release_date', 'DATETIME NOT NULL');        
	}

	public function down()
	{
		$this->dropColumn(TBL_PRODUCT, 'release_date');
		return true;
	}
}