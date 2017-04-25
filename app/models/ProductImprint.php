<?php

class ProductImprint extends CActiveRecord
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
		return '{{product_imprint}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('width, height', 'numerical'),
            array('width, height', 'length', 'max'=>9),
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
    
     public function getAreasArray() {
        $areas = array();
        foreach (split(';', $this->areas) as $area)
            if (!empty($area)) $areas[]= $area;
        return $areas;
    }
    
    public function getPrintingModels() {
        if (empty ($this->printings)) return array();
        return Printing::model()->findAll("`id` in ($this->printings)");
    }
    

}