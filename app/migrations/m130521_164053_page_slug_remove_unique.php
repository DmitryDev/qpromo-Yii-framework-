<?php
defined('TBL_PAGE') || define('TBL_PAGE', 'page');
class m130521_164053_page_slug_remove_unique extends CDbMigration
{
	public function up()
	{
        $this->dropIndex('slug', TBL_PAGE);
	}

	public function down()
	{
		echo "m130521_164053_page_slug_remove_unique does not support migration down.\n";
		return false;
	}
	
}