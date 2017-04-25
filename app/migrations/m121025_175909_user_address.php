<?php
defined('TBL_USER') || define('TBL_USER', 'user');
defined('TBL_USER_ADDRESS') || define('TBL_USER_ADDRESS', 'user_address');

class m121025_175909_user_address extends CDbMigration
{
	public function up()
	{
        $this->init();
        $this->createUserAddressTbl();
        $this->finalize();
	}

	public function down()
	{
        $this->dropUserAddressTbl();
	}
    
    private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_USER_ADDRESS.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }

     private function createUserAddressTbl() {         
        $this->createTable(TBL_USER_ADDRESS, array(
            'id'                     => 'INT           NOT NULL AUTO_INCREMENT',
            'user_id'                => 'INT           NOT NULL',
            'first_name'             => 'VARCHAR(50)', //the limit for AuthorizeNet
            'last_name'              => 'VARCHAR(50)', //the limit for AuthorizeNet
            'line1'                  => 'VARCHAR(60)', //line1+ line2 nust be <=60 the limit for AuthorizeNet
            'line2'                  => 'VARCHAR(60)', //must be controlled programmatically
            'city'                   => 'VARCHAR(40)', //the limit for AuthorizeNet
            'state'                  => 'VARCHAR(40)', //the limit for AuthorizeNet
            'state_code'             => 'VARCHAR(2)',  //the limit for AuthorizeNet
            'zip'                    => 'VARCHAR(20)', //the limit for AuthorizeNet
            'country'                => 'VARCHAR(60)', //the limit for AuthorizeNet
            'phone'                  => 'VARCHAR(25)', //the limit for AuthorizeNet
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );                      
        
        $this->createIndex('fk_user_address',
                            TBL_USER_ADDRESS, 'user_id');
        
        $this->addForeignKey('fk_user_address', 
                            TBL_USER_ADDRESS, 'user_id',
                            TBL_USER, 'id', 'CASCADE', 'CASCADE');
    }
    
    private function dropUserAddressTbl() {        
        $this->dropForeignKey('fk_user_address', TBL_USER_ADDRESS);
        $this->dropIndex('fk_user_address', TBL_USER_ADDRESS);        
        $this->dropTable(TBL_USER_ADDRESS);
    }

}