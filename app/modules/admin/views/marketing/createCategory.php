<?php
/* @var $this MarketingController */
/* @var $model MtCategory */

$this->breadcrumbs=array(
    'Marketing'=>array('index'),
	'Categories'=>array('categoriesList'),
	'Create',
);

$this->menu=array(
	array('label'=>'Marketing Categories Tree View', 'url'=>array('categoriesList')),
);
?>

<h1>Create a new marketing category</h1>

<?php echo $this->renderPartial('_formCategory', array('model'=>$model)); ?>