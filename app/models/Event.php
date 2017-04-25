<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $link
 * @property string $place
 * @property string $date
 * @property integer $duration
 */
class Event extends CActiveRecord
{    
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Specials the static model class
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
		return '{{event}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, date, duration', 'required'),
			array('name', 'length', 'max'=>64),
			array('link, place', 'length', 'max'=>255),
			array('description, date', 'safe'),
            array('duration', 'numerical', 'integerOnly'=>true, 'min'=>1),            
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, place, date', 'safe', 'on'=>'search'),
		);
	}

	

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(            
			'name' => 'Name',
			'description' => 'Description',
			'place' => 'Place',
            'duration' => 'Duration (days)',
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

		$criteria->compare('name',$this->name,true);
		$criteria->compare('place',$this->place,true);		
		$criteria->compare('date',$this->date);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>$pageSize,
            ),
		));
	}
}