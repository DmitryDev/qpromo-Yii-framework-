<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Categories Tree View', 'url'=>array('index')),
);
?>

<h1>Create a new category</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>