<?php

defined('TBL_USER') || define('TBL_USER', 'user');

class m130221_221758_user_changed extends CDbMigration
{
	public function up()
	{
        $this->dropColumn(TBL_USER, 'default_device_id');
        $this->addColumn(TBL_USER, 'created_at', 'DATETIME NOT NULL');
        $this->addColumn(TBL_USER, 'username', 'VARCHAR(32) NOT NULL');
        $this->addColumn(TBL_USER, 'phone', 'VARCHAR(20)');
        $this->addColumn(TBL_USER, 'company', 'VARCHAR(32) NOT NULL');
	}

	public function down()
	{
        $this->dropColumn(TBL_USER, 'company');
        $this->dropColumn(TBL_USER, 'phone');
        $this->dropColumn(TBL_USER, 'username');
        $this->dropColumn(TBL_USER, 'created_at');
		$this->addColumn(TBL_USER, 'default_device_id', 'INT DEFAULT NULL');        
	}
}