<?php

class SiteController extends Controller
{        
    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($category=null, $product='popular')
    {        
        $root = Category::model()->findByAttributes(array('parent_id'=>null));
        $select = array('category'=>$category, 'product'=>$product);
        
        $categoriesIds = array(); //list of all categories ids starting from selected root
        if ($select['category'] != null) Category::buildCategoriesList($categoriesIds, $category);
        else if (count($root->children)) Category::buildCategoriesList($categoriesIds, $root->children[0]->id);
        
        $criteria = $this->buildCriteria($categoriesIds, $product, 12, 0);        
        $products = Product::model()->findAll($criteria); 
        
        $events = $this->_selectEvents(3);
        // renders the view file 'views/site/index.php'
        // using the default layout 'views/layouts/main.php'         
        $this->pageTitle=Yii::app()->name;        
        $this->render('index', array('categories'=>$root->children,
                                    'select'=>$select,
                                    'products'=>$products,
                                    'events'=>$events));
    }
    
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {                
        if($error=Yii::app()->errorHandler->error)
        {
            $this->pageTitle=Yii::app()->name . ' - Error';
            
            if(Yii::app()->request->isAjaxRequest) echo $error['message'];
            else $this->render('error', $error);
        }
    }       
    
    public function actionLogout() {        
        if (!Yii::app()->user->isGuest) yii::app()->user->logout();        
        $this->redirect(Yii::app()->homeUrl);
    }        
    
