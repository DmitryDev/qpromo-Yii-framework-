<?php
defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');

class m130315_035438_product_seze_and_weight extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_PRODUCT, 'width',    'DECIMAL(7,2) NULL');
        $this->addColumn(TBL_PRODUCT, 'height',   'DECIMAL(7,2) NULL');
        $this->addColumn(TBL_PRODUCT, 'length',   'DECIMAL(7,2) NULL');
        $this->addColumn(TBL_PRODUCT, 'diameter', 'DECIMAL(7,2) NULL');
        $this->addColumn(TBL_PRODUCT, 'size_in',  'VARCHAR(10) NULL');
        $this->addColumn(TBL_PRODUCT, 'weight',   'DECIMAL(7,5) NULL');
        $this->addColumn(TBL_PRODUCT, 'weight_in','VARCHAR(10) NULL');
	}

	public function down()
	{
		$this->dropColumn(TBL_PRODUCT, 'width');
        $this->dropColumn(TBL_PRODUCT, 'height');
        $this->dropColumn(TBL_PRODUCT, 'length');
        $this->dropColumn(TBL_PRODUCT, 'diameter');
        $this->dropColumn(TBL_PRODUCT, 'size_in');
        $this->dropColumn(TBL_PRODUCT, 'weight');
        $this->dropColumn(TBL_PRODUCT, 'weight_in');
		return true;
	}

}