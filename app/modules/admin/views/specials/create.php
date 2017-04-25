<?php
/* @var $this SpecialsController */
/* @var $model Specials */

$this->breadcrumbs=array(
	'Specials'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Specials List', 'url'=>array('index')),
);
?>

<h1>Create Specials</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>