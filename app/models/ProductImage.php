<?php

/**
 * This is the model class for table "product_image".
 *
 * The followings are the available columns in table 'product_image':
 * @property integer $id
 * @property integer $product_id
 * @property string $path_origin
 * @property string $path_small
 * @property string $path_large
 * @property string $path_tiny
 * @property string $path_thumbnail
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductImage extends CActiveRecord
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
		return '{{product_image}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array();
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
    
    /**
     * Creates and returns an array of product images names
     * @param integer $productId
     * @return array of path-strings
     */
    private function getExistentNames($productId)
	{
		$pathList = array();
		$imageList = self::model()->findAllByAttributes(array('product_id' => $productId));
		foreach ($imageList as $image) {
			$pathList[] = $image->origin;
		}
		return $pathList;
	}
            
    /**
     * Upload an product image and put a new record about it into the table
     * @param CUploadedFile $image
     * @param Product $product
     * @return mixed Uploaded image integer id or NULL.
     */
    public function uploadImage($image, $product) {
        if (!in_array($image->type, array('image/jpeg', 'image/pjpeg', 'image/png', 'image/x-png', 'image/gif'))) {
            $this->addError('uploadedImage', 'Incorrect file type');
            return false;
        }

        if (!$product) {
            $this->addError('uploadedImage', 'Error occured while uploading an image (no product).');
            return false;
        }
        
        $names = $this->getExistentNames($product->id);        
        $time = time();
        $counter=0;
        $extension = $image->extensionName;
        $imageName = $product->id . '_' .  $time.'_'.$counter;        
        while (in_array($imageName . '.' . $extension, $names)) {                
                $counter++;
                $imageName = $product->id . '_' .  $time.'_'.$counter;                
        }                
        
        $imagesPath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['productImagesPath'];
        $imageParams = Yii::app()->params['productImageSize'];
        
        $this->origin = $imageName . '.' . $extension;
        $this->small = $imageName . '-small' . '.' . $extension;
        $this->large = $imageName . '-large' . '.' . $extension;
        $this->huge = $imageName . '-huge' . '.' . $extension;
        $this->full = $imageName . '-full' . '.' . $extension; 

        $image->saveAs($imagesPath . $this->origin);
        
        try {
            $image = Yii::app()->image->load($imagesPath . $imageName . '.' . $extension);
        }
        catch (CException $e) {
            $this->addError('uploadedImage', 'Can not upload the file. Make sure you have permitions to write the file.');
            return false;
        }

        $image->resize($imageParams['small']['width'], $imageParams['small']['height'], Image::AUTO)->sharpen(20);
        $image->save($imagesPath . $imageName . '-small' . '.' . $extension);            
        
        $image->resize($imageParams['large']['width'], $imageParams['large']['height'], Image::AUTO)->sharpen(20);
        $image->save($imagesPath . $imageName . '-large' . '.' . $extension);            	
        
        $image->resize($imageParams['huge']['width'], $imageParams['huge']['height'], Image::AUTO)->sharpen(20);
        $image->save($imagesPath . $imageName . '-huge' . '.' . $extension);

        $image->resize($imageParams['full']['width'], $imageParams['full']['height'], Image::AUTO)->sharpen(20);
        $image->save($imagesPath . $imageName . '-full' . '.' . $extension);

        $this->product_id = $product->id;
        return $this->save();
    }
    
    public function beforeDelete() {
        parent::beforeDelete();
        
        $imagesPath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['productImagesPath'];
        @unlink($imagesPath . $this->origin);        
        @unlink($imagesPath . $this->small);
        @unlink($imagesPath . $this->large);
        @unlink($imagesPath . $this->huge);
        @unlink($imagesPath . $this->full);
        
        return TRUE;
    }

}