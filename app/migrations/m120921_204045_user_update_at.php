<?php

class m120921_204045_user_update_at extends CDbMigration
{
	public function up()
	{
        $sql = 'ALTER TABLE `user` CHANGE `created_at` `updated_at` DATETIME NOT NULL';
        $this->execute($sql, array());
	}

	public function down()
	{
		$sql = 'ALTER TABLE `user` CHANGE `updated_at` `created_at` DATETIME NOT NULL';
        $this->execute($sql, array());		
	}
}