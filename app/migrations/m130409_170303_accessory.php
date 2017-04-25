<?php
defined('TBL_ACCESSORY') || define('TBL_ACCESSORY', 'accessory');
class m130409_170303_accessory extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createAccessoryTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropAccessoryTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_ACCESSORY.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropAccessoryTbl() {     
        $this->dropTable(TBL_ACCESSORY);
    }
	
     private function createAccessoryTbl() {         
         $this->createTable(TBL_ACCESSORY, array(  
            'id'            => 'INT           NOT NULL AUTO_INCREMENT',
            'name'          => 'VARCHAR(64)   NOT NULL UNIQUE',
            'description'   => 'TEXT',
            'image'         => 'VARCHAR(255)  NOT NULL',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
     }
}