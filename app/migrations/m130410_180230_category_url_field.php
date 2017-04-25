<?php
defined('TBL_CATEGORY') || define('TBL_CATEGORY', 'category');
class m130410_180230_category_url_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_CATEGORY, 'url', 'VARCHAR(255)');
	}

	public function down()
	{
		$this->dropColumn(TBL_CATEGORY, 'url');
		return true;
	}
}