<?php
define('TBL_STATIC_PAGE', 'page');


class m120918_162705_static_pages extends CDbMigration
{
	public function up()
	{
        $this->init();
        $this->createPageTbl();
        $this->finalize();

	}

	public function down()
	{
        $this->dropPageTbl();
	}	
    
     private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_STATIC_PAGE.'`;
                ';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createPageTbl() {         
        $this->createTable(TBL_STATIC_PAGE, array(
           'id'            => 'INT          NOT NULL AUTO_INCREMENT',
           'name'          => 'VARCHAR(64)  NOT NULL',
           'slug'          => 'VARCHAR(128) NOT NULL UNIQUE',
           'content'       => 'TEXT             NULL',
           'is_published'  => 'enum("yes","no") DEFAULT "no"',            
           'updated_at'    => 'DATETIME     NOT NULL',
           'PRIMARY KEY (`id`)' ),
           'ENGINE = InnoDB'
        );
        
        $this->createIndex('sort_slug', TBL_STATIC_PAGE, 'slug');
        $this->createIndex('sort_name', TBL_STATIC_PAGE, 'name');

    }
    
    private function dropPageTbl() {
        $this->dropTable(TBL_STATIC_PAGE);
    }

}