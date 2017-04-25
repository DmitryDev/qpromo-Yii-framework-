<?php
defined('TBL_PAGE_SECTION') || define('TBL_PAGE_SECTION', 'page_section');
class m130501_184754_static_page_section extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createStaticPageSectionTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropStaticPageSectionTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PAGE_SECTION.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropStaticPageSectionTbl() {     
        $this->dropForeignKey('fk_page', TBL_PAGE_SECTION);
        $this->dropIndex('fk_page', TBL_PAGE_SECTION);
        $this->dropTable(TBL_PAGE_SECTION);
    }
	
     private function createStaticPageSectionTbl() {         
        $this->createTable(TBL_PAGE_SECTION, array(
            'id'            => 'INT           NOT NULL AUTO_INCREMENT',
            'page_id'       => 'INT           NOT NULL',            
            'name'          => 'VARCHAR(128)  NOT NULL',
            'description'   => 'TEXT',
            'content'       => 'TEXT',            
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
        
        $this->createIndex('fk_page',
                            TBL_PAGE_SECTION, 'page_id');
        
        $this->addForeignKey('fk_page', 
                            TBL_PAGE_SECTION, 'page_id',
                            TBL_PAGE, 'id', 'CASCADE', 'CASCADE');
     }
}