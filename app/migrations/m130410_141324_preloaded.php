<?php
defined('TBL_PRELOADED') || define('TBL_PRELOADED', 'preloaded');
class m130410_141324_preloaded extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createPreloadedTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropPreloadedTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PRELOADED.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropPreloadedTbl() {     
        $this->dropTable(TBL_PRELOADED);
    }
	
     private function createPreloadedTbl() {         
         $this->createTable(TBL_PRELOADED, array(  
            'id'            => 'INT           NOT NULL AUTO_INCREMENT',
            'name'          => 'VARCHAR(64)   NOT NULL UNIQUE',
            'description'   => 'TEXT',
            'image'         => 'VARCHAR(255)  NOT NULL',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
     }
}