<?php

class CollectionController extends Controller
{        
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionView($id)
    {        
        $root = Category::model()->findByAttributes(array('parent_id'=>null));
        $category = Category::model()->findByPk($id);
        if ($category === null)
            throw new CHttpException(404,"Page doesn't exist");
        
        Yii::app()->user->setFlash('backToCategory', $category);
        
        $categoriesIds = array(); //list of all categories ids starting from selected root
        Category::buildCategoriesList($categoriesIds, $category->id);
        
        
        $criteria = $this->buildCriteria($categoriesIds, '`release_date` DESC, `viewed` DESC');
        $products = Product::model()->findAll($criteria);
             
        if(isset($_POST['ajax']) && $_POST['ajax']==='slide-selector') {
			foreach($products as $product) {
                $this->widget('ProductThumbnail', array('model'=>$product));
            }
			Yii::app()->end();
		}
        
        $cs = Yii::app()->getClientScript();                              
        
        // registering JavaScript file        
        $cs->registerScriptFile('/js/page_collection.js', CClientScript::POS_END);
                                
        // renders the view file 'views/site/index.php'
        // using the default layout 'views/layouts/main.php'         
        $this->pageTitle=$category->name . ' Products';
        
        $subcategories = $category->parent->children;
        if ($category->parent->id == $root->id) $subcategories = null;
        
        
        $this->render('view', array('category'=>$category, 'subcategories'=>$subcategories, 'products'=>$products));
    }
    
    private function buildCriteria($categories, $sortBy, $limit, $offset)
    {        
        $criteria = new CDbCriteria;        
        $criteria->with = array('categories');        

        if (isset($categories) && count($categories))
        {
            $categories = implode(',', $categories);            
            if ($criteria->condition !=='') $criteria->condition .= " AND `categories`.`id` in($categories) AND `categories`.`is_published`=\"yes\" ";        
            else $criteria->condition .= " `categories`.`id` in($categories) AND `categories`.`is_published`=\"yes\" ";   
        }
        
        if ($criteria->condition !=='') $criteria->condition .= " AND t.`is_published`=\"yes\" AND t.`deleted`=0 ";        
        else $criteria->condition .= " t.`is_published`=\"yes\" t.`deleted`=0 ";              
                                
        if (isset($limit)) $criteria->limit = $limit;
        if (isset($offset)) $criteria->offset = $offset;        
                
        $criteria->order=$sortBy;
        $criteria->together = true;
        $criteria->group = 't.id';
        
        return $criteria;
    }
    
   
}