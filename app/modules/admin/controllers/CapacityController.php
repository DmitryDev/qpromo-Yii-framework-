<?php

class CapacityController extends Controller
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
		$model=new Capacity;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Capacity'])) {            
		    $model->attributes=$_POST['Capacity'];			
		    if ($model->save()) $this->redirect(array('view','id'=>$model->id));
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
        
        $model->formEntry = 0;
        if ($model->value < 1024) {
            $model->formEntry = $model->value;
            $model->units = '1';
        }
        if ($model->value >= 1024 && $model->value < 1024*1024 ) {
            $model->formEntry = number_format($model->value/1024);
            $model->units = '1024';
        }
        if ($model->value >= 1024*1024 ) {
            $model->formEntry = number_format($model->value/(1024*1024));         
            $model->units = '1048576';
        }
        
        $model->formEntry = str_replace(',', '', $model->formEntry);        

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                
		if(isset($_POST['Capacity']))
		{                        
			$model->attributes=$_POST['Capacity'];
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
		$model=new Capacity('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Capacity']))
			$model->attributes=$_GET['Capacity'];

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
		$model = Capacity::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='capacity-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
   
}
