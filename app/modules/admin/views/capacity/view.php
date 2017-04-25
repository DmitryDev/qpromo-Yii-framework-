<?php
/* @var $this CapacityController */
/* @var $model Capacity */

$this->breadcrumbs=array(
	'Capacity'=>array('index'),	
);

$this->menu=array(
	array('label'=>'List Capacities', 'url'=>array('index')),
	array('label'=>'Create Capacity', 'url'=>array('create')),
	array('label'=>'Update Capacity', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Capacity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>View Capacity</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array (
            'label'=>'Stored Value',
            'type'=>'raw',
            'value'=>$model->value
        ),
		array (
            'label'=>'Readable Value',
            'type'=>'raw',
            'value'=>Capacity::translateCapacity($model->value)
        ),
	),
)); ?>

