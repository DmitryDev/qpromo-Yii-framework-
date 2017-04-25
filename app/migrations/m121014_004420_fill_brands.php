<?php

defined('TBL_MANUFACTURER') || define('TBL_MANUFACTURER', 'manufacturer');

class m121014_004420_fill_brands extends CDbMigration
{
	public function up()
	{
        $this->insert(TBL_MANUFACTURER,array('name'=>'Elan'));
        $this->insert(TBL_MANUFACTURER,array('name'=>'FlexGrip'));
        $this->insert(TBL_MANUFACTURER,array('name'=>'Third Records'));
        $this->insert(TBL_MANUFACTURER,array('name'=>'Outfits'));
        $this->insert(TBL_MANUFACTURER,array('name'=>'Adidas'));
	}

	public function down()
	{
		$this->delete(TBL_MANUFACTURER);
	}
}