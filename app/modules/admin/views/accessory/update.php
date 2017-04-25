<?php
/* @var $this AccessoryController */
/* @var $model Accessory */

$this->breadcrumbs=array(
	'Accessory'=>array('index'),
	$model->name=>array('view','name'=>$model->name),
	'Update',
);

$this->menu=array(
	array('label'=>'List Accessories', 'url'=>array('index')),
	array('label'=>'Create Accessory', 'url'=>array('create')),
	array('label'=>'View Accessory', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Delete Accessory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>Update Accessory <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>