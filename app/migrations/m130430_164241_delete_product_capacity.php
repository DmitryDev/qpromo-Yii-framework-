<?php
defined('TBL_PRODUCT_CAPACITY') || define('TBL_PRODUCT_CAPACITY', 'product_capacity');
class m130430_164241_delete_product_capacity extends CDbMigration
{
	public function up()
	{
        $this->dropTable(TBL_PRODUCT_CAPACITY);
	}

	public function down()
	{
		echo "m130430_164241_delete_product_capacity does not support migration down.\n";
		return false;
	}
}