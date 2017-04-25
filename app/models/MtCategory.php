<?php

/**
 * This is the model class for table "mtcategory".
 *
 * The followings are the available columns in table 'mtcategory':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property MtCategory $parent
 * @property MtCategory[] $categories
 */
class MtCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MtCategory the static model class
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
		return '{{mtcategory}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, parent_id', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, name', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'MtCategory', 'parent_id'),
			'children' => array(self::HAS_MANY, 'MtCategory', 'parent_id','order'=>'name asc'),            
            'mtcategory_marketing'=>array(self::HAS_MANY, 'MtCategoryMarketing', 'mtcategory_id'),
            'marketings'=>array(self::HAS_MANY, 'MarketingTool', array('marketing_id'=>'id'), 'through'=>'mtcategory_marketing')            
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent Category',
			'name' => 'Name',            
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

		$criteria->compare('id',$this->id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    
    /**
    * Prepares create_at attribute before performing validation.
    */
    /*protected function beforeSave()
    {
        $this->updated_at=new CDbExpression('NOW()');                                    
        return parent::beforeValidate();
    } */   
    
    public function getRootNode()
    {
        $node = $this;
        while($node->parent_id) $node = MtCategory::model()->findByPk($node->parent_id);
        return $node;
    }
       
    public static function getTopLevelCategories() {        
        return self::model()->findAll('parent_id IS NULL');        
    }        
    
    public static function buildCategoriesList(&$list, $node_id)
    {
        if ($node_id === NULL || $list===NULL || !is_array($list)) return;
        
        $node = MtCategory::model()->findByPk($node_id);
        if ($node === NULL) return;
        
        $list[] = $node_id;            
        
        if (!count($node->children)) return;
        
        foreach ($node->children as $child) self::buildCategoriesList($list, $child->id);
    }
}