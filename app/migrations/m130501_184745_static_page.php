<?php
defined('TBL_PAGE') || define('TBL_PAGE', 'page');
class m130501_184745_static_page extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createStaticPageTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropStaticPageTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PAGE.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropStaticPageTbl() {     
        $this->dropTable(TBL_PAGE);
    }
	
     private function createStaticPageTbl() {         
        $this->createTable(TBL_PAGE, array(
            'id'            => 'INT           NOT NULL AUTO_INCREMENT',
            'slug'          => 'VARCHAR(32)   NOT NULL UNIQUE',
            'name'          => 'VARCHAR(128)  NOT NULL',
            'description'   => 'TEXT',
            'content'       => 'TEXT',            
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
     }
}