<?php

class FooterMenu extends CWidget
{           
    private $leftItems = array();
    private $rightItems = array();
            
    public function init() {
        parent::init();    
        if (Yii::app()->user->isGuest)
            $pages = Page::model()->findAllByAttributes(array('is_published'=>'yes', 'logged_in'=>'no'));
        else
            $pages = Page::model()->findAllByAttributes(array('is_published'=>'yes'));
            
        $middle = count($pages) / 2;
        $counter = 0;
        foreach($pages as $page) {
            if ($counter++ < $middle) $this->leftItems[] = $page;
            else $this->rightItems[] = $page;
        }
    }

    public function run() {
        $this->render('_view', array('leftItems'=>$this->leftItems, 'rightItems'=>$this->rightItems));
        parent::run();
    }    
}

?>
