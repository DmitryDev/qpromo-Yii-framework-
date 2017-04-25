<?php
/* @var $this PackagingController */
/* @var $model Packaging */

$this->breadcrumbs=array(
	'Packaging'=>array('index'),
	$model->name=>array('view','name'=>$model->model_number),
	'Update',
);

$this->menu=array(
	array('label'=>'List Packaging', 'url'=>array('index')),
	array('label'=>'Create Packaging', 'url'=>array('create')),
	array('label'=>'View Packaging', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Delete Packaging', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>Update Packaging <?php echo $model->model_number; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>