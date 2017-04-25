<?php

defined('TBL_COLOR') || define('TBL_COLOR', 'color');

class m121013_221800_fill_colors extends CDbMigration
{
	public function up()
	{
        /*$this->insert(TBL_COLOR,array('value'=>'#f30'));
        $this->insert(TBL_COLOR,array('value'=>'#f60'));
        $this->insert(TBL_COLOR,array('value'=>'#fc0'));
        $this->insert(TBL_COLOR,array('value'=>'#3f0'));
        $this->insert(TBL_COLOR,array('value'=>'#6f0'));
        $this->insert(TBL_COLOR,array('value'=>'#cf0'));
        $this->insert(TBL_COLOR,array('value'=>'#03f'));
        $this->insert(TBL_COLOR,array('value'=>'#06f'));
        $this->insert(TBL_COLOR,array('value'=>'#0cf'));
        */
        
	}

	public function down()
	{
		//$this->delete(TBL_COLOR);
	}
}