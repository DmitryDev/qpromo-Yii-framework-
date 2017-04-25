<?php

class MarketingController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	 public $layout = 'admin_main';

     public function __construct($id, $module = null) {
        parent::__construct($id, $module);                
        
        $cs = Yii::app()->getClientScript();        
        $cs->registerCssFile(Yii::app()->assetManager->publish($this->module->basePath . '/css/admin.css'));    
    }
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
	 * @param integer $id the name of the model to be displayed
	 */
	public function actionView($id)
	{
        $this->layout = 'admin_column2';
        
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        $this->layout = 'admin_column2';        
		$model=new MarketingTool;
        
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['MarketingTool']))
		{                                    
			$model->attributes=$_POST['MarketingTool'];
			
            $model->updateCategories = true;
            $model->setCategories( array_keys($_POST['categories']) );
                        
            if ($model->save()) {
                $model->imageUploader = CUploadedFile::getInstanceByName('MarketingTool[image]');
                
                if ($model->uploadImage() && !$model->hasErrors())
                    $this->redirect(array('view','id'=>$model->id));       
                else {
                    if ($model->hasErrors('imageUploader'))
                        Yii::app()->user->setFlash('imageUploaderError', $model->getError('imageUploader'));
                    $this->redirect(array('update','id'=>$model->id));
                }
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
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
		$this->performAjaxValidation($model);
        
        if (Yii::app()->user->hasFlash('imageUploaderError'))
            $model->addError('imageUploader', Yii::app()->user->getFlash('imageUploaderError'));
        
		if(isset($_POST['MarketingTool']))
		{            
            $model->imageUploader = CUploadedFile::getInstanceByName('MarketingTool[image]');
            
            $model->updateCategories = true;
            $model->setCategories( array_keys($_POST['categories']) );
            
			$model->attributes=$_POST['MarketingTool'];
            if ($_POST['MarketingTool']['deleteImage']) {
                $model->deleteImage();
                $model->image = NULL;                
                $model->thumbnail = NULL;                
            }
			if($model->save() && $model->uploadImage() && !$model->hasErrors())
				$this->redirect(array('view','id'=>$model->id));                        
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($pageSize = null)
	{
		$model=new MarketingTool('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Marketing']))
			$model->attributes=$_GET['Marketing'];

        $pageSize = isset($pageSize)? $pageSize : 10;
        if ($pageSize === 'all') $pageSize = 1000000;
        
		$this->render('index', array('model'=>$model,'pageSize' => $pageSize));
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=MarketingTool::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='marketing-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    /**
	 * Lists all marketing category models.
	 */
	public function actionCategoriesList()
	{		
		$this->render('categoriesList');
	}
    
    /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
     * 
	 */
	public function actionCreateCategory()
	{
        $this->layout = 'admin_column2';    
		$model=new MtCategory;

		if(isset($_POST['MtCategory']))
		{                                
			$model->attributes=$_POST['MtCategory'];            
            $root = MtCategory::model()->findByAttributes(array('parent_id'=>null));
            $model->parent_id = (isset($_POST['parent_id']) && $_POST['parent_id'])? $_POST['parent_id']:$root->id;
            
            if ($root !==null && !$model->parent_id) $model->parent_id = $root->id;
            
			if($model->save()) $this->redirect(array('categoriesList'));
		}

		$this->render('createCategory',array('model'=>$model));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdateCategory($id)
	{             
        $this->layout = 'admin_column2';    
		$model=$this->loadMtCategoryModel($id);
		

		if(isset($_POST['MtCategory']))
		{
			$model->attributes=$_POST['MtCategory'];
            $root = MtCategory::model()->findByAttributes(array('parent_id'=>null));
            if ($root !==null && !$model->parent_id) $model->parent_id = $root->id;
            $model->parent_id = (isset($_POST['parent_id']) && $_POST['parent_id'])? $_POST['parent_id']:$root->id;
            
			if($model->save()) $this->redirect(array('viewCategory','id'=>$model->id));
		}

		$this->render('updateCategory', array('model'=>$model));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteCategory($id)
	{        
        $model = MtCategory::model()->findByPk($id);                
        
        if($model===null || $model->parent_id===null)
                throw new CHttpException(404,'The requested page does not exist.'); 
        
		$this->loadMtCategoryModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('categoriesList'));
	}
    
    /**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewCategory($id)
	{
        $this->layout = 'admin_column2';    
        $model = $this->loadMtCategoryModel($id);
        $root_id = $model->getRootNode();
        
		$this->render('viewCategory',array(
			'model'=> $model,
            'root_id'=>$root_id
		));
	}
    
    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadMtCategoryModel($id)
	{
		$model=MtCategory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	
}
