<?php

defined('TBL_PRODUCT') || define('TBL_PRODUCT', 'product');
defined('TBL_COLOR')   || define('TBL_COLOR',   'color');

class m121016_192847_delete_colorid_product_field extends CDbMigration
{
	public function up()
	{
        $this->dropForeignKey('fk_product_color', TBL_PRODUCT);
        $this->dropIndex('fk_product_color', TBL_PRODUCT);
        $this->dropColumn(TBL_PRODUCT, 'color_id');
	}

	public function down()
	{		 
        $this->addColumn(TBL_PRODUCT, 'color_id', 'int default null');

        // Now let's create foreign indexes         
        $this->createIndex('fk_product_color',
                            TBL_PRODUCT, 'color_id');
        $this->addForeignKey('fk_product_color', 
                            TBL_PRODUCT, 'color_id',
                            TBL_COLOR, 'id', 'SET NULL', 'CASCADE');
	}
}