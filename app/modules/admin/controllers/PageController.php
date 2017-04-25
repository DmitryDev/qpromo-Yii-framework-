<?php

class PageController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='admin_main';

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
	 * @param integer $id the ID of the model to be displayed
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
        
		$model=new Page;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
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
        
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Page']))
		{
			$model->attributes=$_POST['Page'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/page/index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $this->layout = 'admin_column2';
        $criteria = new CDbCriteria();        
        
		$dataProvider=new CActiveDataProvider('Page');
        $dataProvider->criteria = $criteria;
        
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Page::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
    
    public function actionCreateSection($page)
	{
        $this->layout = 'admin_column2';        
        $page = $this->loadModel($page);                
                
		$model=new PageSection;
        $model->page_id = $page->id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PageSection']))
		{
			$model->attributes=$_POST['PageSection'];
			if($model->save())
				$this->redirect(array('viewSection','id'=>$model->id));
		}

		$this->render('createSection',array(
            'page' =>$page,
			'model'=>$model,
		));
    }
    
    public function actionUpdateSection($id)
	{
        $this->layout = 'admin_column2';        
        
		$model=PageSection::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');		

        $page = $model->page;
        
		if(isset($_POST['PageSection']))
		{
			$model->attributes=$_POST['PageSection'];
			if($model->save())
				$this->redirect(array('viewSection','id'=>$model->id));
		}

		$this->render('updateSection',array(
            'page' =>$page,
			'model'=>$model,
		));
    }
    
    public function actionViewSection($id)
	{
        $this->layout = 'admin_column2';
        $model=PageSection::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');		
        
		$this->render('viewSection',array(
			'model'=>$model,
		));
	}
    
    public function actionDeleteSection($id)
	{        
        $model=PageSection::model()->findByPk($id);
        if ($model !== null) {
            $page_id = $model->page->id;
            $model->delete();
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if ($page_id) $url = $this->createUrl('/admin/page/view', array('id'=>$page_id));
        else $url = $this->createUrl('/admin/page/index');
            
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : $url);
	}
    
    // --------------Section Items Actions ----------------------------------------------------
    public function actionCreateItem($section)
	{
        $this->layout = 'admin_column2';        
        $section = PageSection::model()->findByPk($section);                
        if($section===null)
			throw new CHttpException(404,'The requested page does not exist.');		
        
		$model=new PageSectionItem;
        $model->section_id = $section->id;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PageSectionItem']))
		{
			$model->attributes=$_POST['PageSectionItem'];
                       
			if($model->save()) {
                $model->fileUploader = CUploadedFile::getInstanceByName('PageSectionItem[file]');
                if ($model->uploadFile() && !$model->hasErrors())
                        $this->redirect(array('viewSection','id'=>$model->section_id));
                    else {
                        if ($model->hasErrors('fileUploader'))
                            Yii::app()->user->setFlash('fileUploaderError', $model->getError('fileUploader'));
                        $this->redirect(array('updateItem','id'=>$model->id));
                }
                
            }
				
		}

		$this->render('createSectionItem',array(
            'section' =>$section,
			'model'=>$model,
		));
    }
    
    public function actionUpdateItem($id)
	{
        $this->layout = 'admin_column2';        
        
		$model=PageSectionItem::model()->findByPk($id);
        
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');		        
        
        if (Yii::app()->user->hasFlash('fileUploaderError'))
            $model->addError('fileUploader', Yii::app()->user->getFlash('fileUploaderError'));
		if(isset($_POST['PageSectionItem']))
		{
			$model->attributes=$_POST['PageSectionItem'];
            if($model->save()) {
                if (isset($_POST['PageSectionItem']['deleteFile'])) {
                    $model->deleteFile();
                }
                
                $model->fileUploader = CUploadedFile::getInstanceByName('PageSectionItem[file]');
                if ($model->uploadFile() && !$model->hasErrors())
                        $this->redirect(array('viewSection','id'=>$model->section_id));
                    else {
                        if ($model->hasErrors('fileUploader'))
                            Yii::app()->user->setFlash('fileUploaderError', $model->getError('fileUploader'));
                        $this->redirect(array('updateItem','id'=>$model->id));
                }
                
            }
		}

		$this->render('updateSectionItem',array(            
			'model'=>$model,
		));
    }
    
    /*public function actionViewSection($id)
	{
        $this->layout = 'admin_column2';
        $model=PageSection::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');		
        
		$this->render('viewSection',array(
			'model'=>$model,
		));
	}*/
    
    public function actionDeleteItem($id)
	{        
        $model=PageSectionItem::model()->findByPk($id);
        if ($model !== null) {
            $section_id = $model->section->id;
            $model->delete();
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if ($section_id) $url = $this->createUrl('/admin/page/viewSection', array('id'=>$section_id));
        else $url = $this->createUrl('/admin/page/index');
            
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : $url);
	}
    
    
    //----------------------------------------------------------------------------------------

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='page-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}   
}
