<?php

/**
 * This is the model class for table "packaging".
 *
 * The followings are the available columns in table 'packaging':
 * @property integer $id
 * @property string $name
 * @property string $model_number
 * @property string $width
 * @property string $height
 * @property string $length
 * @property string $diameter
 * @property string $weight
 * @property string $description
 * @property string $customization
 * @property string $image
 * @property string $image2
 */
class Packaging extends CActiveRecord
{
    public $imageUploader = NULL;
    
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
		return '{{packaging}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, model_number', 'required'),
			array('name', 'length', 'max'=>64),            
            array('model_number', 'length', 'max'=>32), 
            array('width, height, length, diameter, weight', 'numerical'),
            array('width, height, length, diameter, weight', 'length', 'max'=>9),            
			array('image, image2,small,small2', 'length', 'max'=>255),			
            array('description, customization', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, description', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(			
			'name' => 'Name',
            'model_number' => 'Model',            
			'description' => 'Description',
            'customization' => 'Customization',            
            'width'=>'Width',
            'height'=>'Height',
            'length'=>'Length',
            'diameter'=>'Diameter',
            'weight'=>'Weight',            
            'image'=>'Image',
            'image2'=>'Alternative Image',
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
		$criteria->compare('model_number',$this->model_number,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>$pageSize,
            ),
		));
	}
    
    public function uploadImage($alternative=false)
    {
        // Add new product images if they were uploaded
        if ($this->imageUploader) {
            if (in_array($this->imageUploader->type, array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif'))) {
                $extension = $this->imageUploader->extensionName;
                
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['packagingImagePath'];                
                $suffix = ($alternative)? '_2' : '_1';
                $fileName =  $this->id  . '_' . time(). $suffix . '.' . $extension;                
                    
                $this->imageUploader->saveAs($imagePath .$fileName);
                try {                    
                    $image = Yii::app()->image->load($imagePath .$fileName);                                        
                }
                catch (CException $e) {
                    $this->addError('imageUploader', 'Can not upload the file. Make sure you have permitions to write the file.');
                    return false;
                }
                                
                $imageParams = Yii::app()->params['productImageSize'];
                if ($alternative) {
                	$this->image2 = $fileName;
                	 $this->small2 = $this->id  . '_' . time() . '-small2' . '.' . $extension;	
                }
                else {
                	$this->image = $fileName;
                    $this->small = $this->id  . '_' . time() . '-small' . '.' . $extension;	
                }
                $image->resize($imageParams['small']['width'], $imageParams['small']['height'], Image::AUTO)->sharpen(20);
               	$image->save($imagePath . $this->id  . '_' . time() . '-small' . '.' . $extension);
               	$image->resize($imageParams['small']['width'], $imageParams['small']['height'], Image::AUTO)->sharpen(20);
                $image->save($imagePath . $this->id  . '_' . time() . '-small2' . '.' . $extension);
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
        $this->deleteImage2();        
        return TRUE;
    }
    
    public function deleteImage()
    {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['packagingImagePath'];
        if ($this->image) @unlink($imagePath .'/'. $this->image);
		if ($this->small) @unlink($imagePath .'/'. $this->small);                            
    }
    
    public function deleteImage2()
    {
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['packagingImagePath'];        
        if ($this->image2) @unlink($imagePath .'/'. $this->image2);
        if ($this->small2) @unlink($imagePath .'/'. $this->small2);
        
    }
}