<?php
defined('TBL_MTCATEGORY_MARKETING') || define('TBL_MTCATEGORY_MARKETING', 'mtcategory_marketing');
defined('TBL_MTCATEGORY') || define('TBL_MTCATEGORY', 'mtcategory');
defined('TBL_MARKETING') || define('TBL_MARKETING', 'marketing');

class m130523_201555_mtcategory_marketing extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->init();        
        $this->createMtCategoryMarketingTbl();        
        $this->finalize();
	}

	public function safeDown()
	{
        $this->dropMtCategoryMarketingTbl();        
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_MTCATEGORY_MARKETING.'`;';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }

     private function createMtCategoryMarketingTbl() {         
         $this->createTable(TBL_MTCATEGORY_MARKETING, array(
            'marketing_id'  => 'INT             NOT NULL',
            'mtcategory_id' => 'INT             NOT NULL',
            'PRIMARY KEY (`marketing_id`, `mtcategory_id`)' ),
            'ENGINE = InnoDB'
        );
         
        $this->createIndex('fk_marketing',
                            TBL_MTCATEGORY_MARKETING, 'marketing_id');
        $this->addForeignKey('fk_marketing', 
                            TBL_MTCATEGORY_MARKETING, 'marketing_id',
                            TBL_MARKETING, 'id', 'CASCADE', 'CASCADE');
        
        $this->createIndex('fk_mtcategory',
                            TBL_MTCATEGORY_MARKETING, 'mtcategory_id');
        $this->addForeignKey('fk_mtcategory', 
                            TBL_MTCATEGORY_MARKETING, 'mtcategory_id',
                            TBL_MTCATEGORY, 'id', 'CASCADE', 'CASCADE');
     }
     
      private function dropMtCategoryMarketingTbl() {
        $this->dropForeignKey('fk_marketing', TBL_MTCATEGORY_MARKETING);
        $this->dropForeignKey('fk_mtcategory', TBL_MTCATEGORY_MARKETING);
        $this->dropIndex('fk_marketing', TBL_MTCATEGORY_MARKETING);
        $this->dropIndex('fk_mtcategory', TBL_MTCATEGORY_MARKETING);
        $this->dropTable(TBL_MTCATEGORY_MARKETING);
    }
}