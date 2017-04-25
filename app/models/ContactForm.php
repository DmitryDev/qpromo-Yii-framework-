<?php

class ContactForm extends CFormModel
{    
    public $company;
    public $first_name;
    public $last_name;    
    public $email;
    public $phone;
    public $message;
    

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('email, company, message', 'required'),
            array('first_name', 'required', 'message'=>'First name cannot be blank'),
            array('last_name', 'required', 'message'=>'Last name cannot be blank'),            
            array('first_name, last_name', 'field_alphanum'),            
            array('phone', 'length', 'max'=>20),
            array('email', 'length', 'max'=>64),                        
            array('email', 'email'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'company'=>'Company:',
            'first_name'=>'Name:',            
            'email'=>'Email:',
            'phone'=>'Phone Number:',            
            'message'=>'Message:',
        );
    }    
    
    public function field_alphanum($attribute, $params)
    {
        if (!preg_match('/^[a-zA-Z0-9]+$/', $this->$attribute)) {
            if ($attribute == 'first_name')
                $this->addError($attribute, "First name can only contain letters and digits.");            
            elseif ($attribute == 'last_name')
                $this->addError($attribute, "Last name can only contain letters and digits.");            
            else                
                $this->addError($attribute, "Field can only contain letters and digits.");            
        }
    }    
}