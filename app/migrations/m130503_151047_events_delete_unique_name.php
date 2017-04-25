<?php
defined('TBL_EVENT') || define('TBL_EVENT', 'event');
class m130503_151047_events_delete_unique_name extends CDbMigration
{
	public function up()
	{
        $this->dropIndex('name', TBL_EVENT);
	}

	public function down()
	{
		echo "m130503_151047_events_delete_unique_name does not support migration down.\n";
		return false;
	}
}