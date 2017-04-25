<?php

defined('TBL_USER')  || define('TBL_USER',  'user');

class m121011_003457_user_default_device extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_USER, 'default_device_id', 'integer');
	}

	public function down()
	{
		$this->dropColumn(TBL_USER, 'default_device_id');
	}
	
}