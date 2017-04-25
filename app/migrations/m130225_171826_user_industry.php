<?php
defined('TBL_USER') || define('TBL_USER', 'user');

class m130225_171826_user_industry extends CDbMigration
{
	public function up()
	{
        $this->addColumn(TBL_USER, 'industry_asi',  'VARCHAR(10) DEFAULT NULL');
        $this->addColumn(TBL_USER, 'industry_ppai', 'VARCHAR(10) DEFAULT NULL');
        $this->addColumn(TBL_USER, 'industry_sage', 'VARCHAR(10) DEFAULT NULL');
        $this->addColumn(TBL_USER, 'industry_upic', 'VARCHAR(10) DEFAULT NULL');
	}

	public function down()
	{
        $this->dropColumn(TBL_USER, 'industry_upic');
        $this->dropColumn(TBL_USER, 'industry_sage');
        $this->dropColumn(TBL_USER, 'industry_ppai');
        $this->dropColumn(TBL_USER, 'industry_asi');
		return true;
	}
}