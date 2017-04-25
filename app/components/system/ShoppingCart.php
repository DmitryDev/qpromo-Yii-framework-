<?php

/**
 * ShoppingCart class file
 *
 * @author Sergey Muzyka <sergey@loginaut.com>
 * @copyright Copyright &copy; 2012 Loginaut LLC
 */

/**
 * ShoppingCart represents the persistent state for a application shopping cart.
 *
 * ShoppingCart is used as an application component whose ID is 'shoppingCart'.
 * Therefore, at any place one can access the cart state via
 * <code>Yii::app()->shoppingCart</code>.
 *
 */

class ShoppingCart extends CApplicationComponent {        
    
    /**
	 * @var boolean whether to automatically renew the shopping cart cookie each time a page is requested.
	 * Defaults to false. When this is false, the cookie will expire after the specified duration.
	 * When this is true, the shopping cart cookie will expire after the specified duration
	 * since the user visits the site the last time.
	 */
	public $autoRenewCookie=false;
    
    public $modelName ='ShoppingCartItem';
    public $userIdFieldName = 'user_id';
    public $itemIdFieldName = 'product_instance_id';
    
    
    private $_keyPrefix;
    
    /**
	 * Initializes the application component.
	 * This method overrides the parent implementation by starting session,
	 * performing cookie-based and database-based (if the current user ig logged)
     * cart filling if nessesary.
	 */
	public function init()
	{        
		parent::init();
		Yii::app()->getSession()->open();
        
        $key = $this->getKeyPrefix();
                   
        if(!isset($_SESSION[$key]))
        {              
            $_SESSION[$key]=array();         
            
            $this->restoreFromCookie();            
			
            //if(!isset(Yii::app()->user) || !Yii::app()->user->isGuest)
            if(isset(Yii::app()->user) && !Yii::app()->user->isGuest)
            {
                $this->synchronizeWithDB();
                $this->saveToCookie(Yii::app()->params['cookiesDuration']);            
            }
        }        
                
		if($this->autoRenewCookie) $this->renewCookie();
         
         
    }
    
    /**
	 * @return string a prefix for the name of the session variable storing shopping cart data;
	 */
    private function getKeyPrefix()	
	{
		if($this->_keyPrefix!==null) return $this->_keyPrefix;
		else return $this->_keyPrefix=md5('Yii.'.get_class($this).'.'.Yii::app()->getId());
	}
    
    /**
	 * Saves necessary shopping cart data into a cookie.
	 * This method is used when a product is put, deleted or changed in the shopping cart.	 
	 * These information are used to fill the shopping cart next time when user visits the application.
	 * @param integer $duration number of seconds that the shopping cart can be stored.
     * Defaults to 0, meaning storring the information till the user closes the browser.
	 * @see restoreFromCookie
	 */
    private function saveToCookie($duration)
    {
        $app=Yii::app();
        $request=$app->getRequest();
		$cookie=new CHttpCookie($this->getKeyPrefix(),'');
		$cookie->expire=time()+$duration;
		$data=array(
			$_SESSION[$this->getKeyPrefix()],
			$duration,			
		);
		$cookie->value=$app->getSecurityManager()->hashData(serialize($data));
		$request->getCookies()->add($cookie->name,$cookie);
    }
    
    /**
	 * Populates the current shopping cart object with the information obtained from cookie.
	 * This method is used when the user first time opens the browser window.
	 * Sufficient security measures are used to prevent cookie data from being tampered.
	 * @see saveToCookie
	 */
    private function restoreFromCookie()
    {
        $app=Yii::app();
		$request=$app->getRequest();
		$cookie=$request->getCookies()->itemAt($this->getKeyPrefix());
		if($cookie && !empty($cookie->value) && is_string($cookie->value) && 
                ($data=$app->getSecurityManager()->validateData($cookie->value))!==false)
		{
			$data=@unserialize($data);
			if(is_array($data) && isset($data[0],$data[1]) && is_array($data[0]))
			{
				list($cart,$duration)=$data;
				
                $_SESSION[$this->getKeyPrefix()] = $cart;
                
                if($this->autoRenewCookie)
                {
                    $cookie->expire=time()+$duration;
                    $request->getCookies()->add($cookie->name,$cookie);
                }                				
			}
		}
    }
	 
