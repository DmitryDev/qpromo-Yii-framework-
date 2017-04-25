<?php
defined('TBL_EVENT') || define('TBL_EVENT', 'event');
class m130425_010614_event_duration extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_EVENT, 'duration', 'INT NOT NULL DEFAULT 1');
	}

	public function down()
	{
		$this->dropColumn(TBL_EVENT, 'duration');
		return true;
	}
}