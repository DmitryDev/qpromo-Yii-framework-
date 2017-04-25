<?php

/**
 * This is the model class for table "product_price".
 *
 * The followings are the available columns in table 'product_price':
 * @property integer $product_id
 * @property integer $quantity
 * @property string  $price
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductPrice extends CActiveRecord
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
		return '{{product_price}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('quantity, price', 'required'),
			array('quantity', 'numerical', 'min'=>0),
            array('quantity', 'numerical', 'integerOnly'=>true, 'min'=>'0'),
        );
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}
        
}