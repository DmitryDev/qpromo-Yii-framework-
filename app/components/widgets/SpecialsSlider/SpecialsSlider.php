<?php

class SpecialsSlider extends CWidget
{           
    private $_specials;
            
    public function init() {
        parent::init();
        $this->_specials = Specials::model()->findAll("is_published=:published", array(':published'=>'yes'));
    }

    public function run() {
        $this->render('_view', array('specials'=>$this->_specials));
        parent::run();
    }        
}

?>
