<?php

class m130506_230254_freight_changed_field_name extends CDbMigration
{
	public function up()
	{
        $this->dropIndex('PRIMARY', 'freight_fee');
        $sql = 'ALTER TABLE `freight_fee` CHANGE `freight` `quantity` INT';
        $this->execute($sql, array());
        $sql = "ALTER TABLE `qpromo`.`freight_fee` ADD PRIMARY KEY ( `quantity`, `value`)";    
        $this->getDbConnection()->createCommand($sql)->execute();        
	}

	public function down()
	{
        $this->dropIndex('PRIMARY', 'freight_fee');
		$sql = 'ALTER TABLE `freight_fee` CHANGE `quantity` `freight` DECIMAL(6,2)';
        $this->execute($sql, array());
        $sql = "ALTER TABLE `qpromo`.`freight_fee` ADD PRIMARY KEY ( `freight`, `value`)";    
        $this->getDbConnection()->createCommand($sql)->execute();
	}
}