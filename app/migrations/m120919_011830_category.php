<?php

defined('TBL_CATEGORY') || define('TBL_CATEGORY', 'category');

class m120919_011830_category extends CDbMigration
{
	public function up()
	{
        $this->init();
        $this->createCategoryTbl();        
        $this->finalize();
	}

	public function down()
	{
		$this->dropCategoryTbl();
	}

	private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_CATEGORY.'`;';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createCategoryTbl() {         
         $this->createTable(TBL_CATEGORY, array(
            'id'            => 'INT NOT NULL AUTO_INCREMENT',
            'parent_id'     => 'INT NULL',             
            'name'          => 'VARCHAR(64) NOT NULL',
            'tag'           => 'VARCHAR(32)     NULL',             
            'slug'          => 'VARCHAR(128)    NULL',
            'is_published'  => 'enum("yes","no") DEFAULT "no"',                                                 
            'updated_at'    => 'DATETIME NOT NULL',
            'order'         => 'INT NULL',
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );
         
        $this->createIndex('fk_parent_id', TBL_CATEGORY, 'parent_id');
        $this->addForeignKey('fk_parent_id',TBL_CATEGORY, 'parent_id',
                            TBL_CATEGORY, 'id', 'CASCADE', 'CASCADE');
        
         $this->insert(TBL_CATEGORY, array(
            'name'          => 'Product Catalog',
            'tag'           => 'catalog',
            'slug'          => 'product-catalog',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
         
        /*$this->insert(TBL_CATEGORY, array(
            'name'          => 'Footer',
            'tag'           => 'footer',
            'slug'          => 'footer',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '2'
        ));         */
    }
    
    private function dropCategoryTbl() {
        $this->dropTable(TBL_CATEGORY);
    }
}