    /**
	 * Renews the shopping cart cookie.
	 * This method will set the expiration time of the shopping cookie to be the current time
	 * plus the originally specified cookie duration.
	 */
    private function renewCookie()
    {
        $request=Yii::app()->getRequest();
		$cookies=$request->getCookies();
		$cookie=$cookies->itemAt($this->getKeyPrefix());
		if($cookie && !empty($cookie->value) && 
                ($data=Yii::app()->getSecurityManager()->validateData($cookie->value))!==false)
		{
			$data=@unserialize($data);
			if(is_array($data) && isset($data[0],$data[1]) && is_array($data[0]))
			{
				$cookie->expire=time()+$data[1];
				$cookies->add($cookie->name,$cookie);
			}
		}
    }
	 
    private function synchronizeWithDB()
    {
        $modelName  = $this->modelName;
        $userField  = $this->userIdFieldName;
        $itemField  = $this->itemIdFieldName;        
        $app        = Yii::app();                
                                                
        if (!$app->user->isGuest && $app->user->id && $app->db && class_exists($modelName) && is_subclass_of($modelName, 'CActiveRecord'))        
        {
            $userId = $app->user->id;            
            
            //At first let's store all the new products and update existence ones
            //in the database. Existence product entries are been overwritten.
            foreach($_SESSION[$this->getKeyPrefix()] as $item)
            {
                //check if this instance still exists and wasn't removed by admin from db
                if (ProductInstance::model()->findByPk($item[$itemField])===null) continue;
                
               /* $model = $modelName::model()->findByAttributes(array(
                            $userField=>$userId,
                            $itemField=>$item[$itemField]
                        ));
                */
                $model = call_user_func(array($modelName, 'model'));
                $model = $model->findByAttributes(array(
                            $userField=>$userId,
                            $itemField=>$item[$itemField]
                        ));
                
                if ($model === NULL)
                {
                    $model = new $modelName;
                    $model->$userField = $userId;
                }
                                
                foreach($item as $field=>$value) $model->$field = $value;
                $model->save();
            }
            
            //Now reload the session shopping cart with the information in the database
            $models = call_user_func(array($modelName, 'model'));
            $models = $models->findAllByAttributes(array(
                            $userField=>$userId
                        ));
            unset($_SESSION[$this->getKeyPrefix()]);
            $_SESSION[$this->getKeyPrefix()] = array();
            foreach($models as $model)
            {
                if (ProductInstance::model()->findByPk($model->$itemField)===null) continue;
                
                $item = array();
                foreach($model->attributeNames() as $attribute)
                    if ($attribute !== $userField)
                        $item[$attribute] = $model->$attribute;
                                
                array_push($_SESSION[$this->getKeyPrefix()], $item);
            }
            
        }
        
    }
    
    private function removeFromDb($instance_id)
    {
        $modelName  = $this->modelName;
        $userField  = $this->userIdFieldName;
        $itemField  = $this->itemIdFieldName;        
        $app        = Yii::app();               
        
        if (!$app->user->isGuest && $app->db && class_exists($modelName) && is_subclass_of($modelName, 'CActiveRecord'))
        {
            $userId = $app->user->id;
            
            $model = call_user_func(array($modelName, 'model'));
            $model = $model->findByAttributes(array(
                                $userField=>$userId,
                                $itemField=>$instance_id
                    ));
            
            if ($model !== NULL) return $model->delete();
        }    
        
        return false;
    }
    
