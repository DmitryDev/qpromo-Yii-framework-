<?php

/**
 * @author Sergey Muzyka
 * @company Loginaut
 * @site http://loginaut.com
 * @modified 02/21/13
 */

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    const ERROR_NAME_INVALID = 3;
    const ERROR_USER_BANNED = 2;
    const CREDENTIALS_PASSWORD = 1;
    
    // user id is stored here
    private $_id;
    // user first name is stored here
    private $_firstName;    
    // user nikname is stored here
    private $_username;    
    
    
    /**
     * Authenticates a user.     
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {            
        $user = User::model()->findByAttributes(array('username'=>$this->_username));
        if($user===null) $this->errorCode=self::ERROR_NAME_INVALID;
        else
        {
            if ($user->is_banned == 'yes') {
                $this->errorCode=self::ERROR_USER_BANNED;
                return !$this->errorCode;  
            }
                        
            
            $userCredentials=UserCredentials::model()->findByAttributes( array('user_id'=>$user->id, 'type_id'=>self::CREDENTIALS_PASSWORD) );
            
            if($userCredentials===null) $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else
            {
                if($userCredentials->password !== md5($this->password)) $this->errorCode=self::ERROR_PASSWORD_INVALID;
                else
                {
                    $this->_id = $user->id;
                    $this->_firstName = $user->first_name;
                    $this->_username = $user->username;                    
                    $this->errorCode=self::ERROR_NONE;                                        
                }
            }
        }
        
        return !$this->errorCode;                
    }
    
    /**
     * Fills the identity parameters by the given user. Works the same way like Authenticate method but without authentication
     * @param type $user
     */
    /*public function createByUser($user)
    {
        if (!isset($user) || !is_a($user, 'User')) $this->errorCode=self::ERROR_EMAIL_INVALID;
        else
        {        
            $this->_id = $user->id;
            $this->_firstName = $user->first_name;
            $this->_email = $user->email;
            $this->_device = $user->default_device_id;                                        
            $this->errorCode=self::ERROR_NONE;                        
        }
        return !$this->errorCode;      
    }*/
    
    /**
     * Returns a user identificator.     
     * @return integer
     */
    public function getId() { return $this->_id; }
    
    /**
     * Returns a user first name.     
     * @return string.
     */
    public function getFirstName() { return $this->_firstName; }
    
    /**
     * Returns a user login name.     
     * @return string.
     */
    public function getUserName() { return $this->_username; }
        
               
    /**
     * Sets a user identificator.     
     * @param $value integer.
     */
    public function setId($value) { $this->_id = $value; }
    
    /**
     * Sets a user first name.     
     * @param $value string.
     */
    public function setFirstName($value) { $this->_firstName = $value; }
        
    /**
     * Sets a user login name.     
     * @param $value string.
     */
    public function setUserName($value) { $this->_username = $value; }
            

}