<?php

define('TBL_FAQ', 'faq');

class m121204_153028_FAQ extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createFaqTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropFaqTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_FAQ.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropFaqTbl() {     
        $this->dropTable(TBL_FAQ);
    }
	
     private function createFaqTbl() {         
         $this->createTable(TBL_FAQ, array(
            'id'            => 'INT     NOT NULL    AUTO_INCREMENT',
            'question'      => 'TEXT    NOT NULL',
            'answer'        => 'TEXT    NOT NULL',
            'is_published'  => 'ENUM("yes","no")    DEFAULT "no"',
            'order'         => 'INT                 DEFAULT 0',
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );
     }
}