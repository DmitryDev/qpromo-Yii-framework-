<?php
defined('TBL_PRINTING') || define('TBL_PRINTING', 'printing');
defined('TBL_PRINTING_PRICE') || define('TBL_PRINTING_PRICE', 'printing_price');

class m130409_152904_printing_price extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createPrintingPriceTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropPrintingPriceTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PRINTING_PRICE.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropPrintingPriceTbl() {     
        $this->dropForeignKey('fk_printing', TBL_PRINTING_PRICE);
        $this->dropIndex('fk_printing', TBL_PRINTING_PRICE);
        $this->dropTable(TBL_PRINTING_PRICE);
    }
	
     private function createPrintingPriceTbl() {         
         $this->createTable(TBL_PRINTING_PRICE, array(  
            'printing_id'   => 'INT   NOT NULL',
            'colors'        => 'INT   NOT NULL',//colors amount for color printing methods, 0 for others
            'quantity'      => 'INT   NOT NULL',
            'price'         => 'DECIMAL(10,2)',           
            'PRIMARY KEY (`printing_id`, `colors`, `quantity`)'),
        'ENGINE = InnoDB');
        
        $this->createIndex('fk_printing',
                            TBL_PRINTING_PRICE, 'printing_id');
        $this->addForeignKey('fk_printing', 
                            TBL_PRINTING_PRICE, 'printing_id',
                            TBL_PRINTING, 'id', 'CASCADE', 'CASCADE');
     }
}