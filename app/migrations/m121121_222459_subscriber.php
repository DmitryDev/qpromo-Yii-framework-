<?php

defined('TBL_USER') || define('TBL_USER', 'user');
defined('TBL_SUBSCRIBER') || define('TBL_SUBSCRIBER', 'subscriber');

class m121121_222459_subscriber extends CDbMigration
{
	public function up()
	{
        $this->init();
        $this->createSubscriberTbl();
        $this->finalize();
	}

	public function down()
	{
		$this->dropSubscriberTbl();
	}

	private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_SUBSCRIBER.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createSubscriberTbl() {         
        $this->createTable(TBL_SUBSCRIBER, array(            
            'email' => 'VARCHAR(128) UNIQUE NOT NULL',            
        ));
        $this->dropColumn(TBL_USER, 'subscribed');
    }
    
    private function dropSubscriberTbl() {
        $this->addColumn(TBL_USER, 'subscribed', 'ENUM("yes","no") DEFAULT "no"');
        $this->dropTable(TBL_SUBSCRIBER);
    }
}