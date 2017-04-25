<?php

defined('TBL_MANUFACTURER') || define('TBL_MANUFACTURER', 'manufacturer');

class m121010_171523_manufacturer extends CDbMigration
{
public function up()
	{
        $this->init();
        $this->createManufacturerTbl();
        $this->finalize();
	}

	public function down()
	{
        $this->dropManufacturerTbl();
	}	
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_MANUFACTURER.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createManufacturerTbl() {         
        $this->createTable(TBL_MANUFACTURER, array(
           'id'           => 'INT           NOT NULL AUTO_INCREMENT',
           'name'         => 'VARCHAR(128)  NOT NULL',                      
           'PRIMARY KEY (`id`)' ),
           'ENGINE = InnoDB'
        );        
    }
    
    private function dropManufacturerTbl() {        
        $this->dropTable(TBL_MANUFACTURER);
    }

}