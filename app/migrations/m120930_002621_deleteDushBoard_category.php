<?php

defined('TBL_CATEGORY') || define('TBL_CATEGORY', 'category');

class m120930_002621_deleteDushBoard_category extends CDbMigration
{
	public function up()
	{
        //$this->delete(TBL_CATEGORY, 'tag="dashboard"');
	}

	public function down()
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