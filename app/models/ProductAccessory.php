<?php

class ProductAccessory extends CActiveRecord
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
		return '{{product_accessory}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(            
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
    
     public function getAccessoriesArray() {
        $accessories = array();
        foreach (split(';', $this->accessories) as $accessory)
            if (!empty($accessory)) $accessories[]= $accessory;
        return $accessories;
    }
    
    public function getAccessoryModels() {
        if (empty($this->accessories)) return array();
        return Accessory::model()->findAll("id in ($this->accessories)");
    }
    

}