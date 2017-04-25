<?php
defined('TBL_MARGIN') || define('TBL_MARGIN', 'margin');

class m130409_164927_margin extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createMarginTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropMarginTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_MARGIN.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropMarginTbl() {            
        $this->dropTable(TBL_MARGIN);
    }
	
     private function createMarginTbl() {         
         $this->createTable(TBL_MARGIN, array(
            'quantity'      => 'INT   NOT NULL',
            'value'         => 'DECIMAL(6,4)',           
            'PRIMARY KEY (`quantity`,`value`)'),
        'ENGINE = InnoDB');
      
     }
}