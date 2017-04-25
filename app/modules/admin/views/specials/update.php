<?php
/* @var $this SpecialsController */
/* @var $model Specials */

$this->breadcrumbs=array(
	'Specials'=>array('index'),
	$model->name=>array('view','name'=>$model->name),
	'Update',
);

$this->menu=array(
	array('label'=>'Specials List', 'url'=>array('index')),
	array('label'=>'Create Specials', 'url'=>array('create')),
	array('label'=>'View Specials', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Delete Special', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>Update Specials <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>