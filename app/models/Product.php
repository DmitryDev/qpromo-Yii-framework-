<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property integer $id
 * @property string  $name 
 * @property string  $is_published enum('yes','no')
 * @property string  $updated_at
 * @property string  $description 
 * @property integer $vied 
 * @property integer $main_image_id 
 * @property boolean $deleted
 * @property string  $model_number
 * @property string  $colors comma separated color values 
 * @property string  $custom_color enum('yes','no')
 * @property string  $tags comma separated string of tags
 * @property string  $width
 * @property string  $height
 * @property string  $length
 * @property string  $diameter
 * @property string  $size_in
 * @property string  $weight_in
 * @property integer $price_code_id
 * 
 * The followings are the available model relations:
 * @property Category[] $categories
 * @property ProductCategory[] $product_categories
 * @property ProductImage[] $product_images
 * @property PriceCode $priceCode
 * @property ProductPrice[] $prices
 */
class Product extends CActiveRecord
{    
    public $updateCategories = false;
    public $uploadedImages = NULL;
    public $name_from = '';
    public $email_from = '';
    public $name_to = '';
    public $email_to = '';
    public $email_message = '';
    
    public $isNewRelease = false;
 
    private $_sizeUnits = array('in'=>'in','ft'=>'ft','yd'=>'yd','mm'=>'mm','cm'=>'cm','dm'=>'dm','m'=>'m');
    private $_weightUnits = array('oz'=>'oz','lb'=>'lb','mg'=>'mg','g'=>'g','kg'=>'kg','ct'=>'ct');
    
    private $_categories   = array();    
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		$url = Yii::app()->request->requestUri;
		if(strpos($url,'emailtoclient') >0){
			return array(
				array('name_from,email_from,name_to,email_to', 'required'),
				array('email_from,email_to', 'email'),		
			);
		
		} else {
			return array(
				array('name, model_number', 'required'),
				array('name', 'length', 'max'=>128),
            	array('model_number', 'length', 'max'=>32), 
            	array('colors', 'length', 'max'=>255), 
            	array('width, height, length, diameter, weight', 'numerical'),
            	array('width, height, length, diameter', 'length', 'max'=>9),
            	array('weight', 'length', 'max'=>13),            
				array('description, is_published, isNewRelease, custom_color, tags, size_in, weight_in', 'safe'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('name, model_number,tags,is_published, release_date', 'safe', 'on'=>'search'),
			);
		  }
		}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'product_categories'=>array(self::HAS_MANY, 'ProductCategory', 'product_id'),
            'categories'=>array(self::HAS_MANY, 'Category', array('category_id'=>'id'), 'through'=>'product_categories'),
            'product_images'=>array(self::HAS_MANY, 'ProductImage', 'product_id'),            
            'capacities'=>array(self::HAS_MANY, 'ProductPrice', 'product_id', 'group'=>'capacity', 'order'=>'capacity asc'),
            'maxCapacity'=>array(self::STAT, 'ProductPrice', 'product_id', 'select'=>'max(`capacity`)'),
            'minCapacity'=>array(self::STAT, 'ProductPrice', 'product_id', 'select'=>'min(`capacity`)'),
            'defaultImage'=>array(self::BELONGS_TO, 'ProductImage', 'main_image_id'),
            'images'=>array(self::HAS_MANY, 'ProductImage', 'product_id'),
            'imprint'=>array(self::HAS_ONE, 'ProductImprint', 'product_id'),
            'priceCode'=>array(self::BELONGS_TO, 'PriceCode', 'price_code_id'),
            'prices'=>array(self::HAS_MANY, 'ProductPrice', 'product_id'),
            'productAccessories'=>array(self::HAS_ONE, 'ProductAccessory', 'product_id'),
            'productPreloaded'=>array(self::HAS_ONE, 'ProductPreloaded', 'product_id'),
            'productPackaging'=>array(self::HAS_ONE, 'ProductPackaging', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(			
			'name' => 'Name',
            'model_number' => 'Model',
            'release_date' => 'Released',
			'is_published' => 'Is Published',            
			'updated_at' => 'Updated At',
			'description' => 'Description',						
            'category'=>'Assigned Categories',
            'viewed'=>'Viewed (times)',
            'isNewRelease'=>'New Product',
            'custom_color'=>'Custom color available',
            'uploadedImages'=>'Upload New Images',
            'width'=>'Width',
            'height'=>'Height',
            'length'=>'Length',
            'diameter'=>'Diameter',
            'weight'=>'Weight',
            'width_in'=>'Weight Units',
            'size_in'=>'Size Units',
            'tags'=>'Tag',
			'name_from' => 'From'.'<span id="astrick">*</span>',
			'email_from' => 'Your Email'.'<span id="astrick">*</span>',
			'name_to' => 'To'.'<span id="astrick">*</span>',
			'email_to' => 'To Email Address'.'<span id="astrick">*</span>',
			'email_message' => 'Message'			
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($pageSize = null) {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;        
        //$criteria->compare('deleted', '0', false);		
		$criteria->compare('name',$this->name,true);
        $criteria->compare('model_number',$this->model_number,true);
        $criteria->compare('tags',$this->tags,true);
		$criteria->compare('is_published',$this->is_published,true);
        $criteria->compare('release_date',$this->release_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>$pageSize,
            ),
		));
	}        
    
