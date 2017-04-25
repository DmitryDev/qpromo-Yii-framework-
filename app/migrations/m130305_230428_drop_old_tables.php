<?php

defined('TBL_MANUFACTURER') || define('TBL_MANUFACTURER', 'manufacturer');
defined('TBL_ORDER_ITEM') || define('TBL_ORDER_ITEM', 'order_item');
defined('TBL_ORDER') || define('TBL_ORDER', 'order');
defined('TBL_PAGE') || define('TBL_PAGE', 'page');
defined('TBL_PRODUCT_INSTANCE') || define('TBL_PRODUCT_INSTANCE', 'product_instance');
defined('TBL_SHOPPING_CART') || define('TBL_SHOPPING_CART', 'shopping_cart');
defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');

class m130305_230428_drop_old_tables extends CDbMigration
{
	public function up()
	{
        $this->dropTable(TBL_MANUFACTURER);
        $this->dropTable(TBL_ORDER_ITEM);
        $this->dropTable(TBL_ORDER);        
        $this->dropTable(TBL_PAGE);
        $this->dropTable(TBL_SHOPPING_CART);
        $this->dropTable(TBL_PRODUCT_INSTANCE);
        
        $this->dropColumn(TBL_PRODUCT, 'slug');
        $this->dropColumn(TBL_PRODUCT, 'price');
        $this->dropColumn(TBL_PRODUCT, 'discount');
        $this->dropColumn(TBL_PRODUCT, 'device_id');
        $this->dropColumn(TBL_PRODUCT, 'manufacturer_id');
        $this->dropColumn(TBL_PRODUCT, 'specials');
	}

	public function down()
	{
		echo "m130305_230428_drop_old_tables does not support migration down.\n";
		return false;
	}

}