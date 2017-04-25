<?php
defined('TBL_PAGE') || define('TBL_PAGE', 'page');

class m130521_160737_page_add_fields extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PAGE, 'url', 'VARCHAR(255)');
        $this->addColumn(TBL_PAGE, 'is_published', 'enum("yes","no") DEFAULT "no"');
        $this->addColumn(TBL_PAGE, 'updated_at', 'DATETIME NOT NULL');          
	}

	public function down()
	{
        $this->dropColumn(TBL_PAGE, 'updated_at');
        $this->dropColumn(TBL_PAGE, 'is_published');
		$this->dropColumn(TBL_PAGE, 'url');
		return true;
	}

}