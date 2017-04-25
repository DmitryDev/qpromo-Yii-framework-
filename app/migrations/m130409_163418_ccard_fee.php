<?php
defined('TBL_CC_FEE') || define('TBL_CC_FEE', 'ccard_fee');

class m130409_163418_ccard_fee extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createCcFeeTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropCcFeeTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_CC_FEE.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropCcFeeTbl() {            
        $this->dropTable(TBL_CC_FEE);
    }
	
     private function createCcFeeTbl() {         
         $this->createTable(TBL_CC_FEE, array(
            'quantity'      => 'INT   NOT NULL',
            'value'         => 'DECIMAL(8,6)',           
            'PRIMARY KEY (`quantity`,`value`)'),
        'ENGINE = InnoDB');
      
     }
}