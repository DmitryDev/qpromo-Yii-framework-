<?php
defined('TBL_MTCATEGORY') || define('TBL_MTCATEGORY', 'mtcategory');

class m130523_201531_mtcategory extends CDbMigration
{
	public function up()
	{
        $this->init();
        $this->createMtCategoryTbl();        
        $this->finalize();
	}

	public function down()
	{
		$this->dropMtCategoryTbl();
	}

	private function init() {
        $sql = 'SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
                SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
                SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=\'TRADITIONAL\';
                drop table if exists `'.TBL_MTCATEGORY.'`;';
        $this->execute($sql, array());
    }
    
    private function finalize() {
        $sql = 'SET SQL_MODE=@OLD_SQL_MODE;
                SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
                SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;';
        $this->execute($sql, array());
    }
    
    private function createMtCategoryTbl() {         
        $this->createTable(TBL_MTCATEGORY, array(
            'id'            => 'INT NOT NULL AUTO_INCREMENT',
            'parent_id'     => 'INT NULL DEFAULT NULL',             
            'name'          => 'VARCHAR(64) NOT NULL',            
            'PRIMARY KEY (`id`)' ),
            'ENGINE = InnoDB'
        );
        
        $this->createIndex('fk1_parent_id', TBL_MTCATEGORY, 'parent_id');
        $this->addForeignKey('fk1_parent_id', TBL_MTCATEGORY, 'parent_id',
                            TBL_MTCATEGORY, 'id', 'CASCADE', 'CASCADE');
        
        $this->insert(TBL_MTCATEGORY, array('name' => 'root'));

    }
    
    private function dropMtCategoryTbl() {
        $this->dropTable(TBL_MTCATEGORY);
    }
}