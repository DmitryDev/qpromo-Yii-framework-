<?php
defined('TBL_PRINTING') || define('TBL_PRINTING', 'printing');

class m130318_144112_printing extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createPrintingTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropPrintingTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PRINTING.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropPrintingTbl() {     
        $this->dropTable(TBL_PRINTING);
    }
	
     private function createPrintingTbl() {         
         $this->createTable(TBL_PRINTING, array(  
            'id'            => 'INT   NOT NULL AUTO_INCREMENT',     
            'name'          => 'VARCHAR(128)',
            'description'   => 'TEXT',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
                 
     }
}