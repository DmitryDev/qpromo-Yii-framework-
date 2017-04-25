<?php
defined('TBL_PRICE_CODE') || define('TBL_PRICE_CODE', 'price_code');

class m130320_123022_price_code extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createPriceCodeTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropPriceCodeTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PRICE_CODE.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropPriceCodeTbl() {     
        $this->dropTable(TBL_PRICE_CODE);
    }
	
     private function createPriceCodeTbl() {         
         $this->createTable(TBL_PRICE_CODE, array(
            'id'            => 'INT   NOT NULL AUTO_INCREMENT',
            'code'          => 'VARCHAR(3)',
            'discount'      => 'DECIMAL(7,5)',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
         
         $this->insert(TBL_PRICE_CODE, array('code'=>'A', 'discount'=>"2"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'P', 'discount'=>"2"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'B', 'discount'=>"1.818"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'Q', 'discount'=>"1.818"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'C', 'discount'=>"1.6666"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'R', 'discount'=>"1.6666"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'D', 'discount'=>"1.538"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'S', 'discount'=>"1.538"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'E', 'discount'=>"1.429"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'T', 'discount'=>"1.429"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'F', 'discount'=>"1.333"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'U', 'discount'=>"1.333"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'G', 'discount'=>"1.25"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'V', 'discount'=>"1.25"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'H', 'discount'=>"1.1766"));
         $this->insert(TBL_PRICE_CODE, array('code'=>'W', 'discount'=>"1.1766"));
     }
}