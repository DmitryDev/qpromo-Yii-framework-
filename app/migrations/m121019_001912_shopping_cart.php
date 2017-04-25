<?php
defined('TBL_SHOPPING_CART') || define('TBL_SHOPPING_CART', 'shopping_cart');
defined('TBL_PRODUCT_INSTANCE') || define('TBL_PRODUCT_INSTANCE', 'product_instance');
defined('TBL_USER') || define('TBL_USER', 'user');

class m121019_001912_shopping_cart extends CDbMigration
{
	public function up()
	{
        $this->init();
        $this->createShoppingCartTbl();
        $this->finalize();
	}

	public function down()
	{
        $this->dropShoppingCartTbl();
	}
    
    private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_SHOPPING_CART.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }

     private function createShoppingCartTbl() {         
        $this->createTable(TBL_SHOPPING_CART, array(
            'id'                     => 'INT           NOT NULL AUTO_INCREMENT',
            'user_id'                => 'INT           NOT NULL',
            'product_instance_id'    => 'INT           NOT NULL',
            'quantity'               => 'INT           NOT NULL',
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );
        
        $this->createIndex('fk_product_instance_cart',
                            TBL_SHOPPING_CART, 'product_instance_id');
        
        $this->addForeignKey('fk_product_instance_cart', 
                            TBL_SHOPPING_CART, 'product_instance_id',
                            TBL_PRODUCT_INSTANCE, 'id', 'CASCADE', 'CASCADE');
        
        
        
        
        
        $this->createIndex('fk_user_cart',
                            TBL_SHOPPING_CART, 'user_id');
        
        $this->addForeignKey('fk_user_cart', 
                            TBL_SHOPPING_CART, 'user_id',
                            TBL_USER, 'id', 'CASCADE', 'CASCADE');
    }
    
    private function dropShoppingCartTbl() {        
        $this->dropForeignKey('fk_user_cart', TBL_SHOPPING_CART);
        $this->dropIndex('fk_user_cart', TBL_SHOPPING_CART);
        $this->dropForeignKey('fk_product_instance_cart', TBL_SHOPPING_CART);
        $this->dropIndex('fk_product_instance_cart', TBL_SHOPPING_CART);
        $this->dropTable(TBL_SHOPPING_CART);
    }
	
}