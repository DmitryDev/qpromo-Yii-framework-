<?php

defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');
defined('TBL_DEVICE')  || define('TBL_DEVICE',  'device');
defined('TBL_PRODUCT_DEVICE') || define('TBL_PRODUCT_DEVICE', 'product_device');

class m121031_221328_product_device extends CDbMigration
{
    private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_PRODUCT_DEVICE.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    	

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        //$this->init();
        //$this->createProductDeviceTbl();
        //$this->finalize();
	}

	public function safeDown()
	{
        //$this->dropProductDeviceTbl();
        return true;
	}
    
    private function createProductDeviceTbl() {         
        $this->createTable(TBL_PRODUCT_DEVICE, array(
           'product_id'    => 'INT NOT NULL',
           'device_id'     => 'INT NOT NULL',
           'PRIMARY KEY (`product_id`, `device_id`)' ),
           'ENGINE = InnoDB'
        );                
        
        // Now let's create foreign indexes 
        $this->createIndex('fk_toproduct',
                            TBL_PRODUCT_DEVICE, 'product_id');
        $this->addForeignKey('fk_toproduct', 
                            TBL_PRODUCT_DEVICE, 'product_id',
                            TBL_PRODUCT, 'id', 'CASCADE', 'CASCADE');        
        $this->createIndex('fk_todevice',
                            TBL_PRODUCT_DEVICE, 'device_id');
        $this->addForeignKey('fk_todevice', 
                            TBL_PRODUCT_DEVICE, 'device_id',
                            TBL_DEVICE, 'id', 'CASCADE', 'CASCADE');
        
        //$this->dropForeignKey('fk_product_device', TBL_PRODUCT);        
        $this->dropIndex('fk_product_device', TBL_PRODUCT);
        $this->dropColumn(TBL_PRODUCT, 'device_id');
    }
    
    private function dropProductDeviceTbl() {                
        $this->addColumn(TBL_PRODUCT, 'device_id', 'int default null');
        $this->createIndex('fk_product_device',
                            TBL_PRODUCT, 'device_id');
        //$this->addForeignKey('fk_product_device', 
        //                    TBL_PRODUCT, 'device_id',
        //                    TBL_DEVICE, 'id', 'SET NULL', 'CASCADE');
        
        $this->dropForeignKey('fk_todevice', TBL_PRODUCT_DEVICE);                
        $this->dropIndex('fk_todevice', TBL_PRODUCT_DEVICE);
        $this->dropForeignKey('fk_toproduct', TBL_PRODUCT_DEVICE);                
        $this->dropIndex('fk_toproduct', TBL_PRODUCT_DEVICE);
        
        $this->dropTable(TBL_PRODUCT_DEVICE);
    }
	
}