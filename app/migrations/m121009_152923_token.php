<?php

defined('TBL_TOKEN') || define('TBL_TOKEN', 'token');

class m121009_152923_token extends CDbMigration
{
    public function up()
	{
        $this->init();
        $this->createTokenTbl();
        $this->finalize();

	}

	public function down()
	{
        $this->dropTokenTbl();
	}	
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_TOKEN.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createTokenTbl() {         
        $this->createTable(TBL_TOKEN, array(
           'id'            => 'INT          NOT NULL AUTO_INCREMENT',
           'value'         => 'VARCHAR(128) NOT NULL',           
           'expire_at'     => 'DATETIME     NOT NULL',
           'PRIMARY KEY (`id`)' ),
           'ENGINE = InnoDB'
        );
        
        $this->createIndex('sort_value', TBL_TOKEN, 'value');        
        $this->createIndex('sort_expire_at', TBL_TOKEN, 'expire_at');
    }
    
    private function dropTokenTbl() {
        $this->dropIndex('sort_value', TBL_TOKEN);        
        $this->dropIndex('sort_expire_at', TBL_TOKEN);
        $this->dropTable(TBL_TOKEN);
    }

}