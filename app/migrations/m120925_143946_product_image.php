<?php
defined('TBL_PRODUCT_IMAGE') || define('TBL_PRODUCT_IMAGE', 'product_image');
defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');

class m120925_143946_product_image extends CDbMigration
{
	public function up()
	{
        $this->init();
        $this->createProductImageTbl();        
        $this->finalize();
	}

	public function down()
	{
		$this->dropProductImageTbl();
	}
    
    private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_PRODUCT_IMAGE.'`;';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createProductImageTbl() {         
         $this->createTable(TBL_PRODUCT_IMAGE, array(
            'id'            => 'INT             NOT NULL    AUTO_INCREMENT',
            'product_id'    => 'INT             NOT NULL',             
            'path_origin'   => 'VARCHAR(255)    NOT NULL',
            'path_small'    => 'VARCHAR(255)    NOT NULL',
            'path_large'    => 'VARCHAR(255)    NOT NULL',
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );
         
        $this->createIndex('fk_product_image',
                            TBL_PRODUCT_IMAGE, 'product_id');
        $this->addForeignKey('fk_product_image', 
                            TBL_PRODUCT_IMAGE, 'product_id',
                            TBL_PRODUCT, 'id', 'CASCADE', 'CASCADE');
     }
     
    private function dropProductImageTbl() {    
        $this->dropForeignKey('fk_product_image', TBL_PRODUCT_IMAGE);
        $this->dropIndex('fk_product_image', TBL_PRODUCT_IMAGE);
        $this->dropTable(TBL_PRODUCT_IMAGE);
    }

}