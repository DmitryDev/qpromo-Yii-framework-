<?php

/**
 * This is the model class for table "accessory".
 *
 * The followings are the available columns in table 'accessories':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $image
 */
class Accessory extends CActiveRecord
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
		return '{{accessory}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>64),
			array('image', 'length', 'max'=>255),			
			array('small', 'length', 'max'=>255),
            array('description', 'safe'),
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
			'description' => 'Description',
			'image' => 'Image',			
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
		$criteria->compare('description',$this->description,true);		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>$pageSize,
            ),
		));
	}
    
    public function uploadImage()
    {
        // Add new product images if they were uploaded
        if ($this->imageUploader) {
            if (in_array($this->imageUploader->type, array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif'))) {
                $extension = $this->imageUploader->extensionName;
                
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['accessoriesImagePath'];                
                $fileName =  $this->id  . '_' . time() . '.' . $extension;                
                    
                $this->imageUploader->saveAs($imagePath .$fileName);
                try {                    
                    $image = Yii::app()->image->load($imagePath .$fileName);                                        
                }
                catch (CException $e) {
                    $this->addError('imageUploader', 'Can not upload the file. Make sure you have permitions to write the file.');
                    return false;
                }

                $imageParams = Yii::app()->params['productImageSize'];
                $this->image = $fileName;
                $this->small = $this->id  . '_' . time() . '-small' . '.' . $extension;
                $image->resize($imageParams['small']['width'], $imageParams['small']['height'], Image::AUTO)->sharpen(20);
                $image->save($imagePath . $this->id  . '_' . time() . '-small' . '.' . $extension);
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
    	$imagePath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['accessoriesImagePath'];
        if ($this->image)
        {            
            @unlink($imagePath .'/'. $this->image);
        }
    	if ($this->small)
        {
            @unlink($imagePath .'/'. $this->small);            
        }
    }
}