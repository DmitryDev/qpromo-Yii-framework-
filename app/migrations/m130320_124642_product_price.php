<?php
defined('TBL_PRODUCT_PRICE') || define('TBL_PRODUCT_PRICE', 'product_price');
class m130320_124642_product_price extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createProductPriceTbl();
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropProductPriceTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PRODUCT_PRICE.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropProductPriceTbl() {     
        $this->dropTable(TBL_PRODUCT_PRICE);
    }
	
     private function createProductPriceTbl() {
         $this->createTable(TBL_PRODUCT_PRICE, array(
            'product_id'    => 'INT NOT NULL',
            'quantity'      => 'INT NOT NULL DEFAULT 0',
            'price'         => 'DECIMAL(10,2)',
            'PRIMARY KEY (`product_id`, `quantity`)'),
        'ENGINE = InnoDB');
     }
}