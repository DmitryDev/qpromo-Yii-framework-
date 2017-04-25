
<?php
defined('TBL_DEVICE') || define('TBL_DEVICE', 'device');

class m121001_162307_device extends CDbMigration
{
	public function up()
	{
    //    $this->init();
    //    $this->createDeviceTbl();
    //    $this->finalize();

	}

	public function down()
	{
   //     $this->dropDeviceTbl();
	}	
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_DEVICE.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createDeviceTbl() {         
        $this->createTable(TBL_DEVICE, array(
           'id'            => 'INT          NOT NULL AUTO_INCREMENT',
           'name'          => 'VARCHAR(128) NOT NULL UNIQUE',           
           'image_path'    => 'VARCHAR(255)     NULL',            
           'is_published'  => 'enum("yes","no") DEFAULT "no"',            
           'updated_at'    => 'DATETIME     NOT NULL',
           'PRIMARY KEY (`id`)' ),
           'ENGINE = InnoDB'
        );                

    }
    
    private function dropDeviceTbl() {
        $this->dropTable(TBL_DEVICE);
    }

}