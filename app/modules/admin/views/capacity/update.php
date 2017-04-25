<?php
/* @var $this CapacityController */
/* @var $model Capacity */

$this->breadcrumbs=array(
	'Capacity'=>array('index'),	
	'Update',
);

$this->menu=array(
	array('label'=>'List Capacities', 'url'=>array('index')),
	array('label'=>'Create Capacity', 'url'=>array('create')),
	array('label'=>'View Capacity', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Delete Capacity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>Update Capacity</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>