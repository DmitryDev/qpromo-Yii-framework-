<?php

defined('TBL_PROMO') || define('TBL_PROMO', 'promo');

class m121227_130540_promo extends CDbMigration
{
    public function up()
	{
       // $this->init();
        //$this->createPromoTbl();
        //$this->finalize();

	}

	public function down()
	{
        //$this->dropPromoTbl();
	}	
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_PROMO.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createPromoTbl() {         
        $this->createTable(TBL_PROMO, array(            
            'id'            => 'INT           NOT NULL AUTO_INCREMENT',
            'name'          => 'VARCHAR(128)  NOT NULL',            
            'discount'      => 'DECIMAL(10,2) NOT NULL',            
            'created_at'    => 'DATETIME      NOT NULL',
            'updated_at'    => 'DATETIME      NOT NULL',
            'expire_at'     => 'DATETIME      NOT NULL',            
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );        
                
        $this->createIndex('sort_name', TBL_PROMO, 'name');                
    }
    
    private function dropPromoTbl() {        
        $this->dropIndex('sort_name', TBL_PROMO);                
        $this->dropTable(TBL_PROMO);
    }
}