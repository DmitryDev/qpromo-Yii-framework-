<?php
define('TBL_PRODUCT', 'product');
defined('TBL_CATEGORY') || define('TBL_CATEGORY', 'category');
define('TBL_PRODUCT_CATEGORY', 'product_category');


class m120921_164956_product extends CDbMigration
{		
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->init();
        $this->createProductTbl();
        $this->createProductCategoryTbl();        
        $this->finalize();
	}

	public function safeDown()
	{
        $this->dropProductCategoryTbl();
        $this->dropProductTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_PRODUCT_CATEGORY.'`;
                drop table if exists `'.TBL_PRODUCT.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
     private function createProductTbl() {         
         $this->createTable(TBL_PRODUCT, array(
            'id'            => 'INT             NOT NULL    AUTO_INCREMENT',
            'name'          => 'VARCHAR(128)    NOT NULL',
            'slug'          => 'VARCHAR(128)        NULL',
            'is_published'  => 'ENUM("yes","no")            DEFAULT "no"',
            'updated_at'    => 'DATETIME        NOT NULL',
            'description'   => 'TEXT            NULL',
            'sku'           => 'INT             NOT NULL',
            'price'         => 'DECIMAL(10,2)   NOT NULL    DEFAULT 0.0',
            'discount'      => 'DECIMAL(10,2)   NOT NULL    DEFAULT 0.0',
            'quantity'      => 'INT             NOT NULL    DEFAULT 0',                                      
            'main_image_id' => 'INT                 NULL',
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );
     }
     
    private function dropProductTbl() {     
        $this->dropTable(TBL_PRODUCT);
    }

     private function createProductCategoryTbl() {         
         $this->createTable(TBL_PRODUCT_CATEGORY, array(
            'product_id'    => 'INT             NOT NULL',
            'category_id'   => 'INT             NOT NULL',
            'PRIMARY KEY (`product_id`, `category_id`)' ),
            'ENGINE = InnoDB'
        );
         
        $this->createIndex('fk_product',
                            TBL_PRODUCT_CATEGORY, 'product_id');
        $this->addForeignKey('fk_product', 
                            TBL_PRODUCT_CATEGORY, 'product_id',
                            TBL_PRODUCT, 'id', 'CASCADE', 'CASCADE');
        
        $this->createIndex('fk_category',
                            TBL_PRODUCT_CATEGORY, 'category_id');
        $this->addForeignKey('fk_category', 
                            TBL_PRODUCT_CATEGORY, 'category_id',
                            TBL_CATEGORY, 'id', 'CASCADE', 'CASCADE');
     }
     
      private function dropProductCategoryTbl() {
        $this->dropForeignKey('fk_product', TBL_PRODUCT_CATEGORY);
        $this->dropForeignKey('fk_category', TBL_PRODUCT_CATEGORY);
        $this->dropIndex('fk_product', TBL_PRODUCT_CATEGORY);
        $this->dropIndex('fk_category', TBL_PRODUCT_CATEGORY);
        $this->dropTable(TBL_PRODUCT_CATEGORY);
    }
}