<?php
defined('TBL_USER') || define('TBL_USER', 'user');
defined('TBL_ORDER') || define('TBL_ORDER', 'order');

class m121030_041459_order extends CDbMigration
{
	public function up()
	{
        $this->init();
        $this->createOrderTbl();
        $this->finalize();
	}

	public function down()
	{
		$this->dropOrderTbl();
	}
    
    private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_ORDER.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createOrderTbl() {         
        $this->createTable(TBL_ORDER, array(
            'id'                     => 'INT           NOT NULL AUTO_INCREMENT',
            'user_id'                => 'INT           NOT NULL',
            'status'                 => 'INT           NOT NULL',
            'created_at'             => 'DATETIME      NOT NULL',
            'transaction_id'         => 'VARCHAR(20)   NOT NULL',
            'amount'                 => 'DECIMAL(10,2) NOT NULL',
            
            'shipping_firstname'     => 'VARCHAR(50)   NOT NULL',
            'shipping_lastname'      => 'VARCHAR(50)   NOT NULL',
            'shipping_line1'         => 'VARCHAR(60)   NOT NULL',
            'shipping_line2'         => 'VARCHAR(60)   NOT NULL',
            'shipping_city'          => 'VARCHAR(40)   NOT NULL',
            'shipping_state'         => 'VARCHAR(40)   NOT NULL',
            'shipping_state_code'    => 'VARCHAR(2)    NOT NULL',
            'shipping_zip'           => 'VARCHAR(20)   NOT NULL',
            'shipping_country'       => 'VARCHAR(60)   NOT NULL',
            
            'billing_firstname'     => 'VARCHAR(50)   NOT NULL',
            'billing_lastname'      => 'VARCHAR(50)   NOT NULL',
            'billing_line1'         => 'VARCHAR(60)   NOT NULL',
            'billing_line2'         => 'VARCHAR(60)   NOT NULL',
            'billing_city'          => 'VARCHAR(40)   NOT NULL',
            'billing_state'         => 'VARCHAR(40)   NOT NULL',
            'billing_state_code'    => 'VARCHAR(2)    NOT NULL',
            'billing_zip'           => 'VARCHAR(20)   NOT NULL',
            'billing_country'       => 'VARCHAR(60)   NOT NULL',
            
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );             
        
        $this->createIndex('fk_user_order',
                            TBL_ORDER, 'user_id');
        
        $this->addForeignKey('fk_user_order', 
                            TBL_ORDER, 'user_id',
                            TBL_USER, 'id', 'CASCADE', 'CASCADE');
    }
    
    private function dropOrderTbl() {               
        $this->dropForeignKey('fk_user_order', TBL_ORDER);
        $this->dropIndex('fk_user_order', TBL_ORDER);
        $this->dropTable(TBL_ORDER);
    }
}