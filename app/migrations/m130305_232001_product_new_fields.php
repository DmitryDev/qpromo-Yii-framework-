<?php
defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');

class m130305_232001_product_new_fields extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PRODUCT, 'model_number', 'VARCHAR(32)');
        $this->addColumn(TBL_PRODUCT, 'colors', 'VARCHAR(255)');
        $this->addColumn(TBL_PRODUCT, 'custom_color', 'ENUM("yes","no") DEFAULT "yes"');        
	}

	public function down()
	{
        $this->dropColumn(TBL_PRODUCT, 'custom_color');
        $this->dropColumn(TBL_PRODUCT, 'colors');
		$this->dropColumn(TBL_PRODUCT, 'model_number');        
		return true;
	}

}