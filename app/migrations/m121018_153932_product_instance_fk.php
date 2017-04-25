<?php
defined('TBL_PRODUCT_INSTANCE') || define('TBL_PRODUCT_INSTANCE', 'product_instance');
class m121018_153932_product_instance_fk extends CDbMigration
{
	public function up()
	{
        $this->dropIndex('product_id', TBL_PRODUCT_INSTANCE);
	}

	public function down()
	{
		 $this->createIndex('product_id',
                            TBL_PRODUCT_INSTANCE, 'product_id, color_id', true);
	}
}