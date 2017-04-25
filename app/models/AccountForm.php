<?php

class AccountForm extends CFormModel
{    
    public $company;
    public $name;
    public $username;
    public $email;
    public $phone;
    
    public $oldPassword;
    public $password;
    public $password_repeat;    

    public $industry_asi;
    public $industry_ppai;
    public $industry_upic;
    public $industry_sage;
    

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('username, name, email, company', 'required'),
            array('username, company', 'length', 'max'=>32),
            array('name', 'length', 'max'=>91),
            array('name', 'firstlastname'),
            array('username', 'length', 'min'=>5),
            array('username', 'field_alphanum'),
            array('phone', 'length', 'max'=>20),
            array('email', 'length', 'max'=>64),                        
            array('email', 'email'), 
            array('email, username', 'field_unique'),
            array('password', 'length', 'max'=>32, 'message'=>'Field is too long (maximum is 32 characters).'),
            array('password', 'length', 'min'=>5, 'message'=>'Field is too short (minimum is 5 characters).'),
            array('password_repeat', 'compare', 'compareAttribute'=>'password','message'=>'Password must be repeated exactly'),
            array('oldPassword', 'currentPassword'),
            array('industry_asi, industry_ppai, industry_sage, industry_upic', 'length', 'max'=>10),

        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'company'=>'Company:',
            'name'=>'Name:',
            'username'=>'Username:',
            'email'=>'Email:',
            'phone'=>'Phone Number:',
            'password'=>'New Password:',
            'password_repeat'=>'Confirm New Password:',
            'oldPassword'=>'Current Password:',
            'industry_asi'=>'ASI <span>(optional)</span>:',
            'industry_ppai'=>'PPAI <span>(optional)</span>:',
            'industry_sage'=>'SAGE <span>(optional)</span>:',
            'industry_upic'=>'UPIC <span>(optional)</span>:',
        );
    }
    
    public function firstlastname($attribute, $params)
    {
        $matches = array();
        if (!preg_match('/^[a-zA-Z0-9 ]+$/', $this->$attribute)) {
            $this->addError($attribute, "$attribute can only contain letters and digits.");
            return;
        }

        if (!preg_match('/^([a-zA-Z0-9]+) ([a-zA-Z0-9]+)/', $this->$attribute, $matches)) {
            $this->addError($attribute, "$attribute must contain firstname and lastname.");            
            return;
        }
        
        if (strlen($matches[1])>45 || strlen($matches[2])>45)
            $this->addError($attribute, "Firstname or lastname is too long (maximum is 45 characters).");
    }
    
    public function field_unique($attribute, $params)
    {        
        $user = User::model()->findByAttributes(array($attribute=>$this->$attribute));
        if ($user && $user->id != Yii::app()->user->id) {
            $this->addError($attribute, "The $attribute already exists.");            
        }
    }
    
    public function field_alphanum($attribute, $params)
    {        
        if (!preg_match('/^[a-zA-Z0-9]+$/', $this->$attribute)) {        
            $this->addError($attribute, "$attribute can only contain letters and digits.");            
        }
    }
    
    public function currentPassword($attribute, $params)
    {
        if (empty($this->$attribute)) return;
            
        $user = User::model()->findByPk(Yii::app()->user->id);
        if (!$user) {
            $this->addError($attribute, "Wrong current password provided.");
            return;
        }
              
        $password = null;
        foreach($user->userCredentials as $credentials) {
            if ($credentials->type_id == UserCredentials::CREDENTIALS_PASSWORD) $password = $credentials->password;
        }
        
        if ($password !== md5($this->$attribute)) {
            $this->addError($attribute, "Wrong current password provided.");
        }
    }
}