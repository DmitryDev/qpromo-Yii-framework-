<?php

defined('TBL_USER') || define('TBL_USER', 'user');

class m130222_031633_user_username extends CDbMigration
{
	public function up()
	{
        $this->update(TBL_USER, array('username'=>'admin'), 'email="admin@store.com"');
        $this->update(TBL_USER, array('username'=>'demo'), 'email="demo@store.com"');
	}

	public function down()
	{		
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