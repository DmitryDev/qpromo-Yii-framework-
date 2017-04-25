<?php

/**
 * This is the model class for table "auth_assignment".
 *
 * The followings are the available columns in table 'auth_assignment':
 * @property string $itemname
 * @property integer $userid
 * @property string $bizrule
 * @property string $data
 *
 * The followings are the available model relations:
 * @property User $user
 */
class UserRole extends CActiveRecord
{
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
        return '{{auth_assignment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(            
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
            'user' => array(self::BELONGS_TO, 'User', 'userid'),
            'role' => array(self::BELONGS_TO, 'AuthItem', 'itemname'),
        );
    }
        
}