<?php

class CategoryController extends Controller
{   
    /**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    public $layout = 'admin_main';
    
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations			
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions                                                            
                    'roles'=>array('admin')),
            array('deny',  // deny all users
                    'users'=>array('*'))									
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $this->layout = 'admin_column2';    
        $model = $this->loadModel($id);
        $root_id = $model->getRootNode();
        
		$this->render('view',array(
			'model'=> $model,
            'root_id'=>$root_id
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
     * 
	 */
	public function actionCreate()
	{
        $this->layout = 'admin_column2';    
		$model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{                                
			$model->attributes=$_POST['Category'];            
            $root = Category::model()->findByAttributes(array('parent_id'=>null));
            $model->parent_id = (isset($_POST['parent_id']) && $_POST['parent_id'])? $_POST['parent_id']:$root->id;
            
            if ($root !==null && !$model->parent_id) $model->parent_id = $root->id;
            
			if($model->save()) $this->redirect(array('index'));
		}

		$this->render('create',array('model'=>$model));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{             
        $this->layout = 'admin_column2';    
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
            $root = Category::model()->findByAttributes(array('parent_id'=>null));
            if ($root !==null && !$model->parent_id) $model->parent_id = $root->id;
            $model->parent_id = (isset($_POST['parent_id']) && $_POST['parent_id'])? $_POST['parent_id']:$root->id;
            
			if($model->save()) $this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update', array('model'=>$model));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{        
        $model = Category::model()->findByPk($id);                
        
        if($model===null || $model->parent_id===null)
                throw new CHttpException(404,'The requested page does not exist.'); 
        
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		//$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
		//	'dataProvider'=>$dataProvider,
            'tabs' => $this->getTabs()
		));
	}
    
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    private function getTabs()
    {
        $criteria=new CDbCriteria;
		$criteria->condition = 'parent_id is NULL AND is_published="yes"';        
        $criteria->order = 't.order';        		
        $root_cats=Category::model()->findAll($criteria);
        
        $tabs = array();
        foreach ($root_cats as $cat)
        {
            $tab = array();
            $tab['title'] = $cat->name;
            $tab['view'] ='_tab_view';
            $tab['data'] = array('root_id'=>$cat->id);
            $tabs[] = $tab;       
        }
        
        return $tabs;
    }
    

}
