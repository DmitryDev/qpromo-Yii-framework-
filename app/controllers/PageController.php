<?php

class PageController extends Controller
{              
    public function actionView($id=0, $slug='')
    {
        if ($id) $page = Page::model()->findByPk($id);
        elseif (!empty($slug)) $page = Page::model()->findByAttributes(array('slug'=>$slug));
        else $page = null;
                    
        $this->pageTitle=Yii::app()->name . ' - ' . $page->name;
        $this->render('view', array('page'=>$page));
    }
}

?>
