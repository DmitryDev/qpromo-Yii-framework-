<?php
/* @var $this CapacityController */
/* @var $model Capacity */

$this->breadcrumbs=array(
	'Capacity'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Capacities', 'url'=>array('index')),
);
?>

<h1>Create Capacity</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>