<?php
/* @var $this PreloadedController */
/* @var $model Preloaded */

$this->breadcrumbs=array(
	'Preloaded Data'=>array('index'),
	$model->name=>array('view','name'=>$model->name),
	'Update',
);

$this->menu=array(
	array('label'=>'List Preloaded Data', 'url'=>array('index')),
	array('label'=>'Create Preloaded Data', 'url'=>array('create')),
	array('label'=>'View Preloaded Data', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Delete Preloaded Data', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>Update Preloaded Data <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>