<?php
defined('TBL_SPECIALS') || define('TBL_SPECIALS', 'specials');

class m130304_190623_specials extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createSpecialsTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropSpecialsTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_SPECIALS.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropSpecialsTbl() {     
        $this->dropTable(TBL_SPECIALS);
    }
	
     private function createSpecialsTbl() {         
         $this->createTable(TBL_SPECIALS, array(  
            'id'            => 'INT           NOT NULL AUTO_INCREMENT',
            'name'          => 'VARCHAR(64)   NOT NULL UNIQUE',
            'link'          => 'VARCHAR(255)  NOT NULL',
            'image'         => 'VARCHAR(255)  NOT NULL',
            'is_published'  => 'ENUM("yes","no")    DEFAULT "yes"',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
     }
}