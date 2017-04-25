<?php
defined('TBL_USER') || define('TBL_USER', 'user');
defined('TBL_DEVICE') || define('TBL_DEVICE', 'device');
defined('TBL_USER_DEVICE') || define('TBL_USER_DEVICE', 'user_device');

class m121002_200615_user_device extends CDbMigration
{
	public function up()
	{
        //$this->init();
        //$this->createUserDeviceTbl();        
        //$this->finalize();
	}

	public function down()
	{
		//$this->dropUserDeviceTbl();
        return true;
	}

    private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_USER_DEVICE.'`;';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createUserDeviceTbl() {         
         $this->createTable(TBL_USER_DEVICE, array(
            'user_id'       => 'INT NOT NULL',
            'device_id'     => 'INT NOT NULL',                         
            'PRIMARY KEY (`user_id`, `device_id`)' ),
            'ENGINE = InnoDB'
        );
         
        $this->createIndex('fk_user',
                            TBL_USER_DEVICE, 'user_id');
        $this->addForeignKey('fk_user', 
                            TBL_USER_DEVICE, 'user_id',
                            TBL_USER, 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('fk_device',
                            TBL_USER_DEVICE, 'device_id');
        $this->addForeignKey('fk_device', 
                            TBL_USER_DEVICE, 'device_id',
                            TBL_DEVICE, 'id', 'CASCADE', 'CASCADE');
     }
     
    private function dropUserDeviceTbl() {    
        $this->dropForeignKey('fk_user', TBL_USER_DEVICE);
        $this->dropForeignKey('fk_device', TBL_USER_DEVICE);
        $this->dropIndex('fk_user', TBL_USER_DEVICE);
        $this->dropIndex('fk_device', TBL_USER_DEVICE);
        $this->dropTable(TBL_USER_DEVICE);
    }
    	
}