<?php
defined('TBL_PRODUCT_PRELOADED') || define('TBL_PRODUCT_PRELOADED', 'product_preloaded');
class m130410_162349_product_preload extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createProductPreloadedTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropProductPreloadedTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PRODUCT_PRELOADED.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropProductPreloadedTbl() {     
        $this->dropTable(TBL_PRODUCT_PRELOADED);
    }
	
     private function createProductPreloadedTbl() {         
         $this->createTable(TBL_PRODUCT_PRELOADED, array(  
            'id'            => 'INT   NOT NULL AUTO_INCREMENT',
            'product_id'    => 'INT   NOT NULL',            
            'preloaded'   => 'VARCHAR(255)',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
                 
     }
}