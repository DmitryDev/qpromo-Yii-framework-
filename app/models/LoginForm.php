<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{    
    public $password; 
    public $username;
    public $rememberMe;

    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('username, password', 'required'),                        
            // password needs to be authenticated
            array('password', 'authenticate'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),            
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'username'=>'User Name',
            'password'=>'Password',
            'rememberMe'=>'Remember me',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors()) {
            $this->_identity=new UserIdentity();
            $this->_identity->userName = $this->username;
            $this->_identity->password = $this->password;                        
            
            if(!$this->_identity->authenticate())
                    $this->addError('password','Incorrect user name or password.');
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {                
        if($this->_identity===null)
        {
            $this->_identity=new UserIdentity();
            $this->_identity->username = $this->username;
            $this->_identity->password = $this->password;            
            $this->_identity->authenticate();
        }        
        
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE )
        {                                    
            $duration=$this->rememberMe ? Yii::app()->params['cookiesDuration'] : 0;
            return Yii::app()->user->login($this->_identity, $duration);            
        }
        else return false;
    }
}
