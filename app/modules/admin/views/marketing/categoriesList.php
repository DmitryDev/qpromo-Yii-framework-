<?php
/* @var $this MarketingController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Marketing'=>array('index'),	
	'Categories List',
);
?>

<h1>Manage marketing categories</h1>

<div style="text-align: right;">
    <?php echo CHtml::link('Create category', array('createCategory') ); ?>
</div>

<?php $this->widget('MarketingCategoriesTree')?>



