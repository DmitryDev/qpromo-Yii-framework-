<?php
defined('TBL_USER') || define('TBL_USER', 'user');

class m130104_181821_user_banned_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_USER, 'is_banned', 'enum("no", "yes") default "no"');
	}

	public function down()
	{
		$this->dropColumn(TBL_USER, 'is_banned');
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