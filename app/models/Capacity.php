<?php

/**
 * This is the model class for table "capacity".
 *
 * The followings are the available columns in table 'capacity':
 * @property integer $id
 * @property integer $value
 */
class Capacity extends CActiveRecord
{
    
    public $units;
    public $formEntry;
    
    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Faq the static model class
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
		return '{{capacity}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
        // NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('formEntry', 'required'),
			array('formEntry', 'length', 'min'=>0),		            
            array('formEntry', 'numerical', 'integerOnly'=>true),
            array('formEntry', 'maxCapacity'),		            
            array('units', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('value', 'safe', 'on'=>'search'),
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
		);
	}

	/** @return array customized attribute labels (name=>label)*/
	public function attributeLabels() {}
    
    /** @return string translated capacity value. Ex.: 1GB instead of 1048567*/
    public static function translateCapacity($amount) {
        $val = '';
        if ($amount < 1024) $val = $amount . "MB";
        if ($amount >= 1024 && $amount < 1024*1024 ) $val = number_format($amount/1024) . "GB";
        if ($amount >= 1024*1024 ) $val = number_format($amount/(1024*1024)) . "TB";
        return $val;
    }
    
    public function search($pageSize = null)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('value',$this->value,true);		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
             'pagination'=>array(
                'pageSize'=>$pageSize,
            ),
		));
	}
    
    public function getUnitsListBoxArray() {
        $units = array();
                        
        $units['1'] = 'MB';
        $units['1024'] = 'GB';
        $units['1048576'] = 'TB';
       
        return $units;
    }
    
    protected function beforeSave() {                     
        $this->value = $this->formEntry * $this->units;
        
        return parent::beforeSave();
    }
    
    public function maxCapacity($attribute, $params)
    {        
        $value=$this->$attribute*$this->units;        
        
        if ($value>	2147483647)
            $this->addError($attribute, "Value must be less then 2048TB.");            
        
    }
}