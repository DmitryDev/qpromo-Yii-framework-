<?php
defined('TBL_PRICE_CODE') || define('TBL_PRICE_CODE', 'price_code');
class m130430_223010_price_code_value extends CDbMigration
{
	public function up()
	{
        $this->update(TBL_PRICE_CODE, array('discount'=>'50'), '`code`="A" OR `code`="P"');
        $this->update(TBL_PRICE_CODE, array('discount'=>'45'), '`code`="B" OR `code`="Q"');
        $this->update(TBL_PRICE_CODE, array('discount'=>'40'), '`code`="C" OR `code`="R"');
        $this->update(TBL_PRICE_CODE, array('discount'=>'35'), '`code`="D" OR `code`="S"');
        $this->update(TBL_PRICE_CODE, array('discount'=>'30'), '`code`="E" OR `code`="T"');
        $this->update(TBL_PRICE_CODE, array('discount'=>'25'), '`code`="F" OR `code`="U"');
        $this->update(TBL_PRICE_CODE, array('discount'=>'20'), '`code`="G" OR `code`="V"');
        $this->update(TBL_PRICE_CODE, array('discount'=>'15'), '`code`="H" OR `code`="W"');
	}

	public function down()
	{
		echo "m130430_223010_price_code_value does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}