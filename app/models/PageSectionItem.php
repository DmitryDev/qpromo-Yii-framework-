<?php

/**
 * This is the model class for table "page_section_item".
 *
 * The followings are the available columns in table 'page_section':
 * @property integer $id
 * @property integer $section_id
 * @property string $name
 * @property string $spec
 * @property string $content
 * @property string $file
 */
class PageSectionItem extends CActiveRecord
{
    
    public $fileUploader;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PageSection the static model class
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
		return '{{page_section_item}}';
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
            array('name', 'length', 'max'=>128),
            array('spec', 'length', 'max'=>255),
            array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name', 'safe', 'on'=>'search'),
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
            'section' => array(self::BELONGS_TO, 'PageSection', 'section_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'spec' => 'Specification',
            'file' => 'File',
			'content' => 'Content',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->compare('name',$this->name,true);		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function uploadFile()
    {
        // Add new file if it was uploaded
        if ($this->fileUploader) {            
            $extension = $this->fileUploader->extensionName;

            $filePath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['downloadsPath'];                
            $fileName =  $this->id  . '_' . time() . '.' . $extension;                

            $this->fileUploader->saveAs($filePath .$fileName);            
            $file = file_get_contents($filePath .$fileName);                                        
            
            if ($file === false) {
                $this->addError('fileUploader', 'Can not upload the file. Make sure you have permitions to write the file.');
                return false;
            }

            $this->file = $fileName;
            $this->save(false);
            return true;            
        }
        
        return true;
    }
    
    public function beforeDelete() {
        parent::beforeDelete();        
        $this->deleteFile();
        return TRUE;
    }
    
    public function deleteFile()
    {
        if (!empty($this->file))
        {
            $filePath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['downloadsPath'];
            @unlink($filePath .'/'. $this->file);
            $this->file='';
            $this->save(false);
        }
    }
    
    public function getFileSize() {
        if (empty($this->file)) return 0;
        
        $filePath = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->params['downloadsPath'];
        $size = filesize($filePath . $this->file);
        
        if ($size===false) return 0;
        return $size;
    }
    
    public function translateFileSize($size) {
        if ($size<1024) return $size . ' bytes';
        if ($size>=1024 && $size<1024*1024) return number_format ($size/1024, 2) . ' Kbytes';
        if ($size>=1024*1024 && $size<1024*1024*1024) return number_format ($size/(1024*1024), 2) . ' Mbytes';
    }
    
    public function getFilePath() {
        $filePath = Yii::app()->params['downloadsPath'].$this->file;
        return $filePath;
    }
        
}