<?php
/* @var $this AccessoryController */
/* @var $model Accessory */

$this->breadcrumbs=array(
	'Accessory'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Accessories', 'url'=>array('index')),
);
?>

<h1>Create Accessory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>