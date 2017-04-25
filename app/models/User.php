<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $email
 * @property string  $username
 * @property string  $company
 * @property string  $phone 
 * @property string  $industry_asi
 * @property string  $industry_ppai
 * @property string  $industry_sage
 * @property string  $industry_upic
 * @property string  $updated_at
 * @property string  $created_at 
 * @property integer $default_shipping_address
 * @property integer $default_billing_address 
 * @property string  $is_banned
 *  
 * The followings are the available model relations:
 * @property UserIdentity[] $userIdentities
 */
class User extends CActiveRecord
{       
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__) { return parent::model($className); }

    /**
     * @return string the associated database table name
     */
    public function tableName() { return '{{user}}'; }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('first_name, last_name, email, username, company', 'required'),
            array('first_name, last_name', 'length', 'max'=>45),
            array('industry_asi, industry_ppai, industry_sage, industry_upic', 'length', 'max'=>10),
            array('username, company', 'length', 'max'=>32),
            array('phone', 'length', 'max'=>20),
            array('email', 'length', 'max'=>64),
            array('email', 'email'),
            array('email, username', 'unique'),            
            array('is_banned', 'in', 'range'=>array('no', 'yes')),            
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('first_name, last_name, email, username, company, phone, is_banned', 'safe', 'on'=>'search'),
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
            'userCredentials' => array(self::HAS_MANY, 'UserCredentials', 'user_id'),
            'userRoles' => array(self::HAS_MANY, 'UserRole', 'userid'),
            //'shoppingCartItems' => array(self::HAS_MANY, 'ShoppingCart', 'user_id'),
            'addresses' => array(self::HAS_MANY, 'UserAddress', 'user_id'),
            'orders' => array(self::HAS_MANY, 'Order', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(          
            'username' => 'User Name',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',            
            'company' => 'Company',
            'phone' => 'Phone',            
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',            
            'userRoles.itemname' => 'Role',
            'is_banned' => 'Banned',
            'industry_asi'=>'ASI #',
            'industry_ppai'=>'PPAI #',
            'industry_sage'=>'SAGE #',
            'industry_upic'=>'UPIC #',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search($pageSize = null)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;              
        $criteria->compare('username',$this->username,true);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('email',$this->email,true);        
        $criteria->compare('company',$this->company,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('industry_asi',$this->industry_asi,true);
        $criteria->compare('industry_ppai',$this->industry_ppai,true);
        $criteria->compare('industry_sage',$this->industry_sage,true);
        $criteria->compare('industry_upic',$this->industry_upic,true);
        $criteria->compare('is_banned',$this->is_banned,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>$pageSize,
            ),
        ));
    }
    
    /**
    * Prepares create_at and update_at attributes before saving.
    */
    protected function beforeSave()
    {        
        if ($this->isNewRecord) $this->created_at=new CDbExpression('NOW()');
        $this->updated_at=new CDbExpression('NOW()');                                                    
        return parent::beforeSave();        
    }
    
    /**
    * Clears addresses, credentials and roles before the user deletion
    */
    protected function beforeDelete()
    {        
        foreach ($this->userRoles as $role) $role->delete();
        foreach ($this->userCredentials as $crd) $crd->delete();
        foreach ($this->addresses as $addr) $addr->delete();
        
        return parent::beforeDElete();
    }
    
}