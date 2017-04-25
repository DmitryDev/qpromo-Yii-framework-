<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property integer $id
 * @property string $value  
 * @property string $expire_at (timestamp) 
 */
class Token extends CActiveRecord
{    
     /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Page the static model class
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
		return '{{token}}';
	}
    
    /**
    * Prepares expire_at attribute before performing validation.
    */
    protected function beforeSave()
    {
        if ($this->isNewRecord)
        {
            self::removeExpired();
            $expire = time() + Yii::app()->params['tokenDuration'];
            $this->expire_at= new CDbExpression("FROM_UNIXTIME($expire)");
            $this->value = md5(md5('Rumor'). time() . md5('Deals'));
        }
        return parent::beforeSave();
    }
    
    public static function removeExpired()
    {
        $creteria = new CDbCriteria;
        $creteria->condition = 'expire_at < ' . new CDbExpression('NOW()');
        Token::model()->deleteAll($creteria);
    }
    
    public function expired()
    {
        $sql = "SELECT UNIX_TIMESTAMP('{$this->expire_at}')";
        $timestamp = Yii::app()->db->createCommand($sql)
                    ->queryScalar();
        return $timestamp < time();           
    }
	
}