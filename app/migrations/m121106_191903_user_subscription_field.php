<?php

defined('TBL_USER') || define('TBL_USER', 'user');

class m121106_191903_user_subscription_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_USER, 'subscribed', 'ENUM("yes","no") DEFAULT "no"');
	}

	public function down()
	{
		$this->dropColumn(TBL_USER, 'subscribed');
	}
}