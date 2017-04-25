<?php

/**
 * This is the model class for table "price_code".
 *
 * The followings are the available columns in table 'capacity':
 * @property integer $id
 * @property string  $code
 * @property string  $discount
 */
class PriceCode extends CActiveRecord
{
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
		return '{{price_code}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
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
}