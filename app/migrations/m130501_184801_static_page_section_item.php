<?php
defined('TBL_SECTION_ITEM') || define('TBL_SECTION_ITEM', 'page_section_item');
class m130501_184801_static_page_section_item extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createPageSectionItemTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropPageSectionItemTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_SECTION_ITEM.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropPageSectionItemTbl() {     
        $this->dropForeignKey('fk_page_section', TBL_SECTION_ITEM);
        $this->dropIndex('fk_page_section', TBL_SECTION_ITEM);
        $this->dropTable(TBL_SECTION_ITEM);
    }
	
     private function createPageSectionItemTbl() {         
        $this->createTable(TBL_SECTION_ITEM, array(
            'id'            => 'INT           NOT NULL AUTO_INCREMENT',
            'section_id'    => 'INT           NOT NULL',            
            'name'          => 'VARCHAR(128)  NOT NULL',
            'spec'          => 'VARCHAR(255)',
            'file'          => 'VARCHAR(255)',
            'content'       => 'TEXT',            
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
        
        $this->createIndex('fk_page_section',
                            TBL_SECTION_ITEM, 'section_id');
        
        $this->addForeignKey('fk_page_section', 
                            TBL_SECTION_ITEM, 'section_id',
                            TBL_PAGE_SECTION, 'id', 'CASCADE', 'CASCADE');
     }
}