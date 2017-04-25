<?php

defined('TBL_PROMO') || define('TBL_PROMO', 'promo');
defined('TBL_PROMO_HOLDER') || define('TBL_PROMO_HOLDER', 'promo_holder');

class m121227_134922_promo_holder extends CDbMigration
{
	 public function up()
	{
       // $this->init();
        //$this->createPromoHolderTbl();
        //$this->finalize();

	}

	public function down()
	{
        //$this->dropPromoHolderTbl();
	}	
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_PROMO_HOLDER.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createPromoHolderTbl() {         
        $this->createTable(TBL_PROMO_HOLDER, array(                        
            'promo_id'      => 'INT           NOT NULL',
            'email'         => 'VARCHAR(128)  NOT NULL',                        
            'order_id'      => 'INT           DEFAULT NULL',
            'PRIMARY KEY (`promo_id`, `email`)' ),
            'ENGINE = InnoDB'
        );             
        
        $this->createIndex('fk_promo_holder', TBL_PROMO_HOLDER, 'promo_id');
        
        $this->addForeignKey('fk_promo_holder', TBL_PROMO_HOLDER, 'promo_id',
                            TBL_PROMO, 'id', 'CASCADE', 'CASCADE');
    }
    
    private function dropPromoHolderTbl() {   
        $this->dropForeignKey('fk_promo_holder', TBL_PROMO_HOLDER);
        $this->dropIndex('fk_promo_holder', TBL_PROMO_HOLDER);
        $this->dropTable(TBL_PROMO_HOLDER);
    }
}