<?php

/**
 * This is the model class for table "category".
 *
 * The followings are the available columns in table 'category':
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $description
 * @property string $url
 * @property string $is_published
 * @property string $updated_at
 * @property integer $order
 *
 * The followings are the available model relations:
 * @property Category $parent
 * @property Category[] $categories
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return '{{category}}';
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
			array('parent_id, order', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>64),
			//array('tag', 'length', 'max'=>32),
			//array('slug', 'length', 'max'=>128),
            array('url', 'length', 'max'=>255),
			array('is_published', 'length', 'max'=>3),
            array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parent_id, name, tag, slug, is_published, updated_at, order', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'Category', 'parent_id'),
			'children' => array(self::HAS_MANY, 'Category', 'parent_id'),
            'categories' => array(self::HAS_MANY, 'Category', 'parent_id'), //this is just alias name for children. It is used in some places this way (from the old code).
            'category_products'=>array(self::HAS_MANY, 'ProductCategory', 'category_id'),
            'products'=>array(self::HAS_MANY, 'Product', array('product_id'=>'id'), 'through'=>'category_products')            
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
            'description' => 'Description',
			'tag' => 'Tag',
			'url' => 'URL',
			'is_published' => 'Is Published',
			'updated_at' => 'Updated At',
			'order' => 'Order',
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
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('is_published',$this->is_published,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('order',$this->order);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    
    /**
    * Prepares create_at attribute before performing validation.
    */
    protected function beforeSave()
    {
        $this->updated_at=new CDbExpression('NOW()');                                    
        return parent::beforeValidate();
    }    
    
    public function getRootNode()
    {
        $node = $this;
        while($node->parent_id) $node = Category::model()->findByPk($node->parent_id);
        return $node;
    }
       
    public static function getTopLevelCategories() {        
        return self::model()->findAll('parent_id IS NULL');        
    }
    
    public static function getProductCategoryIdBySlug($slug)
    {
        $categories = self::model()->findAllByAttributes(array('slug'=>$slug));
        foreach($categories as $category)
        {
            $node = $category->getRootNode();
            if ($node->tag === 'catalog') return $category->id;
        }
        return NULL;
    }
    
    public static function buildCategoriesList(&$list, $node_id)
    {
        if ($node_id === NULL || $list===NULL || !is_array($list)) return;
        
        $node = Category::model()->findByPk($node_id);
        if ($node === NULL) return;
        
        $list[] = $node_id;            
        
        if (!count($node->children)) return;
        
        foreach ($node->children as $child) self::buildCategoriesList($list, $child->id);
    }
}