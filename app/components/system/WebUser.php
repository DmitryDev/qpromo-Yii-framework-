<?php

/**
 * @author Sergey Muzyka
 * @company Loginaut
 * @site http://loginaut.com
 * @modified 02/21/13
 */

/**
 * WebUser represents the data describing the current user whether it's logged in or not (is a guest).
 */
class WebUser extends CWebUser {
    
    /**
	 * Returns the firstname for the user.
	 * @return string the user firstname. If the user is not logged in, this will be {@link guestName}.
	 */
	public function getFirstName() {
		if(($firstname=$this->getState('__firstname'))!==null) return $firstname;
		else return $this->guestName;
	}
    
    /**
	 * Returns the login name for the user.
	 * @return string the user login name. If the user is not logged in, this will be NULL.
	 */
    public function getUserName() {
		if(($username=$this->getState('__username'))!==null) return $username;
		else return NULL;
	}
        
    
	/**
	 * Sets the firstname for the user.
	 * @param string $value the user firstname.
	 * @see getFirstName
	 */
	public function setFirstName($value) { $this->setState('__firstname',$value); }
    
    /**
	 * Sets the login name for the user.
	 * @param string $value the user login name.
	 * @see getUserName
	 */
    public function setUserName($value) { $this->setState('__username',$value); }
        	
    
    /**
	 * Logs in a user.
	 *
	 * The user identity information will be saved in storage that is
	 * persistent during the user session. By default, the storage is simply
	 * the session storage. If the duration parameter is greater than 0,
	 * a cookie will be sent to prepare for cookie-based login in future.
	 *
	 * Note, you have to set {@link allowAutoLogin} to true
	 * if you want to allow user to be authenticated based on the cookie information.
	 *
	 * @param IUserIdentity $identity the user identity (which should already be authenticated)
	 * @param integer $duration number of seconds that the user can remain in logged-in status.
     * Defaults to 0, meaning login till the user closes the browser.
	 * If greater than 0, cookie-based login will be used. In this case, {@link allowAutoLogin}
	 * must be set true, otherwise an exception will be thrown.
	 * @return boolean whether the user is logged in
	 */
	public function login($identity, $duration=0)
	{
		$id=$identity->getId();        
		$states=$identity->getPersistentStates();
                        
        
		if($this->beforeLogin($id,$states,false))
		{                   
			$this->changeIdentity($id, $identity->getUserName(), $identity->getFirstName(), $states);                                    
                    
			if($duration > 0) {                
				if($this->allowAutoLogin) $this->saveToCookie($duration);
				else throw new CException(
                                    Yii::t('yii','{class}.allowAutoLogin must be set true in order to use cookie-based authentication.',
                                    array('{class}'=>get_class($this)))
                            );
			}
			$this->afterLogin(false);            
		}
                        
        
		return !$this->getIsGuest();
	}   
    
    /**
	 * Redirects the user browser to the login page.
	 * Before the redirection, the current URL (if it's not an AJAX url) will be
	 * kept in {@link returnUrl} so that the user browser may be redirected back
	 * to the current page after successful login. Make sure you set {@link loginUrl}
	 * so that the user browser can be redirected to the specified login URL after
	 * calling this method.
	 * After calling this method, the current request processing will be terminated.
	 */
	public function loginRequired()
	{
		$app=Yii::app();
		$request=$app->getRequest();
        
		if(!$request->getIsAjaxRequest())
			$this->setReturnUrl($request->getUrl());
		elseif(isset($this->loginRequiredAjaxResponse))
		{
			echo $this->loginRequiredAjaxResponse;
			Yii::app()->end();
		}
		
        if (($url = $request->urlReferrer)!==null) 
        {
            $this->setState('loginRequired', 'true');
            $this->setState('returnUrl', $request->getUrl());
            $request->redirect($url);
        }
        else throw new CHttpException(403,Yii::t('yii','Login Required'));
	}
    
    protected function afterLogin($fromCookie) {
        parent::afterLogin($fromCookie);                                        
	}
    
    protected function afterLogout() {
        parent::afterLogout();
	}
    
    /**
	 * Populates the current user object with the information obtained from cookie.
	 * This method is used when automatic login ({@link allowAutoLogin}) is enabled.
	 * The user identity information is recovered from cookie.
	 * Sufficient security measures are used to prevent cookie data from being tampered.
	 * @see saveToCookie
	 */
	protected function restoreFromCookie()
	{        
		$app=Yii::app();
		$request=$app->getRequest();
		$cookie=$request->getCookies()->itemAt($this->getStateKeyPrefix());
		if($cookie && !empty($cookie->value) && is_string($cookie->value) && ($data=$app->getSecurityManager()->validateData($cookie->value))!==false)
		{            
			$data=@unserialize($data);                        
			if(is_array($data) && isset($data[0],$data[1],$data[2],$data[3]))
			{            
				list($id,$username,$firstName,$duration,$states)=$data;                
				if($this->beforeLogin($id,$states,true))
				{            
					$this->changeIdentity($id,$email,$firstName,$device,$states);
					if($this->autoRenewCookie)
					{
						$cookie->expire=time()+$duration;
						$request->getCookies()->add($cookie->name,$cookie);
					}
					$this->afterLogin(true);
				}
			}          
		}
	}     
    
    /**
	 * Renews the identity cookie.
	 * This method will set the expiration time of the identity cookie to be the current time
	 * plus the originally specified cookie duration.
	 * @since 1.1.3
	 */
	protected function renewCookie()
	{
		$request=Yii::app()->getRequest();
		$cookies=$request->getCookies();
		$cookie=$cookies->itemAt($this->getStateKeyPrefix());
		if($cookie && !empty($cookie->value) && ($data=Yii::app()->getSecurityManager()->validateData($cookie->value))!==false)
		{
			$data=@unserialize($data);
			if(is_array($data) && isset($data[0],$data[1],$data[2],$data[3],$data[4]))
			{
				$cookie->expire=time()+$data[4];
				$cookies->add($cookie->name,$cookie);
			}
		}
	}    
    
    /**
	 * Saves necessary user data into a cookie.
	 * This method is used when automatic login ({@link allowAutoLogin}) is enabled.
	 * This method saves user ID, username, other identity states and a validation key to cookie.
	 * These information are used to do authentication next time when user visits the application.
	 * @param integer $duration number of seconds that the user can remain in logged-in status. Defaults to 0, meaning login till the user closes the browser.
	 * @see restoreFromCookie
	 */
	protected function saveToCookie($duration)
	{
		$app=Yii::app();
		$cookie=$this->createIdentityCookie($this->getStateKeyPrefix());
		$cookie->expire=time()+$duration;
		$data=array(
			$this->getId(),
            $this->getUserName(),
            $this->getFirstName(),            
			$duration,
			$this->saveIdentityStates(),
		);        
		$cookie->value=$app->getSecurityManager()->hashData(serialize($data));        
		$app->getRequest()->getCookies()->add($cookie->name,$cookie);
	}
    
    /**
	 * Changes the current user with the specified identity information.
	 * This method is called by {@link login} and {@link restoreFromCookie}
	 * when the current user needs to be populated with the corresponding
	 * identity information. Derived classes may override this method
	 * by retrieving additional user-related information. Make sure the
	 * parent implementation is called first.
	 * @param mixed $id a unique identifier for the user
	 * @param string $username the display name for the user
     * @param string $firstName the user's first name
	 * @param array $states identity states
	 */
	protected function changeIdentity($id,$username,$firstName,$states)
	{
        $this->setFirstName($firstName);
        $this->setUserName($username);                                                              		
        parent::changeIdentity($id, $username, $states);
	}
}

?>
