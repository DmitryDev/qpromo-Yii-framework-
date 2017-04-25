<?php
/* @var $this CategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Categories',
);
?>

<h1>Manage categories</h1>

<div style="text-align: right;">
    <?php echo CHtml::link('Create category', array('create') ); ?>
</div>

<?php $this->widget('CategoriesTree')?>



