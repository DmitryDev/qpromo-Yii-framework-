<?php

defined('TBL_CATEGORY') || define('TBL_CATEGORY', 'category');
class m120924_231015_category extends CDbMigration
{
	public function up()
	{
         /*$this->insert(TBL_CATEGORY, array(
            'name'          => 'Dashboard Products',
            'tag'           => 'dashboard',
            'slug'          => 'dashboard-products',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));*/
	}

	public function down()
	{
		$this->delete(TBL_CATEGORY, 'tag="dashboard"');
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