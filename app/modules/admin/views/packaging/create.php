<?php
/* @var $this PackagingController */
/* @var $model Packaging */

$this->breadcrumbs=array(
	'Packaging'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Packaging', 'url'=>array('index')),
);
?>

<h1>Create Packaging</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>