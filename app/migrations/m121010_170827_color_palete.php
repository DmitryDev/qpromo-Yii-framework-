<?php

defined('TBL_COLOR') || define('TBL_COLOR', 'color');

class m121010_170827_color_palete extends CDbMigration
{
	public function up()
	{
        //$this->init();
        //$this->createColorTbl();
        //$this->finalize();
	}

	public function down()
	{
        //$this->dropColorTbl();
	}	
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_COLOR.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createColorTbl() {         
        $this->createTable(TBL_COLOR, array(
           'id'            => 'INT          NOT NULL AUTO_INCREMENT',
           'value'         => 'VARCHAR(32)  NOT NULL',                      
           'PRIMARY KEY (`id`)' ),
           'ENGINE = InnoDB'
        );        
    }
    
    private function dropColorTbl() {        
        $this->dropTable(TBL_COLOR);
    }

}