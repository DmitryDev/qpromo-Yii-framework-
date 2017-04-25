<?php

class m130530_143116_freight_weight extends CDbMigration
{
	public function up()
	{
        $this->dropIndex('PRIMARY', 'freight_fee');
        $sql = 'ALTER TABLE `freight_fee` CHANGE `quantity` `weight` INT';
        $this->execute($sql, array());
        $sql = "ALTER TABLE `qpromo`.`freight_fee` ADD PRIMARY KEY ( `weight`, `value`)";    
        $this->getDbConnection()->createCommand($sql)->execute();        
	}

	public function down()
	{
        $this->dropIndex('PRIMARY', 'freight_fee');
		$sql = 'ALTER TABLE `freight_fee` CHANGE `weight `quantity` INT';
        $this->execute($sql, array());
        $sql = "ALTER TABLE `qpromo`.`freight_fee` ADD PRIMARY KEY ( `quantity`, `value`)";    
        $this->getDbConnection()->createCommand($sql)->execute();
	}
}