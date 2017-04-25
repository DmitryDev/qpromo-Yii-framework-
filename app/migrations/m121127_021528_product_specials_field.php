<?php

defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');

class m121127_021528_product_specials_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PRODUCT, 'specials', 'enum("yes","no") DEFAULT "no"');
	}

	public function down()
	{
		$this->dropColumn(TBL_PRODUCT, 'specials');
	}
}