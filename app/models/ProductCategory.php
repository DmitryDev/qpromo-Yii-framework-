<?php

/**
 * This is the model class for table "product_category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property integer $product_id
 * @property integer $category_id
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property Product  $product
 */
class ProductCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return '{{product_category}}';
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'product'  => array(self::BELONGS_TO, 'Product', 'product_id'),
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
		);
	}

	

	
}