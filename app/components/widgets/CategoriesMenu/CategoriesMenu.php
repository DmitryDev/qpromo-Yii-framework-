<?php

class CategoriesMenu extends CWidget
{           
    private $_root;
    private $_topParentId = 0;
            
    public function init() {
        parent::init();
        $this->_root = Category::model()->findByAttributes(array('parent_id'=>null));
                
        if ($this->controller->id == 'collection') {
            $category = Category::model()->findByPk(Yii::app()->request->getParam('id'));            
            if ($category !== null && $this->_root !== null) {
                $topParent = $category;
                while($topParent->parent_id != $this->_root->id) $topParent = Category::model()->findByPk($topParent->parent_id);
                $this->_topParentId = $topParent->id;
            }
        }
    }

    public function run() {
        $this->render('_view', array('root'=>$this->_root));
        parent::run();
    }
    
    public function categoriesList($category) {        
        if ($category->is_published=='no') return '';
        $html  = '<li>';
        
        $url = (!$category->parent->parent && $this->controller->_is_mobile())
            ? 'javascript:void(0);'
            :Yii::app()->createUrl('collection/view', array('id'=>$category->id));
        
        if (!$category->parent->parent && $this->controller->_is_mobile())
            $url = 'javascript:void(0);';
        else
            $url = empty($category->url)
                ? $url = Yii::app()->createUrl('collection/view', array('id'=>$category->id))
                : $url = $category->url;
  
        
        if ($category->id == $this->_topParentId) {
                $html .= CHtml::link($category->name, $url, array('class'=>'active', 'data-id'=>$category->id));
        }
        else {
            $html .= CHtml::link($category->name, $url, array('data-id'=>$category->id));
        }        
        
        if (count($category->children)) {            
            $html .= '<ul>';            
            foreach($category->children as $child) $html .= $this->categoriesList($child);            
            $html .= '</ul>';
        }
        
        $html .= '</li>';
        
        return $html;
    }

}

?>