    public function actionLogin() {
        $model=new LoginForm;
                
        // if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}                
        
        $this->pageTitle=Yii::app()->name . ' - Login';

        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl); 
        }		
		
		// collect user input data
		if(isset($_POST['LoginForm'])) {
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
            
			if ($model->validate() && $model->login())   {          
                $this->redirect($this->createUrl('site/index'));                                        
            }
		}
		// display the login form
		$this->render('login',array('model'=>$model));        
    }        
    
    private function buildCriteria($categories, $sortBy, $limit, $offset)
    {        
        $criteria = new CDbCriteria;
        //if($sortBy !='new'){        
        	$criteria->with = array('categories');
        //}

        if (isset($categories) && count($categories))
        {
            $categories = implode(',', $categories);
            
				
            	if($sortBy == 'new' && empty($_GET['category']) ){
            		$cats = Category::model()->findAll(array('distinct' => t));
            		//var_dump($cats);exit();
            		//for($i=0;i<count($cats);$i++){
            		$i=0;
            		$categories = array();
            		foreach($cats as $cat){
            		
            			$categories[$i] = $cat->id;
            			$i++;
            		}
            		$categories = implode(',', $categories);
            		
            	}
            	if ($criteria->condition !=='') $criteria->condition .= " AND `categories`.`id` in($categories) AND `categories`.`is_published`=\"yes\" ";        
            	else $criteria->condition .= " `categories`.`id` in($categories) AND `categories`.`is_published`=\"yes\" ";
            
        }
        
        if ($criteria->condition !=='') $criteria->condition .= " AND t.`is_published`=\"yes\" AND t.`deleted`=0 ";        
        else $criteria->condition .= " t.`is_published`=\"yes\" t.`deleted`=0 ";
        if($sortBy == 'new') $criteria->condition .= " AND t.`is_new`=1";
       /* if($sortBy == 'new') {
        	if(empty($_GET['category'])){
        		
        		$criteria->condition =" categories`.`id` in($cats) AND `categories`.`is_published`=\"yes\" AND t.`is_published`=\"yes\" AND t.`deleted`=0 AND t.`is_new`=1";
        	} 
        	else {
        		$criteria->condition ="categories`.`id` in($categories) AND `categories`.`is_published`=\"yes\" AND t.`is_published`=\"yes\" AND t.`deleted`=0 AND t.`is_new`=1";
        	}
		}*/              
         
        switch ($sortBy)
        {
            case 'popular': $criteria->order='`viewed` DESC'; break;
            case 'new': $criteria->order='`release_date` DESC'; break;
            default: $criteria->order='`viewed` DESC';
        }        
        
        if (isset($limit)) $criteria->limit = $limit;
        if (isset($offset)) $criteria->offset = $offset;        
                
        $criteria->together = true;
        $criteria->group = 't.id';
        
        //var_dump($criteria);exit();
        return $criteria;
    }
    
    public function actionSignup() {
        $model=new SignupForm;
        
        // if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='signup-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
        
        $this->pageTitle=Yii::app()->name . ' - Sign Up';

        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl); 
        }		
		
   
        
        
		// collect user input data
		if(isset($_POST['SignupForm'])) {
			$model->attributes=$_POST['SignupForm'];
			// validate user input and redirect to the previous page if valid
            
			if (($result = $model->signUp())=== true)
                $this->redirect($this->createUrl('site/index'));                                        
		}
		        
       $this->render('signup',array('model'=>$model));
    }
    
    public function actionFaq() {        
        // registering JavaScript file
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile('/js/faq_page.js', CClientScript::POS_END);
       
        $criteria = new CDbCriteria;
        $criteria->condition='`is_published`="yes"';
        $criteria->order='`order`';
        $questions = Faq::model()->findAll($criteria);
        
        $this->render('faq', array('questions'=>$questions));
    }
    
    public function actionSearch() {
    	
        //if ( !isset($_POST['keyword']) || strlen($_POST['keyword'])<2 ) $this->redirect($this->createUrl('site/index'));
        if(isset($_POST['search_mobile_input']) && !empty($_POST['search_mobile_input']) ){
        	$keyword = $_POST['search_mobile_input'];
        } else {
        	$keyword = $_POST['keyword'];	
        }
        
        
        $criteria = new CDbCriteria;
        
        $categoryIdFilter = 0;
        if(isset($_POST['ajax']) && $_POST['ajax']==='search-filter') {
            $categoryIdFilter = $_POST['category'];
        }
                
        $criteria->with = array('categories');
        $criteria->together = true;
        $criteria->select = array('name', 'model_number', 'tags', 'id', 'colors', 'main_image_id');
        $criteria->condition = 't.`is_published`="yes" AND `deleted`=0';
        $criteria->condition.= ' AND CONCAT_WS(" ", t.`model_number`,t.`name`,t.`tags`,t.`description`) LIKE "%'.$keyword.'%"';
        if ($categoryIdFilter) $criteria->condition.= ' AND categories.`id` ="'.$categoryIdFilter.'"';
        
        $products = Product::model()->findAll($criteria);
        
        if(isset($_POST['ajax']) && $_POST['ajax']==='search-filter') {
            $response = array();
            $response['result'] = 'ok';
            $response['amount'] = count($products);
            $response['filter'] = 'All';
            $response['products'] = '';
            foreach($products as $product) {                
                $response['products'] .= $this->widget('ProductThumbnail', array('model'=>$product), true);
            }
            
            
            if ($categoryIdFilter) {
                $category = Category::model()->findByPk($categoryIdFilter);
                if ($category !== null) $response['filter'] =$category->name;
            }

            header('Content-Type: application/json; charset="UTF-8"');
            echo CJSON::encode($response);
            Yii::app()->end();
		}
        
        $filterList = array(0=>'All Categories');
        foreach($products as $product) {
            foreach($product->categories as $category) {
                $keys = array_keys($filterList);
                if (!in_array($category->id, $keys)) {
                    $filterList[$category->id] = $category->name;
                }
            }
        }
        
        $cs = Yii::app()->getClientScript();        
        $cs->registerCssFile('/js/cusel/css/cusel.css', 'screen');
        
        $cs->registerScriptFile('/js/cusel/js/cusel.js', CClientScript::POS_END);
        $cs->registerScriptFile('/js/cusel/js/jquery.mousewheel.js', CClientScript::POS_END);
        $cs->registerScriptFile('/js/search-page.js', CClientScript::POS_END);
        
        $this->render('search', array('products'=>$products, 'filterList'=>$filterList, 'keyword'=>$keyword));
    }
    
    public function actionMarketing($issue=null)
    {
        if ($issue !== null) {
            $file = Yii::app()->basePath . '/../html_public/' .Yii::app()->params['marketingImagePath'] . $issue;            
            
            if (file_exists($file)) {            
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));                
                ob_clean();
                flush();
                readfile($file);
            }
            Yii::app()->end();
        }
        
        $criteria = new CDbCriteria();
        $criteria->order = 'issued desc';
        $issues = MarketingTool::model()->findAll($criteria);
        $years = array();
        foreach($issues as $issue) {
            $year = date("Y", strtotime($issue->issued));
            if (!in_array($year, $years))
                    $years[]=$year;
                    rsort($years, SORT_NUMERIC);
        }
        
        $pages = array();
        foreach($issues as $issue) {
            $year = date("Y", strtotime($issue->issued));
            $month = date("F", strtotime($issue->issued));
            $day = date("d", strtotime($issue->issued));
            
            if (!isset($pages[$year])) $pages[$year] = array();
            if (!isset($pages[$year][$month])) $pages[$year][$month] = array();
            $pages[$year][$month][$day] = $issue;
        }
        
        $cs = Yii::app()->getClientScript();        
        $cs->registerCssFile('/css/marketing.css', 'screen');                
        $cs->registerScriptFile('/js/marketing.js', CClientScript::POS_END);
        
        $categoryOptions = array(0=>'All Marketing Categories');
        $rootCat = MtCategory::model()->findByAttributes(array('parent_id'=>null));
        if($rootCat!== null)
            $this->buildMarketingCategoryList ($rootCat, $categoryOptions);
            
        
        
        $this->render('marketing', array('years'=>$years, 'pages'=>$pages, 'categoryOptions'=>$categoryOptions));
    }
    
    private function buildMarketingCategoryList($node, &$list) {
        foreach($node->children as $child) {
            $name = $child->name;
            $parent = $child->parent;
            while($parent->parent_id != null) {
                $name = $parent->name . '/' . $name;
                $parent = $parent->parent;
            }
            $list[$child->id] = $name;
            if(count($child->children)) $this->buildMarketingCategoryList ($child, $list);
        }
    }
    
    public function actionAccount()
    { 
        if (Yii::app()->user->isGuest) $this->redirect(Yii::app()->homeUrl);
        
        $user = User::model()->findByPk(Yii::app()->user->id);
        if ($user === null) $this->redirect(Yii::app()->homeUrl);
        
        
        $model=new AccountForm;
        
        // if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='account-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		} 
        
        if (isset($_POST['AccountForm'])) {
            $model->attributes=$_POST['AccountForm'];
            if ($model->validate()) {
                $user->username = $model->username;
                $user->company = $model->company;
                $user->email = $model->email;
                $user->phone = $model->phone;
                $user->industry_asi = $model->industry_asi;
                $user->industry_ppai = $model->industry_ppai;
                $user->industry_sage = $model->industry_sage;
                $user->industry_upic = $model->industry_upic;
                
                //Separating firstname and last name from name field
                $matches = array();        
                preg_match('/^([a-zA-Z0-9]+) ([a-zA-Z0-9]+)/', $model->name, $matches);
                $user->first_name = $matches[1];
                $user->last_name = $matches[2];
                
                $user->save();
                
                if (!empty($model->oldPassword)) {
                    $credentials = UserCredentials::model()->findByAttributes(array(
                        'user_id'=>$user->id,
                        'type_id'=>UserCredentials::CREDENTIALS_PASSWORD
                    ));
                    if ($credentials === null) {
                        $credentials = new UserCredentials;
                        $credentials->user_id = $user->id;
                        $credentials->type_id = UserCredentials::CREDENTIALS_PASSWORD;
                    }
                    $credentials->password = md5($model->password);
                    $credentials->save(false);
                }
                
                //if ($credentials && $credentials->hasErrors()) {                    
                //    Yii::app()->user->setFlash('accountSaved', $credentials->errors);
                //} else
                    Yii::app()->user->setFlash('accountSaved', 'Your account information has been successefuly saved.');
                    
            }            
            //    $this->redirect($this->createUrl('site/index'));
        } else {
            $model->username = $user->username;
            $model->company = $user->company;
            $model->email = $user->email;
            $model->phone = $user->phone;
            $model->name = $user->first_name . " " . $user->last_name;
            $model->industry_asi  = $user->industry_asi;
            $model->industry_ppai = $user->industry_ppai;
            $model->industry_sage = $user->industry_sage;
            $model->industry_upic = $user->industry_upic;
        }
        
        $model->oldPassword = '';
        $model->password = '';
        $model->password_repeat = '';
         
        $this->pageTitle=Yii::app()->name . ' - My Account';			
        $this->render('account', array('model'=>$model));
    }
    
    public function actionContact()
    {
        $model=new ContactForm;
        
        // if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='contact-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		} 
        
        $user = (!Yii::app()->user->isGuest)
            ? User::model()->findByPk(Yii::app()->user->id)
            : null;
        
        if (isset($_POST['ContactForm'])) {
            $model->attributes=$_POST['ContactForm'];
            if ($model->validate()) {
                Yii::app()->user->setFlash('messageSent', 'Your message has been sent. Our representative will contact you shortly.');
                Yii::app()->mailer->contactMessage($model);
            }
        } elseif ($user !== null) {
            $model->first_name = $user->first_name;
            $model->last_name = $user->last_name;
            $model->company = $user->company;
            $model->phone = $user->phone;
            $model->email = $user->email;
        }
        
        $this->pageTitle=Yii::app()->name . ' - Contact Us';			
        $this->render('contact', array('model'=>$model));
        
    }
    
    public function actionHelp() {
        $this->render('help');
    }
    
    public function actionWarranty() {
        $this->render('warranty');
    }
    
    public function actionPolicy() {
        $filename = $this->getViewFile('policy');
        $modified = date ("F d, Y", filemtime($filename));        
        $this->render('policy', array('modified'=>$modified));
    }
    
    public function actionTerms() {
        $filename = $this->getViewFile('terms');
        $modified = date ("F d, Y", filemtime($filename));        
        $this->render('terms', array('modified'=>$modified));
    }
    
    public function actionTestPdf()
    {
        $products=  Product::model()->findAll();
        $html = $this->renderPartial('/product/pdfCatalog', array('products'=>$products), true);
                  
        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($html);
        //$html2pdf->WriteHTML("<html><body><h1>Hi, PDF!!!</h1></body></html>");
        //$html2pdf->Output();
        $html2pdf->Output($_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['pdfsPath'] . 'file.pdf', EYiiPdf::OUTPUT_TO_FILE);
    }
    
    public function actionDownload($item=null)
    {
        $item = PageSectionItem::model()->findByPk($item);
        if ($item !== null) {
            
            $file = Yii::app()->basePath . '/../html_public/' .Yii::app()->params['downloadsPath'] . $item->file;
            $matches = array();
            $ext = '';
            $name = str_replace(' ', '_', $item->name);
            if (preg_match('/^(.+)\.(.+)$/', basename($file), $matches)) {
                if(isset($matches[2])) {
                    $ext = $matches[2];
                    $name .= '.'.$ext;
                }
            }
            
            if (file_exists($file)) {            
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.$name);
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));                
                ob_clean();
                flush();
                readfile($file);
            }
            Yii::app()->end();
        }
    }
    
    private function _selectEvents($limit) {
        $criteria = new CDbCriteria;
        $criteria->limit = $limit;
        $criteria->condition = '`date` > NOW()';
        $criteria->order = '`date` asc';
        
        $events = Event::model()->findAll($criteria);
        return $events;
    }
}