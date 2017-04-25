<?php
defined('TBL_CATEGORY') || define('TBL_CATEGORY', 'category');

class m130311_230548_category_description extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_CATEGORY, 'description', 'TEXT');
	}

	public function down()
	{
		$this->dropColumn(TBL_CATEGORY, 'description');
		return true;
	}
}