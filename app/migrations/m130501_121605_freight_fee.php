<?php
defined('TBL_FREIGHT_FEE') || define('TBL_FREIGHT_FEE', 'freight_fee');
class m130501_121605_freight_fee extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createFreightFeeTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropFreightFeeTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_FREIGHT_FEE.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropFreightFeeTbl() {     
        $this->dropTable(TBL_FREIGHT_FEE);
    }
	
     private function createFreightFeeTbl() {         
        $this->createTable(TBL_FREIGHT_FEE, array(
            'freight'       => 'DECIMAL(6,2)',
            'value'         => 'DECIMAL(8,6)',           
            'PRIMARY KEY (`freight`,`value`)'),
        'ENGINE = InnoDB');
     }
}