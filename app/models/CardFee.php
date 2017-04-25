<?php

/**
 * This is the model class for table "ccard_fee".
 *
 * The followings are the available columns in table 'ccard_fee': 
 * @property integer $quantity
 * @property string  $value
 * 
 */
class CardFee extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProductImage the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{ccard_fee}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('quantity, value', 'required'),
			array('value', 'numerical', 'min'=>0),
            array('quantity', 'numerical', 'integerOnly'=>true, 'min'=>'0'),
        );
	}
}