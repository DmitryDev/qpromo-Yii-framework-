<?php
defined('TBL_PACKAGING') || define('TBL_PACKAGING', 'packaging');
class m130410_095940_packaging extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createPackagingTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropPackagingTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_PACKAGING.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropPackagingTbl() {     
        $this->dropTable(TBL_PACKAGING);
    }
	
     private function createPackagingTbl() {         
         $this->createTable(TBL_PACKAGING, array(  
            'id'            => 'INT           NOT NULL AUTO_INCREMENT',
            'name'          => 'VARCHAR(64)   NOT NULL UNIQUE',
            'model_number'  => 'VARCHAR(32)   NOT NULL UNIQUE',
            'width'         => 'DECIMAL(7,2)  NULL',
            'height'        => 'DECIMAL(7,2)  NULL',
            'length'        => 'DECIMAL(7,2)  NULL',
            'diameter'      => 'DECIMAL(7,2)  NULL',
            'weight'        => 'DECIMAL(7,5)  NULL',
            'customization' => 'TEXT',
            'description'   => 'TEXT',
            'image'         => 'VARCHAR(255)  NOT NULL',
            'image2'        => 'VARCHAR(255)  NOT NULL',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
     }
}