<?php
defined('TBL_MARKETING') || define('TBL_MARKETING', 'marketing');
class m130425_121458_marketingTool extends CDbMigration
{
    public function safeUp()
	{
        $this->init();
        $this->createMarketingTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropMarketingTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_MARKETING.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropMarketingTbl() {     
        $this->dropTable(TBL_MARKETING);
    }
	
     private function createMarketingTbl() {         
         $this->createTable(TBL_MARKETING, array(
            'id'            => 'INT           NOT NULL AUTO_INCREMENT',
            'name'          => 'VARCHAR(64)   NOT NULL',            
            'issued'        => 'DATE          NOT NULL UNIQUE',       
            'image'         => 'VARCHAR(255)  NOT NULL',
            'thumbnail'     => 'VARCHAR(255)  NOT NULL',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
     }
}