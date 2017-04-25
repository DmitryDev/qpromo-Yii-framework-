<?php

defined('TBL_CATEGORY') || define('TBL_CATEGORY', 'category');
class m120927_192934___RD__fill_categories extends CDbMigration
{
	public function up()
	{
        /*$row = Yii::app()->db->createCommand()
                ->select('id')
                ->from(TBL_CATEGORY)
                ->where('tag=:tag', array(':tag'=>'catalog'))
                ->queryRow();
        $footer = $row['id'];

        ///////////////////////////////////////////////////////////////////////
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $footer,
            'name'          => 'SHOP MOBILE',
            'tag'           => '__shop_mobile',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));          
        $parent_id = Yii::app()->db->lastInsertID;
        
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'App enabled accessories',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Cables / docks',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Cases',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Charging Devices',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Headphones',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Speakers',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        ////////////////////////////////////////////////////////////////
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $footer,
            'name'          => 'SHOP TABLET',
            'tag'           => '__shop_tablet',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));          
        $parent_id = Yii::app()->db->lastInsertID;
        
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'App enabled accessories',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Cables / docks',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Cases',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Charging Devices',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Headphones',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Keyboards',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Speakers',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        ////////////////////////////////////////////////////////////////
         $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $footer,
            'name'          => 'SHOP GAMING',
            'tag'           => '__shop_gaming',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));          
        $parent_id = Yii::app()->db->lastInsertID;
        
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Consoles',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Games',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Controllers',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Headsets',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        ///////////////////////////////////////////////////////////////////////
         $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $footer,
            'name'          => 'CUSTOMER SERVICE',
            'tag'           => '__shop_service',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));          
        $parent_id = Yii::app()->db->lastInsertID;
        
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Contact us',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Help / FAQ',
            'tag'           => '',
            'slug'          => 'page/help-faq',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        ///////////////////////////////////////////////////////////////////////
         $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $footer,
            'name'          => 'ORDER INFO',
            'tag'           => '__shop_orderinfo',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));          
        $parent_id = Yii::app()->db->lastInsertID;
        
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Order Status',
            'tag'           => '',
            'slug'          => '',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Shipping & Returns',
            'tag'           => '',
            'slug'          => 'page/shipping-returns',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Terms of Use',
            'tag'           => '',
            'slug'          => 'page/terms-of-use',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));
        $this->insert(TBL_CATEGORY, array(
            'parent_id'     => $parent_id,
            'name'          => 'Privacy Policy',
            'tag'           => '',
            'slug'          => 'page/privacy-policy',
            'is_published'  => 'yes',
            'updated_at'    => date('Y-m-d H:i:s'),
            'order'         => '1'
        ));*/
	}

	public function down()
	{
/*		Yii::app()->db->createCommand()                                
                ->delete(TBL_CATEGORY, 'tag=:tag', array(':tag'=>'__shop_mobile'));
        Yii::app()->db->createCommand()
                ->delete(TBL_CATEGORY, 'tag=:tag', array(':tag'=>'__shop_tablet'));
        Yii::app()->db->createCommand()
                ->delete(TBL_CATEGORY, 'tag=:tag', array(':tag'=>'__shop_gaming'));
        Yii::app()->db->createCommand()
                ->delete(TBL_CATEGORY, 'tag=:tag', array(':tag'=>'__shop_service'));
        Yii::app()->db->createCommand()
                ->delete(TBL_CATEGORY, 'tag=:tag', array(':tag'=>'__shop_orderinfo'));
		return true;*/
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}