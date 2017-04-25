<?php

defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');
defined('TBL_ORDER') || define('TBL_ORDER', 'order');
defined('TBL_ORDER_ITEM') || define('TBL_ORDER_ITEM', 'order_item');

class m121030_211615_order_item extends CDbMigration
{
	public function up()
	{
        $this->init();
        $this->createOrderItemTbl();
        $this->finalize();
	}

	public function down()
	{
		$this->dropOrderItemTbl();
	}
    
    private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_ORDER_ITEM.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createOrderItemTbl() {         
        $this->createTable(TBL_ORDER_ITEM, array(
            'id'                     => 'BIGINT        NOT NULL AUTO_INCREMENT',
            'order_id'               => 'INT           NOT NULL',
            'product_id'             => 'INT           NOT NULL',
            'sku'                    => 'BIGINT        NOT NULL',
            'quantity'               => 'INT           NOT NULL',
            'color_id'               => 'INT           NOT NULL',
            'price'                  => 'DECIMAL(10,2) NOT NULL',                                    
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );             
        
        $this->createIndex('fk_order_item',
                            TBL_ORDER_ITEM, 'order_id');
        
        $this->addForeignKey('fk_order_item', 
                            TBL_ORDER_ITEM, 'order_id',
                            TBL_ORDER, 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('fk_product_item',
                            TBL_ORDER_ITEM, 'product_id');
        
        $this->addForeignKey('fk_product_item', 
                            TBL_ORDER_ITEM, 'product_id',
                            TBL_PRODUCT, 'id', 'CASCADE', 'CASCADE');
    }
    
    private function dropOrderItemTbl() {               
        $this->dropForeignKey('fk_product_item', TBL_ORDER_ITEM);
        $this->dropIndex('fk_product_item', TBL_ORDER_ITEM);
        $this->dropForeignKey('fk_order_item', TBL_ORDER_ITEM);
        $this->dropIndex('fk_order_item', TBL_ORDER_ITEM);
        $this->dropTable(TBL_ORDER_ITEM);
    }
}