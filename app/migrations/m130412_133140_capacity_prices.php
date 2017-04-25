<?php
defined('TBL_PRODUCT_PRICE') || define('TBL_PRODUCT_PRICE', 'product_price');

class m130412_133140_capacity_prices extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PRODUCT_PRICE, 'capacity', 'INT DEFAULT 0');
        
        $this->dropIndex('PRIMARY', TBL_PRODUCT_PRICE);                
        $sql = "ALTER TABLE `qpromo`.`product_price` ADD PRIMARY KEY ( `product_id` , `capacity` , `quantity` )";    
        $this->getDbConnection()->createCommand($sql)->execute();        
	}

	public function down()
	{        
        $this->dropIndex('PRIMARY', TBL_PRODUCT_PRICE);
        $sql = "ALTER TABLE `qpromo`.`product_price` ADD PRIMARY KEY ( `product_id` , `quantity` )";    
        $this->getDbConnection()->createCommand($sql)->execute();        
        $this->dropColumn(TBL_PRODUCT_PRICE, 'capacity');
        
		return true;
	}

}