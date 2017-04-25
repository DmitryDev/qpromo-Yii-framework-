<?php

defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');
defined('TBL_DEVICE')  || define('TBL_DEVICE',  'device');
defined('TBL_COLOR')   || define('TBL_COLOR',   'color');
defined('TBL_PRODUCT_INSTANCE') || define('TBL_PRODUCT_INSTANCE', 'product_instance');
defined('TBL_MANUFACTURER') || define('TBL_MANUFACTURER', 'manufacturer');

class m121017_175742_delete_product_foreign_keys extends CDbMigration
{
	public function up()
	{
        $this->dropForeignKey('fk_product_device', TBL_PRODUCT);
        $this->dropForeignKey('fk_product_manufacturer', TBL_PRODUCT);        
        $this->dropForeignKey('fk_product_instance_color', TBL_PRODUCT_INSTANCE);              
	}

	public function down()
	{
        // Now let's create foreign indexes         
        $this->addForeignKey('fk_product_device', 
                            TBL_PRODUCT, 'device_id',
                            TBL_DEVICE, 'id', 'CASCADE', 'CASCADE');                
        
        
        $this->addForeignKey('fk_product_manufacturer', 
                            TBL_PRODUCT, 'manufacturer_id',
                            TBL_MANUFACTURER, 'id', 'CASCADE', 'CASCADE');
        
        $this->addForeignKey('fk_product_instance_color', 
                            TBL_PRODUCT_INSTANCE, 'color_id',
                            TBL_COLOR, 'id', 'CASCADE', 'CASCADE');
	}
    
   

}