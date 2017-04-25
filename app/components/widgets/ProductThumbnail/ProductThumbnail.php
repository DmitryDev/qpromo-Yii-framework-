<?php

class ProductThumbnail extends CWidget
{           
    public $model   = null;    
            
    public function init() { parent::init(); }

    public function run() {                
        parent::run();
        if ($this->model === null) return null;
        $this->render('_view', array('model'=> $this->model));        
    }        
}

?>
