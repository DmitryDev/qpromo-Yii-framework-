<?php

defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');
defined('TBL_PRODUCT_INSTANCE') || define('TBL_PRODUCT_INSTANCE', 'product_instance');
defined('TBL_COLOR') || define('TBL_COLOR', 'color');


class m121016_170334_product_instance extends CDbMigration
{
	public function up()
	{        
        $this->init();
        $this->createProductInstanceTbl();        
        $this->finalize();
	}

	public function down()
	{
		$this->dropProductInstanceTbl();
	}

	private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_PRODUCT_INSTANCE.'`;';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createProductInstanceTbl() {         
        $this->createTable(TBL_PRODUCT_INSTANCE, array(
            'id'            => 'INT             NOT NULL    AUTO_INCREMENT',
            'product_id'    => 'INT             NOT NULL',
            'sku'           => 'INT             NOT NULL',
            'is_published'  => 'ENUM("yes","no")            DEFAULT "no"',
            'quantity'      => 'INT             NOT NULL    DEFAULT 0',                                      
            'color_id'      => 'INT             NOT NULL',            
            'PRIMARY KEY (`id`)',
            'UNIQUE  KEY (`sku`)',
            'UNIQUE  KEY (`product_id`, `color_id`)'),
            'ENGINE = InnoDB'
        );
         
        $this->createIndex('fk_product_instance',
                            TBL_PRODUCT_INSTANCE, 'product_id');
        
        $this->addForeignKey('fk_product_instance', 
                            TBL_PRODUCT_INSTANCE, 'product_id',
                            TBL_PRODUCT, 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('fk_product_instance_color',
                            TBL_PRODUCT_INSTANCE, 'color_id');
        
        $this->addForeignKey('fk_product_instance_color', 
                            TBL_PRODUCT_INSTANCE, 'color_id',
                            TBL_COLOR, 'id', 'CASCADE', 'CASCADE');
        
        
    }
     
    private function dropProductInstanceTbl() {     
        $this->dropForeignKey('fk_product_instance_color', TBL_PRODUCT_INSTANCE);
        $this->dropIndex('fk_product_instance_color', TBL_PRODUCT_INSTANCE);
        $this->dropForeignKey('fk_product_instance', TBL_PRODUCT_INSTANCE);
        $this->dropIndex('fk_product_instance', TBL_PRODUCT_INSTANCE);
        $this->dropTable(TBL_PRODUCT_INSTANCE);
    }
}