    /**
     * Adds an item into the shopping cart.     
     * @param integer $newItemId new item identificator
     * @param array $attributes array of attributes in form $key=>$value
     */
    public function addItem($newItemId, array $attributes)
    {
        $productInstance = ProductInstance::model()->findByPk($newItemId);
        if ($productInstance===null) return null;
        
        if ($productInstance->quantity < $attributes['quantity']) return false;
        
        $itemField  = $this->itemIdFieldName;               
        
        $itemExists = false;        
        $result= array();
        foreach($_SESSION[$this->getKeyPrefix()] as $index=>$existentItem)
        {            
            if ($existentItem[$itemField] == $newItemId)
            {                                
                $itemExists = true;
                foreach($attributes as $key=>$value) 
                {                    
                    if ($key == 'quantity') $_SESSION[$this->getKeyPrefix()][$index][$key] += $value;
                    else $_SESSION[$this->getKeyPrefix()][$index][$key] = $value;                       
                }
                break;
            }
        }
        
        if (!$itemExists)
        {
            $item = array();
            $item[$itemField] = $newItemId;
            foreach($attributes as $key=>$value) $item[$key] = $value;                
            $_SESSION[$this->getKeyPrefix()][] = $item;
        }
        
        $this->synchronizeWithDB();
        $this->saveToCookie(Yii::app()->params['cookiesDuration']);        
        return $_SESSION[$this->getKeyPrefix()];
    }
    
     /**
     * Changes an item in the shopping cart.     
     * @param integer $itemId item identificator
     * @param array $attributes array of attributes in form $key=>$value
     */
    public function changeItem($itemId, array $attributes)
    {
        if (ProductInstance::model()->findByPk($itemId)===null) return null;
        
        $itemField  = $this->itemIdFieldName;               
        
        $itemExists = false;        
        $result= array();
        foreach($_SESSION[$this->getKeyPrefix()] as $index=>$existentItem)
        {            
            if ($existentItem[$itemField] == $itemId)
            {                        
                $itemExists = true;
                foreach($attributes as $key=>$value) 
                {                                        
                    $_SESSION[$this->getKeyPrefix()][$index][$key] = $value;                       
                }
                break;
            }
        }
        
        if (!$itemExists)
        {
            $item = array();
            $item[$itemField] = $itemId;
            foreach($attributes as $key=>$value) $item[$key] = $value;                
            $_SESSION[$this->getKeyPrefix()][] = $item;
        }
        
        $this->synchronizeWithDB();
        $this->saveToCookie(Yii::app()->params['cookiesDuration']);        
        return $_SESSION[$this->getKeyPrefix()];
    }
    
    /**
     * Removes an item with the provided identificator from the shopping cart.
     * @param integer $removeItemId item identificator.
     */
    public function removeItem($removeItemId)
    {
        if (ProductInstance::model()->findByPk($removeItemId)===null) return null;
        
        $reslut = '';
        
        $itemField  = $this->itemIdFieldName;  
        foreach($_SESSION[$this->getKeyPrefix()] as $key=>$item)
        {
            if ($item[$itemField] === $removeItemId)                
            {
                $this->removeFromDb($removeItemId);
                unset($_SESSION[$this->getKeyPrefix()][$key]);
                $this->synchronizeWithDB();
                $this->saveToCookie(Yii::app()->params['cookiesDuration']);
                $result = $_SESSION[$this->getKeyPrefix()];
                break;                
            }
        }   
        return $result;        
    }

    public function getItem($item_id)
    {
        if (ProductInstance::model()->findByPk($item_id)===null) return null;            
        
        $itemField  = $this->itemIdFieldName;
        foreach($_SESSION[$this->getKeyPrefix()] as $item)
            if ($item[$itemField] == $item_id) return $item;            
            
        return null;
    }
    
