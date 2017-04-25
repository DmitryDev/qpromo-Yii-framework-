<?php

/**
 * This is the model class for table "marketing".
 *
 * The followings are the available columns in table 'marketing':
 * @property integer $id
 * @property string  $name
 * @property string  $issued
 * @property string  $image
 * @property string  $thumbnail
 */
class MarketingTool extends CActiveRecord
{
    public $imageUploader = NULL;
    public $updateCategories = false;
    private $_categories   = array(); 
    
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
		return '{{marketing}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,issued', 'required'),
			array('name', 'length', 'max'=>64),
			array('image,thumbnail', 'length', 'max'=>255),			            
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, issued', 'safe', 'on'=>'search'),
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
            'mtcategory_marketing'=>array(self::HAS_MANY, 'MtCategoryMarketing', 'marketing_id'),
            'mtcategories'=>array(self::HAS_MANY, 'MtCategory', array('mtcategory_id'=>'id'), 'through'=>'mtcategory_marketing'),
            'categories'=>array(self::HAS_MANY, 'MtCategory', array('mtcategory_id'=>'id'), 'through'=>'mtcategory_marketing'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(            
			'name' => 'Name',			
			'image' => 'Image',			
            'thumbnail' => 'Image',		
            'mtcategory'=>'Assigned Categories',
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
		$criteria->compare('issued',$this->issued);		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
             'pagination'=>array(
                'pageSize'=>$pageSize,
            ),
		));
	}
    
    public function uploadImage()
    {
        // Add new image of an issue if it was uploaded
        if ($this->imageUploader) {
            if (in_array($this->imageUploader->type, array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif'))) {
                $extension = $this->imageUploader->extensionName;
                $fileName =  $this->id  . '_' . time();
                
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['marketingImagePath'];               
                $imageParams = Yii::app()->params['marketingImageSize'];
        
                $this->image = $fileName . '.' . $extension;
                $this->thumbnail = $fileName . '-thumb' . '.' . $extension;
                                            
                $this->imageUploader->saveAs($imagePath .$this->image);
                try {                    
                    $image = Yii::app()->image->load($imagePath .$this->image);                                        
                }
                catch (CException $e) {
                    $this->addError('imageUploader', 'Can not upload the file. Make sure you have permitions to write the file.');
                    return false;
                }
                
                $image->resize($imageParams['thumbnail']['width'], $imageParams['thumbnail']['height'], Image::AUTO)->sharpen(20);
                $image->save($imagePath . $this->thumbnail);            
                                                
                $this->save(false);
                return true;
            } else {
                $this->addError('imageUploader', 'Incorrect file type');
            }
        }
        
        return true;
    }        
    
     public function beforeDelete() {
        parent::beforeDelete();        
        $this->deleteImage();
        return TRUE;
    }
    
    public function deleteImage()
    {
        if ($this->image)
        {
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['marketingImagePath'];
            @unlink($imagePath .'/'. $this->image);
            @unlink($imagePath .'/'. $this->thumbnail);
        }
    }
    
     protected function afterSave() {
        parent::afterSave();

        if ($this->updateCategories)
        {
            // Update the information about assigned categories
            foreach($this->mtcategory_marketing as $mt_cat) $mt_cat->delete();                
            foreach($this->_categories as $cat_id)
            {
                $mtcategory_marketing = new MtCategoryMarketing;
                $mtcategory_marketing->mtcategory_id = $cat_id;
                $mtcategory_marketing->marketing_id = $this->id;
                try { $mtcategory_marketing->save(); }
                catch(Exception $e) {}
            }
        }
    }
    
    public function setCategories($list) {
        $this->_categories = $list;
    }
    
    /*public function getCategoriesList() {
        $list = '';
        foreach($this->categories as $category) {
            $list .= $category->id . ',';
        }
        
        $list .= '0';        
        return $list;
    }*/
    
    public function getCategoriesList() {
        $list = array();
        foreach($this->categories as $category) {
            if (!in_array($category->id, $list)) {
                $list[]=$category->id;
                $parent = $category->parent;
                while($parent!==null) {
                    if (!in_array($parent->id, $list)) $list[]=$parent->id;
                    $parent = $parent->parent;
                }
            }
        }
        
        $list[] = 0;
        return join(',', $list);
    }
}