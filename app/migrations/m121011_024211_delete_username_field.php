<?php

defined('TBL_USER')  || define('TBL_USER',  'user');

class m121011_024211_delete_username_field extends CDbMigration
{
	public function up()
	{
        $this->dropColumn(TBL_USER, 'user_name');
	}

	public function down()
	{
        $this->addColumn(TBL_USER, 'user_name', 'VARCHAR(32) NOT NULL');
	}
	
}