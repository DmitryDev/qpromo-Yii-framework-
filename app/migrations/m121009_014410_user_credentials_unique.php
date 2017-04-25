<?php

defined('TBL_USERCREDENTIALS') || define('TBL_USERCREDENTIALS', 'user_credentials');

class m121009_014410_user_credentials_unique extends CDbMigration
{
	public function up()
	{               
        $this->createIndex('credential_type',TBL_USERCREDENTIALS, 'user_id, type_id', true); //unique                
	}

	public function down()
	{
		$this->dropIndex('credential_type', TBL_USERCREDENTIALS);        
	}
}