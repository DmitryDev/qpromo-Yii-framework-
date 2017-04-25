<?php

defined('TBL_USER') || define('TBL_USER', 'user');

class m121103_000701_user_additional_fields extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_USER, 'default_shipping_address', 'int default null');
        $this->addColumn(TBL_USER, 'default_billing_address',  'int default null');        
	}

	public function down()
	{
        $this->dropColumn(TBL_USER, 'default_billing_address');
		$this->dropColumn(TBL_USER, 'default_shipping_address');
	}
}