    /**
    * Prepares update_at and release_date attributes before performing validation.
    */
    protected function beforeSave() {
        $now = new CDbExpression('NOW()');
        
               
        if ($this->isNewRecord || $this->isNewRelease) $this->release_date = $now;
        if($this->isNewRelease == 1 || $this->isNewRecord == 1) $this->is_new = 1;
        else $this->is_new = 0;
        $this->updated_at = $now;
        
        return parent::beforeSave();
    }
    
    public function markDeleted() {
        $this->deleted = true;
        $this->save(false);
    }
    
    protected function afterSave() {
        parent::afterSave();

        if ($this->updateCategories)
        {
            // Update the information about assigned categories
            foreach($this->product_categories as $p_cat) $p_cat->delete();                
            foreach($this->_categories as $cat_id)
            {
                $product_category = new ProductCategory;
                $product_category->category_id = $cat_id;
                $product_category->product_id = $this->id;
                try { $product_category->save(); }
                catch(Exception $e) {}
            }
        }
    }

    public function saveUploadedImages()
    {
        // Add new product images if they were uploaded
        if ($this->uploadedImages) {
            $uploadError = false;
                              
            foreach ($this->uploadedImages as $image) {                 
                $productImage = new ProductImage;
                if ($productImage->uploadImage($image, $this)) {
                    if (!$this->main_image_id) {
                        $this->main_image_id = $productImage->id;
                        $this->save(false);
                    }
                }
                else $uploadError = true;
            }            
            
            if ($uploadError) {
                $this->addError('uploadedImages', 
                    'Errors occured while uploading images. Make sure the images types are correct and you have write permitions on the "product" folder');                
                return false;
            }

        }
        
        return true;
    }
    
    public function deleteImages($imageList) {             
        foreach ($imageList as $image_id) {				
            $image = ProductImage::model()->findByPk($image_id);
            if ($image) $image->delete();				            
		}
                    
        $this->correctMainImage();
        $this->save();
    }
    
    private function correctMainImage() {
        $defaulImageFound = FALSE;
        foreach ($this->product_images as $img) {
            if ($img->id === $this->main_image_id) {
                $defaulImageFound = true;
                break;
            }
        };
        
        $img_id = count($this->product_images) ? $this->product_images[0]->id : NULL;
        $this->main_image_id = $defaulImageFound ? $this->main_image_id :$img_id;
    }

    
    public function setCategories($list) {
        $this->_categories = $list;
    }
    
    public function getColorsArray() {
        $colors = array();
        foreach(split(';', $this->colors) as $c)
            if (!empty($c)) $colors[]= $c;
        return $colors;
    }
    
    public function getSizeUnits() {
        return $this->_sizeUnits;
    }
    
    public function getWeightUnits() {
        return $this->_weightUnits;
    }
    
    public function getPriceCodesArray() {
        $priceCodes = array('0'=>'N/A');
        foreach (PriceCode::model()->findAll() as $code) {
            $priceCodes[$code->id] = $code->code . " (" . number_format($code->discount) . "%)";
        }
        return $priceCodes;
    }
    
    public function getCapacitiesArray() {
        $capacities = array();
        
        foreach($this->capacities as $productPrice)
            if ($productPrice->capacity>0 && !in_array($productPrice->capacity, $capacities))
                    $capacities[]=$productPrice->capacity;
        
        return $capacities;
    }
    
    public function getCapacitiesListBoxArray() {
        $capacities = array();
                
        foreach($this->capacitiesArray as $capacity)
            $capacities[$capacity] = Capacity::translateCapacity($capacity);
       
        return $capacities;
    }
    
    public function getDiscountsListBoxArray() {
        $discounts = array(0=>'N/A');
                
        $priceCodes = PriceCode::model()->findAll();
        foreach($priceCodes as $discount)
            //if ($this->price_code_id == $discount->id)
            $discounts[$discount->id] = $discount->code . 
                ' (' . number_format($discount->discount).'%)';
       
        return $discounts;
    }
    
    public function getIsMedia() {
        // Checkes if the product is a flash drive 
        return !empty($this->capacitiesArray);
    }
        
    
    public function quantityPrice($quantity) {	
        $capacities = $this->capacitiesArray;
        
        if (!empty($capacities)) $capacity = $capacities[0];
        else $capacity = 0;        
		
	
        $prices = ProductPrice::model()->findAllByAttributes(array('product_id'=>$this->id, 'capacity'=>$capacity));                
        if ($prices === null) return 0;                
        
        $a = $b = 0;
        $price_a = $price_b = 0;
        foreach($prices as $price) {	    	    
            if ($price->quantity >=$a && $price->quantity<=$quantity) {
                $a = $price->quantity;
                $price_a = $price->price;
            }
            if ($price->quantity >$quantity) {
                if ($b==0) {
                    $b = $price->quantity;
                    $price_b = $price->price;
                }
                elseif ($price->quantity<$b) {
                    $b = $price->quantity;
                    $price_b = $price->price;
                }

            }
        }        

        return $price_a;            
    }
    
}