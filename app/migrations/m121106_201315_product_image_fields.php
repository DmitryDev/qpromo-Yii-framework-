<?php

defined('TBL_PRODUCT_IMAGE') || define('TBL_PRODUCT_IMAGE', 'product_image');

class m121106_201315_product_image_fields extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PRODUCT_IMAGE, 'path_tiny', 'VARCHAR(255) NOT NULL');
        $this->addColumn(TBL_PRODUCT_IMAGE, 'path_thumbnail', 'VARCHAR(255) NOT NULL');
	}

	public function down()
	{
		$this->dropColumn(TBL_PRODUCT_IMAGE, 'path_tiny');
        $this->dropColumn(TBL_PRODUCT_IMAGE, 'path_thumbnail');
	}
	
}