    public function getItems()
    {
        $result = array();
        $itemField  = $this->itemIdFieldName;
        
        foreach ($_SESSION[$this->getKeyPrefix()] as $item)
        {
                    $productItem = array();
                                        
                    //$a = new ProductInstance;                    
                    $instance = ProductInstance::model()->findByPk($item[$itemField]);
                    if ($instance === null) continue;
                    
                    $product = $instance->product;
                    
                    $image_id = $product->main_image_id;
                    if ($image_id) $image = ProductImage::model()->findByPk($image_id);                     
                    
                    $productItem['name'] = $product->name;
                    $productItem['description'] = $product->description;
                    $productItem['price'] = $product->price;
                    
                    if ($image)
                    {
                        $product_image = array();
                        $product_image['origin'] = $image->path_origin;
                        $product_image['thumbnail'] = $image->path_thumbnail;
                        $product_image['tiny'] = $image->path_tiny;
                        $product_image['small'] = $image->path_small;
                        $product_image['large'] = $image->path_large;
                        $productItem['image'] = $product_image;
                    }
                    
                    if ($instance->color)
                        $productItem['color'] = $instance->color->value;
                    
                    $productItem['color_id'] = $instance->color_id;
                    $productItem['quantity'] = $item['quantity'];
                    $productItem['stock_quantity'] = $instance->quantity;
                    //$productItem['sku'] = intval(str_replace('-', '', $instance->sku));
                    $productItem['sku'] = $instance->sku;
                    $productItem['productId'] = $product->id;
                    $productItem['instanceId'] = $instance->id;
                    $productItem['image_id'] = $image_id;
                    
                    /* This part is only for facebook share link. Not need in other projects
                     */
                     // Form description (short 30-words version (if available) and full description)
                    $match = array();        
                    if (preg_match('/(\S+\s+){30}/', $productItem['description'], $match))                
                    {
                        $dots = preg_match('/(\S+\s+){31}/', $productItem['description']) ? '...' : '';
                        $description = $match[0] . $dots;                
                    }
                    else $description = $productItem['description'];
            
                    $fbShareLink = 'http://www.facebook.com/dialog/feed?';
                    $fbShareLink.= 'app_id=' . Yii::app()->params['fbAppId'];
                    $fbShareLink.= '&link=' . Yii::app()->createAbsoluteUrl('/product/view', array('id'=>$product->id));
                    $fbShareLink.= '&picture=http://' . $_SERVER['SERVER_NAME'] .Yii::app()->params['productImagesPath']. $productItem['image']['small'];        
                    $fbShareLink.= '&name=' . urlencode(Yii::app()->name);
                    $fbShareLink.= '&caption=' . urlencode($productItem['name']);
                    $fbShareLink.= '&description=' . urlencode($description);
                    $fbShareLink.= '&redirect_uri=' . Yii::app()->createAbsoluteUrl('/product/view', array('id'=>$product->id));
                    $productItem['fbShareLink'] = $fbShareLink;                     
                    
                    $twShareLink = 'https://twitter.com/share?';                    
                    $twShareLink.= 'url=' . Yii::app()->createAbsoluteUrl('/product/view', array('id'=>$product->id));                    
                    $twShareLink.= '&text=' . urlencode(Yii::app()->name) . ' / ' . urlencode($productItem['name']);                    
                    $productItem['twShareLink'] = $twShareLink;                     
                    
                    $result[] = $productItem;
        }
        
        return $result;
    }

    public function afterLogin()
    {
        $this->synchronizeWithDB();
        $this->saveToCookie(Yii::app()->params['cookiesDuration']);
    }
    
   
   
    public function afterLogout()
    {
        $key = $this->getKeyPrefix();
        //clear session variable and cookie
        if (isset($_SESSION[$key])) unset($_SESSION[$key]);
        $_SESSION[$key]=array();
        $this->saveToCookie(Yii::app()->params['cookiesDuration']);
    }
     
     
    
    public function getAmount()
    {
        $itemField  = $this->itemIdFieldName;
        
        $amount = 0;
        foreach($_SESSION[$this->getKeyPrefix()] as $item)
        {
            $instance = ProductInstance::model()->findByPk($item[$itemField]);
            if ($instance === null) continue;
            
            $product = $instance->product;            
            $amount += $product->price * $item['quantity'];
        }
        
        return $amount;
    }
	
}

