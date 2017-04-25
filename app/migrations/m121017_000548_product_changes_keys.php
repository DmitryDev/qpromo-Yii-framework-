<?php

defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');
defined('TBL_DEVICE')  || define('TBL_DEVICE',  'device');
defined('TBL_COLOR')   || define('TBL_COLOR',   'color');
defined('TBL_MANUFACTURER') || define('TBL_MANUFACTURER', 'manufacturer');

class m121017_000548_product_changes_keys extends CDbMigration
{
    private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
	public function up()
	{
        $this->init();
        
        
        $this->dropForeignKey('fk_product_device', TBL_PRODUCT);
        $this->dropForeignKey('fk_product_manufacturer', TBL_PRODUCT);        
        
        // Now let's create foreign indexes         
        $this->addForeignKey('fk_product_device', 
                            TBL_PRODUCT, 'device_id',
                            TBL_DEVICE, 'id', 'CASCADE', 'CASCADE');                
        
        
        $this->addForeignKey('fk_product_manufacturer', 
                            TBL_PRODUCT, 'manufacturer_id',
                            TBL_MANUFACTURER, 'id', 'CASCADE', 'CASCADE');
        
        $this->finalize();
	}

	public function down()
	{
        $this->init();
        
        $this->dropForeignKey('fk_product_manufacturer', TBL_PRODUCT);        
        $this->dropForeignKey('fk_product_device', TBL_PRODUCT);
        
        
        // Now let's create foreign indexes         
        $this->addForeignKey('fk_product_device', 
                            TBL_PRODUCT, 'device_id',
                            TBL_DEVICE, 'id', 'SET NULL', 'CASCADE');                
                
        $this->addForeignKey('fk_product_manufacturer', 
                            TBL_PRODUCT, 'manufacturer_id',
                            TBL_MANUFACTURER, 'id', 'SET NULL', 'CASCADE');
        
        $this->finalize();
	}
	
}