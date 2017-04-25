<?php

defined('TBL_TOKEN') || define('TBL_TOKEN', 'token');

class m121009_195252_token_tag extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_TOKEN, 'tag', 'VARCHAR(255)');
	}

	public function down()
	{
		$this->dropColumn(TBL_TOKEN, 'tag');
	}
}