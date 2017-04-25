<?php
defined('TBL_PAGE') || define('TBL_PAGE', 'page');

class m130528_134936_page_loggedin_link extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PAGE, 'logged_in', 'enum("yes","no") DEFAULT "no"');
	}

	public function down()
	{
		$this->dropColumn(TBL_PAGE, 'logged_in');
		return true;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}