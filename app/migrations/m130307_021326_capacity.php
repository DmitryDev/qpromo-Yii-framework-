<?php
defined('TBL_CAPACITY') || define('TBL_CAPACITY', 'capacity');

class m130307_021326_capacity extends CDbMigration
{
	public function safeUp()
	{
        $this->init();
        $this->createCapacityTbl();        
        $this->finalize();
	}

    public function safeDown()
	{        
        $this->dropCapacityTbl();
	}
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';                
                drop table if exists `'.TBL_CAPACITY.'`';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function dropCapacityTbl() {     
        $this->dropTable(TBL_CAPACITY);
    }
	
     private function createCapacityTbl() {         
         $this->createTable(TBL_CAPACITY, array(  
            'id'            => 'INT   NOT NULL AUTO_INCREMENT',
            'value'         => 'INT   NOT NULL UNIQUE',
            'PRIMARY KEY (`id`)'),
        'ENGINE = InnoDB');
         
         $this->insert(TBL_CAPACITY, array('value' => '1')); //1Mb
         $this->insert(TBL_CAPACITY, array('value' => '2')); //2Mb
         $this->insert(TBL_CAPACITY, array('value' => '4')); //4Mb
         $this->insert(TBL_CAPACITY, array('value' => '8')); //8Mb
         $this->insert(TBL_CAPACITY, array('value' => '16')); //16Mb
         $this->insert(TBL_CAPACITY, array('value' => '32')); //32Mb
         $this->insert(TBL_CAPACITY, array('value' => '64'));  //64Mb
         $this->insert(TBL_CAPACITY, array('value' => '128')); //128Mb
         $this->insert(TBL_CAPACITY, array('value' => '256')); //256Mb
         $this->insert(TBL_CAPACITY, array('value' => '512')); //512Mb
         $this->insert(TBL_CAPACITY, array('value' => '1024')); //1Gb
         $this->insert(TBL_CAPACITY, array('value' => '2048')); //2Gb
         $this->insert(TBL_CAPACITY, array('value' => '4096')); //4Gb
         $this->insert(TBL_CAPACITY, array('value' => '8192')); //8Gb
         $this->insert(TBL_CAPACITY, array('value' => '16384')); //16Gb
         $this->insert(TBL_CAPACITY, array('value' => '32768')); //32Gb
         $this->insert(TBL_CAPACITY, array('value' => '65536')); //64Gb
         $this->insert(TBL_CAPACITY, array('value' => '131072')); //128Gb
         $this->insert(TBL_CAPACITY, array('value' => '262144')); //256Gb
         $this->insert(TBL_CAPACITY, array('value' => '524288')); //512Gb
         $this->insert(TBL_CAPACITY, array('value' => '1048576')); //1Tb
         $this->insert(TBL_CAPACITY, array('value' => '2097152')); //2Tb
         $this->insert(TBL_CAPACITY, array('value' => '4194304')); //4Tb         
     }
}