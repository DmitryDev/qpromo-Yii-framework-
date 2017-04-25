<?php

defined('TBL_SHOPPING_CART') || define('TBL_SHOPPING_CART', 'shopping_cart');

class m121025_151343_shopping_cart_delete_id extends CDbMigration
{
	public function up()
	{
        $this->dropColumn(TBL_SHOPPING_CART, 'id');
        $sql = 'ALTER table `'.TBL_SHOPPING_CART.'`
                  ADD PRIMARY KEY (`user_id`, `product_instance_id`);
                ';
        $this->execute($sql, array());
        
        
	}

	public function down()
	{
        $this->dropIndex('PRIMARY', TBL_SHOPPING_CART);
		$this->addColumn(TBL_SHOPPING_CART, 'id', 'int not null'); //auto_increment ?
	}
}