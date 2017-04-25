<?php
/**
 * UserEntryForm class.
 * UserEntryForm is the data structure for keeping
 * user entry form data. It is used by the 'update' and 'create' actions of 'admin/UserController'.
 */
class SignupForm extends CFormModel
{    
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $company;
    public $phone;
    public $industry_asi;
    public $industry_ppai;
    public $industry_sage;
    public $industry_upic;
    public $password;
    public $password_repeat;
    public $subscribe;
    
    public $rememberMe;
    
    private $_identity;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, first_name, last_name, email, company, password', 'required'),
            array('username, company', 'length', 'max'=>32),
            array('username, password', 'length', 'min'=>5),
            array('username', 'field_alphanum'),
            array('phone', 'length', 'max'=>20),
            array('industry_asi, industry_ppai, industry_sage, industry_upic', 'length', 'max'=>10),
            array('first_name, last_name', 'length', 'max'=>45),
            array('email', 'length', 'max'=>64),                        
            array('email', 'email'), 
            array('email, username', 'field_unique'),
            array('password', 'length', 'max'=>32),            
            array('password', 'compare'),
            array('password_repeat, subscribe', 'safe'),
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
            'username' => ' User Name:',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'company' => 'Company Name',
            'phone' => 'Phone Number',
            'industry_asi'=>'ASI #',
            'industry_ppai'=>'PPAI #',
            'industry_sage'=>'SAGE #',
            'industry_upic'=>'UPIC #',
            'password' => 'Password',            
            'password_repeat' => 'Confirm Password *',
            'rememberMe'=>'Remember me',
        );
    }

    
    public function field_unique($attribute, $params)
    {        
        $user = User::model()->findByAttributes(array($attribute=>$this->$attribute));
        if ($user) {
            $this->addError($attribute, "The $attribute already exists.");            
        }
    }
    
    public function field_alphanum($attribute, $params)
    {        
        if (!preg_match('/^[a-zA-Z0-9]+$/', $this->$attribute)) {        
            $this->addError($attribute, "$attribute can only contain letters and digits.");            
        }
    }
        
    public function signUp()
    {
 
        if ($this->validate()) {
            
            // create new user
            $user = new User();                
            $user->attributes = $this->attributes;
                                
            if ($user->save()) {
                $userCredentials = new UserCredentials();
                $userCredentials->user_id = $user->id;                
                $userCredentials->type_id = UserCredentials::CREDENTIALS_PASSWORD;                
                $userCredentials->password = md5($this->password);
                $userCredentials->password_repeat = md5($this->password_repeat);
                if ($userCredentials->save()) {
                    if ($this->subscribe=='yes') {
                        $subscriber = Subscriber::model()->findByAttributes(array('email'=>$this->email));
                        if ($subscriber === null) {
                            $subscriber = new Subscriber;
                            $subscriber->email = $this->email;
                            $subscriber->save();
                        }

                        //Mailchimp integration: Add subscriber 
                    $basepath =  Yii::app()->getBasePath();
 					require_once $basepath.'/includes/Mailchimp/MCAPI.class.php';
					require_once $basepath.'/includes/Mailchimp/config.inc.php'; //contains apikey
					
					$api = new MCAPI($apikey);

					
					$merge_vars = array('FNAME'=>$_POST['SignupForm']['first_name'], 'LNAME'=>$_POST['SignupForm']['last_name']);
					

					// By default this sends a confirmation email - you will not see new members
					// until the link contained in it is clicked!
					$retval = $api->listSubscribe( $listId, $_POST['SignupForm']['email'], $merge_vars );

					if ($api->errorCode){
						echo "Unable to load listSubscribe()!\n";
						echo "\tCode=".$api->errorCode."\n";
						echo "\tMsg=".$api->errorMessage."\n";
					} else {
    					echo "Subscribed - look for the confirmation email!\n";
					}
	                        
                    }
                    return $this->login();
                }
                else {
                    foreach($userCredentials->errors as $key=>$msg) {
                        $user->addError($key, $msg);
                    }
                }
            }
            
            
            return $user->errors;
        }
                
        return $this->errors;
    }
    
    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    private function login()
    {
        $this->_identity=new UserIdentity();
        $this->_identity->userName = $this->username;
        $this->_identity->password = $this->password;
        $this->_identity->authenticate();                
        
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE )
        {                                    
            $duration=$this->rememberMe ? Yii::app()->params['cookiesDuration'] : 0;
            return Yii::app()->user->login($this->_identity, $duration);            
        }
        else return $this->_identity->errorCode;
    }
}
