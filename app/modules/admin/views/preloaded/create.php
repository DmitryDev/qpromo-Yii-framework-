<?php
/* @var $this PreloadedController */
/* @var $model Preloaded */

$this->breadcrumbs=array(
	'Preloaded'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Preloaded Data', 'url'=>array('index')),
);
?>

<h1>Create Preloaded Data</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>