<?php
defined('TBL_PRODUCT_PACKAGING') || define('TBL_PRODUCT_PACKAGING', 'product_packaging');
class m130410_120155_product_packaging extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createProductPackagingTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropProductPackagingTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PRODUCT_PACKAGING.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropProductPackagingTbl() {     
        $this->dropTable(TBL_PRODUCT_PACKAGING);
    }
	
     private function createProductPackagingTbl() {         
         $this->createTable(TBL_PRODUCT_PACKAGING, array(  
            'id'            => 'INT   NOT NULL AUTO_INCREMENT',
            'product_id'    => 'INT   NOT NULL',            
            'packaging'     => 'VARCHAR(255)',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');                
     }
}