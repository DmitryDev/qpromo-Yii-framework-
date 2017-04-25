<?php
defined('TBL_EVENT') || define('TBL_EVENT', 'event');

class m130424_231302_event extends CDbMigration
{
    public function safeUp()
	{
        $this->init();
        $this->createEventTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropEventTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_EVENT.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropEventTbl() {     
        $this->dropTable(TBL_EVENT);
    }
	
     private function createEventTbl() {         
         $this->createTable(TBL_EVENT, array(
            'id'            => 'INT           NOT NULL AUTO_INCREMENT',
            'name'          => 'VARCHAR(64)   NOT NULL UNIQUE',
            'description'   => 'TEXT',
            'place'         => 'VARCHAR(255)  NOT NULL',
            'link'          => 'VARCHAR(255)  NOT NULL',
            'date'          => 'DATE          NOT NULL',             
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
     }
}