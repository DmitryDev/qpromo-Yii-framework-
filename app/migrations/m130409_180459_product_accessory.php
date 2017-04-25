<?php
defined('TBL_PRODUCT_ACCESSORY') || define('TBL_PRODUCT_ACCESSORY', 'product_accessory');
class m130409_180459_product_accessory extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createProductAccessoryTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropProductAccessoryTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PRODUCT_ACCESSORY.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropProductAccessoryTbl() {     
        $this->dropTable(TBL_PRODUCT_ACCESSORY);
    }
	
     private function createProductAccessoryTbl() {         
         $this->createTable(TBL_PRODUCT_ACCESSORY, array(  
            'id'            => 'INT   NOT NULL AUTO_INCREMENT',
            'product_id'    => 'INT   NOT NULL',            
            'accessories'     => 'VARCHAR(255)',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
                 
     }
}