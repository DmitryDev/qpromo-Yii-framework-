<?php

class PwdRecoveryForm extends CFormModel
{    
    public $email;     

    /**
     * Declares the validation rules.     
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('email', 'required'),                        
            // password needs to be authenticated
            array('email', 'email'),            
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'email'=>'Email',            
        );
    }    
}
