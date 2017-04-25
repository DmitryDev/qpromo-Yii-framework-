<?php

class UserController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '/layouts/column2', meaning
     * using two-column layout. See 'admin/views/layouts/column2.php'.
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
            'mayBeDeleted + delete', //perform user deletion control
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
        $cs = Yii::app()->getClientScript();                        
        //$cs->registerCoreScript("jquery");
        
        // Registering CSS file        
        $css = $this->module->basePath . '/css/user.css';        
        $cs->registerCssFile(Yii::app()->assetManager->publish($css));      
        
        $this->layout = 'admin_column2';        
        $userModel = $this->loadModel($id);
        
        $userRoles = array();
        foreach ($userModel->userRoles as $role) $userRoles[]= $role->itemname;
        $userRoles = implode(', ', $userRoles);
        
        $shippingAddress = null;
        if ($userModel->default_shipping_address)
            $shippingAddress = UserAddress::model()->findByPk($userModel->default_shipping_address);
        
        $billingAddress = null;
        if ($userModel->default_billing_address)
            $billingAddress = UserAddress::model()->findByPk($userModel->default_billing_address);
        
        $this->render('view',array(
            'model'=>$userModel,
            'roles'=>$userRoles,
            'shippingAddr'=>$shippingAddress,
            'billingAddr'=>$billingAddress,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->layout = 'admin_column2';
        $model=new UserEntryForm('create');        
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['UserEntryForm']))
        {                                    
            $model->attributes= Yii::app()->request->getPost('UserEntryForm');                                        
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));                        
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
        $model = new UserEntryForm('update');           
        $model->init($id);                

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-entry-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['UserEntryForm']))
        {
            $model->attributes=Yii::app()->request->getPost('UserEntryForm');
            // validate user input and redirect to the previous page if valid
            if($model->save()) {                                          
                $this->redirect(array('view','id'=>$model->id));
            }
        }
        
        $this->render('update',array(
                'model'=>$model,                
        ));
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
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('user/index'));
    }

    /**
     * Manage all users.
     */
    public function actionIndex($pageSize = null)
    {
        $model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
                $model->attributes=$_GET['User'];
        
        $pageSize = isset($pageSize)? $pageSize : 10;
        if ($pageSize === 'all') $pageSize = 1000000;
        
        $this->render('index',array(
                'model'=>$model,
                'pageSize' => $pageSize,
        ));
    }
   

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=User::model()->findByPk($id);                
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
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function filterMayBeDeleted($filterChain) {        
        $id = Yii::app()->request->getParam('id');        
        
        //if (Order::model()->findByAttributes(array('user_id'=>$id)) !== null)
        //    throw new CHttpException(403, 'The user has orders assigned. Can\'t be deleted.');
        
        if ( !Yii::app()->user->isGuest &&
              Yii::app()->user->id !== $id ) $filterChain->run();
        else throw new CHttpException(403, 'You are not allowed to delete yourself.');                
    }        
    
    
}
