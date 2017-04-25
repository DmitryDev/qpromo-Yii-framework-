<?php

class ProductController extends Controller
{    	
    /**
     * Product class constructor
     * 
     * @param type $id
     * @param type $module
     */
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);        
        $this->layout = 'admin_column2';
        
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript("jquery");
        $cs->registerCoreScript("jquery.ui");                
        
        // Register Color Picker
        $colorPicker = Yii::app()->assetManager->publish($this->module->basePath . '/js/colorpicker');
        $cs->registerCssFile("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/ui-lightness/jquery-ui.css");
        $cs->registerCssFile($colorPicker . '/jquery.colorpicker.css');
        $cs->registerScriptFile($colorPicker . '/jquery.colorpicker.js', CClientScript::POS_END );
        
        $cs->registerCssFile(Yii::app()->assetManager->publish($this->module->basePath . '/css/admin.css'));
        $cs->registerScriptFile(Yii::app()->assetManager->publish($this->module->basePath . '/js/product.js'), CClientScript::POS_END );
    }

    /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations			
            'markDeleted + delete', //perform product virtual deletion (just mark on as deleted but don't delete the record from db)
            'notDeleted + update'// can be updated if is not marked as deleted
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
        $model = $this->loadModel($id);
        
        $this->breadcrumbs=array(
            'Products'=>array('index'),
            $model->name
        );
                
        $this->menu = $this->buildMenu($model, array('list','add','update','calculate','delete'));
                
        $rootCategory = Category::model()->findByAttributes(array('parent_id'=>null));
        if($rootCategory===null) throw new CHttpException(404,"Root category doesn't exist.");
        
        $colors = '';
        foreach($model->colorsArray as $color) {
            if (!empty($color))
                $colors .= "<span class=\"color-marker\" style=\"background-color: #$color;\"></span>";
        }
        
        $detailViewAttributes = array(
                        'name', 'model_number', 'is_published', 'updated_at', 'release_date', 'description', 'tags', 'viewed',
                        
                        array (
                            'label'=>'Width',
                            'type'=>'raw',
                            'value'=>number_format($model->width, 2).$model->size_in
                        ),
                        array (
                            'label'=>'Height',
                            'type'=>'raw',
                            'value'=>number_format($model->height, 2).$model->size_in
                        ),
                        array (
                            'label'=>'Length',
                            'type'=>'raw',
                            'value'=>number_format($model->length, 2).$model->size_in
                        ),
                        array (
                            'label'=>'Diameter',
                            'type'=>'raw',
                            'value'=>number_format($model->diameter, 2).$model->size_in
                        ),
                        array (
                            'label'=>'Weight',
                            'type'=>'raw',
                            'value'=>number_format($model->weight, 5).$model->weight_in
                        ),
                        array (
                            'label'=>'Colors',
                            'type'=>'raw',
                            'value'=>$colors
                        ),                        
                        'custom_color',
        );
        
        $imprint = ProductImprint::model()->findByAttributes(array('product_id'=>$model->id));
        $imprintAttributes = array();
        if ($imprint !== null) {
            $printings = array();
            foreach(split(',', $imprint->printings) as $id) {
                $printingMethod = Printing::model()->findByPk($id);
                if($printingMethod !== null) $printings[]= $printingMethod->name;
            }
            $imprintAttributes = array(
                array (
                    'label'=>'Width',
                    'type'=>'raw',
                    'value'=>number_format($imprint->width, 2).'"'
                ),
                array (
                    'label'=>'Height',
                    'type'=>'raw',
                    'value'=>number_format($imprint->height, 2).'"'
                ),
                'areas',
                array (
                    'label'=>'Printing Methods',
                    'type'=>'raw',
                    'value'=> join('; ', $printings)
                ),
            );
        }
               
    
        
                
		$this->render('view',array(
			'model'=>$model,
            'rootCategory'=>$rootCategory->id,
            'colors'=>$colors,
            'viewAttributes'=>$detailViewAttributes,
            'imprint'=>$imprint,
            'imprintAttributes'=>$imprintAttributes,
		));
	}

    /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
    {
        $model=new Product;
        
        $this->edit($model);
        
        $this->breadcrumbs=array(
            'Products'=>array('index'),
            'Create',
        );

        $this->menu = $this->buildMenu($model, array('list'));        
        
        $capacities = array(0=>'No Capacity');
        foreach(Capacity::model()->findAll() as $capacity)            
            $capacities[$capacity->value] = $this->translateCapacity($capacity->value);
        
        $this->render('create',array('model'=>$model, 'capacities'=>$capacities));
    }
    
    /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
    public function actionUpdate($id)
	{
        $model=$this->loadModel($id);
        $this->edit($model);                                               
        
        $this->breadcrumbs=array(
            'Products'=>array('index'),
            $model->name=>array('view','id'=>$model->id),
            'Update',
        );

        $this->menu = $this->buildMenu($model, array('list','add','view','calculate','delete'));
        $capacities = array(0=>'No Capacity');
        foreach(Capacity::model()->findAll() as $capacity)            
            $capacities[$capacity->value] = $this->translateCapacity($capacity->value);
                
        $this->render('update',array('model'=>$model, 'colors'=>$model->colorsArray, 'capacities'=>$capacities));
    }
     
    
    /**
     * This methos is called inside create and update actions cause the code flow is the same
     * @param type $model Product model that is being created/updated
     */
    private function edit(&$model)
    {
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);                
        
        if (Yii::app()->user->hasFlash('uploadedImagesError'))
            $model->addError('uploadedImages', Yii::app()->user->getFlash('uploadedImagesError'));

           
            
		if(isset($_POST['Product']))
		{
            
      
            $colors = array();
            foreach($_POST['Product']['color'] as $color) {
                if ($color['delete']) continue;
                $colors[]=$color['value'];
            }
                        
            if (isset($_POST['Product']['newColors'])) {//multiple colors if JS enabled
                foreach($_POST['Product']['newColors'] as $newcolor) {
                    $newcolor = trim($newcolor);
                    if (!empty($newcolor)) $colors[]=$newcolor;
                }
            }
                
            elseif (isset($_POST['Product']['newColor'])) {
                  $newcolor = trim($_POST['Product']['newColor']);
                  if (!empty($newcolor)) $colors[]=$newcolor;
            }

            $model->colors = join(';', $colors);
            $model->attributes=$_POST['Product'];
            
            $model->updateCategories = true;
            $model->setCategories( array_keys($_POST['categories']) );
            $model->price_code_id = $_POST['priceCode'];
            $model->sample_price = $_POST['sample_price'];
            $model->is_new = $_POST['isNewRelease'];
                                        
			if($model->save())
            {
            	
            	// Pricing
                ProductPrices::updatePrices($model, $_POST);
                
                             
                if ($_POST['newPrice']) {
                    $capacity = $_POST['newCapacity'];
	                if(count($capacity) >0){
                    	for($i=0;$i<count($capacity);$i++){
	                    foreach($_POST['newPrice'] as $newPrice) {
	                         if ($newPrice['quantity'][$i] >0 && $newPrice['price'][$i] >=0) {
	                            if (($price = ProductPrice::model()->findByAttributes(array(
	                                        'product_id'=>$model->id,
	                                        'capacity'=>$capacity[$i],
	                                        'quantity'=>$newPrice['quantity'][$i])
	                                )) === null) $price = new ProductPrice;
	                            
	                            $price->product_id = $model->id;
	                            $price->capacity = $capacity[$i];
	                            $price->quantity = $newPrice['quantity'][$i];
	                            $price->price = $newPrice['price'][$i];
	                            if( !$price->save() && !$model->hasErrors('pricing'))
	                                $model->addError('pricing', 'Some prices with errors were provided. Make corrections in "Prising" section if necessary.');
	                        }
	                    }
                    	}
                    }
                }
                
                // Process Imprint Options
                if ($_POST['imprintAvailable']) {
                    if ($model->imprint === null) $imprint = new ProductImprint;
                    else $imprint = ProductImprint::model()->findByAttributes (array('product_id'=>$model->id));
                    
                    $imprint->product_id = $model->id;
                    $imprint->width = $_POST['imprintWidth'];
                    $imprint->height = $_POST['imprintHeight'];
                    $imprint->areas = $_POST['imprintAreas'];                    
                    $imprint->printings = join(',', array_keys($_POST['imprintMethod']));
                    $imprint->save();
                } else if(!isset($_POST['imprintAvailable']) && $model->imprint !== null) {
                    $model->imprint->delete();                    
                }
                
                // Process Accessories Options                
                if ($model->productAccessories === null) $productAccessories = new ProductAccessory;
                else $productAccessories = ProductAccessory::model()->findByAttributes (array('product_id'=>$model->id));
                    
                $productAccessories->product_id = $model->id;                
                $productAccessories->accessories = join(',', array_keys($_POST['accessory']));
                $productAccessories->save();                
                
                 // Process Preloaded Options                
                if ($model->productPreloaded === null) $productPreloaded = new ProductPreloaded;
                else $productPreloaded = ProductPreloaded::model()->findByAttributes (array('product_id'=>$model->id));
                    
                $productPreloaded->product_id = $model->id;                
                $productPreloaded->preloaded = join(',', array_keys($_POST['preloaded']));
                $productPreloaded->save();    
                
                // Process Packaging Options                
                if ($model->productPackaging === null) $productPackaging = new ProductPackaging;
                else $productPackaging = ProductPackaging::model()->findByAttributes (array('product_id'=>$model->id));
                    
                $productPackaging->product_id = $model->id;                
                $productPackaging->packaging = join(',', array_keys($_POST['packaging']));
                $productPackaging->save();                
                
                // Process images
                $model->main_image_id = $_POST['defaultImage'];                
                $model->deleteImages(array_keys($_POST['deleteImage']));
                
               
                
                foreach($_POST['Product']['capacity'] as $capacity) {
                    if ($capacity['delete']) {
                        $productCapacity = ProductCapacity::model()->findByAttributes(
                                    array('product_id'=>$model->id,
                                            'capacity'=>$capacity['value'])
                                        );
                        $productCapacity->delete();
                    }                    
                }
                
                $model->uploadedImages = CUploadedFile::getInstancesByName('Image');
                if ($model->saveUploadedImages() && !$model->hasErrors())
                        $this->redirect(array('view','id'=>$model->id));
                else {                    
                    if ($model->hasErrors('uploadedImages'))
                        Yii::app()->user->setFlash('uploadedImagesError', $model->getError('uploadedImages'));
                    $this->redirect(array('update','id'=>$model->id));
                }
            }
            
		}                
    }

    /**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin/product/index' page.
	 * @param integer $id the ID of the model to be deleted (really marked as deleted)
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($pageSize = null)
	{
        $this->layout = 'admin_main';
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];       
        
        $pdfCatalog = Yii::app()->user->getFlash('pdfCatalog', array(), false);
        Yii::app()->user->setFlash('pdfCatalog', $pdfCatalog);
                
        $pageSize = isset($pageSize)? $pageSize : 10;
        if ($pageSize === 'all') $pageSize = 1000000;
        
		$this->render('index',array(
			'model'=>$model,
            'pdfCatalog'=>$pdfCatalog,
            'pageSize' => $pageSize,
		));
	}
    
    public static function catalogItem($id) {
        $pdfCatalog = Yii::app()->user->getFlash('pdfCatalog', array(), false);
        Yii::app()->user->setFlash('pdfCatalog', $pdfCatalog);
        
        return isset($pdfCatalog[$id]) ? $pdfCatalog[$id] : false;
    }
    
    public static function itemChecked($id) {
        $pdfCatalog = Yii::app()->user->getFlash('pdfCatalog', array(), false);
        Yii::app()->user->setFlash('pdfCatalog', $pdfCatalog);
        
        return isset($pdfCatalog[$id]) ? true : false;
    }

	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
		if($model===null) throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function filterMarkDeleted($filterChain) {        
        $id = Yii::app()->request->getParam('id');        
        $model = Product::model()->findByPk($id); 
        if ($model !==null) {
            $model->markDeleted();
            $filterChain->run();
        }
        else throw new CHttpException(404,'The requested page does not exist.');
        
    }
    
    public function filterNotDeleted($filterChain) {
        $id = Yii::app()->request->getParam('id');        
        $model = Product::model()->findByPk($id);
        
        if ($model !==null && !$model->deleted)
            $filterChain->run();
        else            
             throw new CHttpException(404,'The requested page does not exist.');
    }
        
    
    private function buildMenu($model, array $items) {
        $menu = array();
        foreach ($items as $item) {
            switch ($item) {
                case 'list':
                    $menu[] = array('label'=>'List Products', 'url'=>array('index'));
                    break;
                case 'add':
                    $menu[] = array('label'=>'Add Product',   'url'=>array('create'));
                    break;
                case 'update':
                    $menu[] = array('label'=>'Update Product','url'=>array('update', 'id'=>$model->id));
                    break;
                case 'view':
                    $menu[] = array('label'=>'View Product',  'url'=>array('view', 'id'=>$model->id));
                    break;
                case 'calculate':
                    $menu[] = array('label'=>'Calculate Quote Price',  'url'=>array('calculator/index', 'id'=>$model->id));
                    break;
                case 'delete':
                    $menu[] = array('label'=>'Delete Product','url'=>'#', 'linkOptions'=>array(
                                                    'submit'=>array('delete','id'=>$model->id),
                                                    'confirm'=>'Are you sure you want to delete this product?'));
                    break;
            }
        }
        
        return $menu;
    }
    
    public function translateCapacity($amount) {
        $val = '';
        if ($amount < 1024) $val = $amount . " Mb";
        if ($amount >= 1024 && $amount < 1024*1024 ) $val = number_format($amount/1024) . " Gb";
        if ($amount >= 1024*1024 ) $val = number_format($amount/(1024*1024)) . " Tb";
        return $val;
    }
}
