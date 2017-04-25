<?php
defined('TBL_PRODUCT_CAPACITY') || define('TBL_PRODUCT_CAPACITY', 'product_capacity');
defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');

class m130307_022512_product_capacity extends CDbMigration
{
		public function safeUp()
	{
        $this->init();
        $this->createProductCapacityTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropProductCapacityTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PRODUCT_CAPACITY.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropProductCapacityTbl() {
        $this->dropForeignKey('fk_product_capacity', TBL_PRODUCT_CAPACITY);
        $this->dropIndex('fk_product_capacity', TBL_PRODUCT_CAPACITY);
        $this->dropTable(TBL_PRODUCT_CAPACITY);
    }
	
     private function createProductCapacityTbl() {         
         $this->createTable(TBL_PRODUCT_CAPACITY, array(  
            'product_id'    => 'INT NOT NULL',
            'capacity'         => 'INT   NOT NULL',
            'PRIMARY KEY (`product_id`, `capacity`)'),
        'ENGINE = InnoDB');
         
        $this->createIndex('fk_product_capacity',
                            TBL_PRODUCT_CAPACITY, 'product_id');
        
        $this->addForeignKey('fk_product_capacity', 
                            TBL_PRODUCT_CAPACITY, 'product_id',
                            TBL_PRODUCT, 'id', 'CASCADE', 'CASCADE');
     }
     
}