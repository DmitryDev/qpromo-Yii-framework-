<?php

class MarketingCategoriesTree extends CWidget {
    public $editable = false;
    public $model = null;
    
    private $_viewImgUrl;
    private $_editImgUrl;
    private $_deleteImgUrl;
    
    private $_tree;
    
    const RADIO     = 'radio';
    const CHECKBOX  = 'checkbox';
    
    public function init() {
        parent::init();
        
        $assetsDir = dirname(__FILE__).'/assets';
        $cs = Yii::app()->getClientScript();                
               
        
        if ($this->model === null) {
            // Special view mode that allows to explore the whole tree
            // Publishing image.
            $this->_viewImgUrl   = Yii::app()->assetManager->publish("$assetsDir/view.png");
            $this->_deleteImgUrl = Yii::app()->assetManager->publish("$assetsDir/delete.png");
            $this->_editImgUrl   = Yii::app()->assetManager->publish("$assetsDir/update.png");
            
            // Publishing and registering CSS file
            $cs->registerCssFile( Yii::app()->assetManager->publish($assetsDir.'/CategoriesTreeAdminView.css') );
        } else {
            // Regular view/edit mode for managing product/category
            // Publishing and registering CSS file
            $cs->registerCssFile( Yii::app()->assetManager->publish($assetsDir.'/CategoriesTree.css') );
        }
                
        $root = MtCategory::model()->findByAttributes(array('parent_id'=>null));
        if ($this->model === null) {
            $this->_tree = array('children'=>array());
            $this->_buildBranch($this->_tree, $root);
        }
        elseif ($this->model instanceof MtCategory) {
            $selected = $root->id === $this->model->parent->id;
            $options = ($selected && !$this->editable)? 'class="selected"': '';
            $selectControl = $this->_echoSelectControl(self::RADIO, $selected, $root->id);
            $this->_tree = array('children'=>array(
                                                    array( 'text' => "<span $options>{$selectControl}{$root->name}</span>" )
                                                ));
            $this->_buildBranch($this->_tree['children'][0], $root);
        }
        elseif ($this->model instanceof MarketingTool) {
            
            $options = '';
            $selected = false;
            foreach($this->model->mtcategories as $category) {    
                $selected = $category->id === $root->id;
                if ($selected && !$this->editable) {
                    $options = 'class="selected"';
                    break;
                }
            }
            $selectControl = $this->_echoSelectControl(self::CHECKBOX, $selected, $root->id);
            
            $this->_tree = array('children'=>array(
                                                    array( 'text' => "<span $options>{$root->name}</span>" )
                                                ));
            $this->_buildBranch($this->_tree['children'][0], $root);
        }

    }
    
    public function run() {
        $this->render('_view', array('tree' => $this->_tree['children']));        
        parent::run();
    }
    
    private function _buildBranch(&$tree, $root) {        
        if ($root === null) return;
        
        foreach($root->children as $child) {
            if ($this->model === null) {
                // if it's a special view mode
                $controls =  $this->_echoControls($child);
                $content = "<div class=\"tree-item\">{$child->name}{$controls}</div>";                
            }
            elseif($this->model instanceof MtCategory) {
                if ($child->id === $this->model->id) continue;
                $selected = $this->model->parent->id === $child->id;
                $options = ($selected && !$this->editable)? 'class="selected"': '';
                $selectControl = $this->_echoSelectControl(self::RADIO, $selected, $child->id);
                $content = "<span $options>{$selectControl}{$child->name}</span>";
            }
            elseif($this->model instanceof MarketingTool) {
                $options = '';
                $selected = false;
                foreach($this->model->categories as $category) {                
                    $selected = $category->id === $child->id;                    
                    if ($selected && !$this->editable) $options = 'class="selected"';
                    if ($selected) break;
                }
                $selectControl = $this->_echoSelectControl(self::CHECKBOX, $selected, $child->id);
                $content = "<span $options>{$selectControl}{$child->name}</span>";
            }
            
            $branch = array('text'=>$content);
            if (count($child->children)) {
                $branch['children']=array();
                $this->_buildBranch($branch, $child);
            }
            $tree['children'][] = $branch;
        }
    }
    
    private function _echoControls($category) {
        $view_img   = CHtml::image($this->_viewImgUrl);
        $edit_img   = CHtml::image($this->_editImgUrl);
        $delete_img = CHtml::image($this->_deleteImgUrl);

        $view_link  = CHtml::link($view_img,    array('viewCategory',   'id'=>$category->id));
        $edit_link  = CHtml::link($edit_img,    array('updateCategory', 'id'=>$category->id));
        $delete_link= CHtml::link($delete_img,  array('deleteCategory', 'id'=>$category->id), array(
            'confirm'=>"Are you sure you want to delete category \"$category->name\" (all the nested categories will be also deleted)?"
        ));
        
        return "<span>{$view_link}{$edit_link}{$delete_link}</span>";
    }
    
    private function _echoSelectControl($type, $selected, $id) {
        $html = '';
        if ($this->editable) {
            $checked = $selected? "checked=\"checked\"": '';
            switch ($type) {
                case self::RADIO:
                    $html = "<input type=\"$type\" $checked name=\"parent_id\" value=\"$id\">";
                    break;
                case self::CHECKBOX:
                    $html = "<input type=\"$type\" $checked name=\"categories[$id]\">";
                    break;
            }
                
                
           
        }
        return $html;
    }
}