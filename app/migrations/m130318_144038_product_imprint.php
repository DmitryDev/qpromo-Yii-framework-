<?php
defined('TBL_PRODUCT_IMPRINT') || define('TBL_PRODUCT_IMPRINT', 'product_imprint');

class m130318_144038_product_imprint extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createImprintTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropImprintTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PRODUCT_IMPRINT.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropImprintTbl() {     
        $this->dropTable(TBL_PRODUCT_IMPRINT);
    }
	
     private function createImprintTbl() {         
         $this->createTable(TBL_PRODUCT_IMPRINT, array(  
            'id'            => 'INT   NOT NULL AUTO_INCREMENT',
            'product_id'    => 'INT   NOT NULL',
            'width'         => 'DECIMAL(7,2)',
            'height'        => 'DECIMAL(7,2)',
            'areas'         => 'VARCHAR(255)',
            'printings'     => 'VARCHAR(64)',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
                 
     }
}