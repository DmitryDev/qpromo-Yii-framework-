<?php

defined('TBL_DEVICE') || define('TBL_DEVICE', 'device');

class m121106_231302_device_image_additional_sizes extends CDbMigration
{
    public function up()
	{
        //$this->addColumn(TBL_DEVICE, 'path_small', 'VARCHAR(255) NOT NULL');
        //$this->addColumn(TBL_DEVICE, 'path_tiny', 'VARCHAR(255) NOT NULL');
        //$this->addColumn(TBL_DEVICE, 'path_thumbnail', 'VARCHAR(255) NOT NULL');
	}

	public function down()
	{
        //$this->dropColumn(TBL_DEVICE, 'path_small');
		//$this->dropColumn(TBL_DEVICE, 'path_tiny');
        //$this->dropColumn(TBL_DEVICE, 'path_thumbnail');
        return true;
	}
}