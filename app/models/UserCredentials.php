<?php

/**
 * This is the model class for table "user_credentials".
 *
 * The followings are the available columns in table 'user_credentials':
 * @property integer $id
 * @property integer $user_id
 * @property integer $type_id
 * @property string $password
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserCredentials extends CActiveRecord
{
    
    //const IDENT_TYPE_PASSWORD = 1; //This is the old type name
    
    const CREDENTIALS_PASSWORD = 1;//The new type names
    const CREDENTIALS_FACEBOOK = 2;//
    
    public $password_repeat;
   
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserCredentials the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user_credentials}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('password', 'required'),
            array('password', 'length', 'max'=>32),            
            array('password_repeat', 'safe'),
            array('password', 'compare'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'password' => 'Password',
            'password_repeat' => 'Confirm',
        );
    }  
}