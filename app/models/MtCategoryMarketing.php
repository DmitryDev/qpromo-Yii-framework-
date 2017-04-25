<?php

/**
 * This is the model class for table "mtcategory_marketing".
 *
 * The followings are the available columns in table 'mtcategory_marketing':
 * @property integer $id
 * @property integer $marketing_id
 * @property integer $category_id
 *
 * The followings are the available model relations:
 * @property MtCategory $mtcategory
 * @property Marketing  $marketing
 */
class MtCategoryMarketing extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MtCategoryMarketing the static model class
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
		return '{{mtcategory_marketing}}';
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'marketing'  => array(self::BELONGS_TO, 'Marketing', 'marketing_id'),
			'mtcategory' => array(self::BELONGS_TO, 'MtCategory', 'mtcategory_id'),
		);
	}

	

	
}