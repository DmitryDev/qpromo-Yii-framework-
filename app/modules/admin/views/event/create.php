<?php
/* @var $this EventController */
/* @var $model Event */

$this->breadcrumbs=array(
	'Event'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Events', 'url'=>array('index')),
);
?>

<h1>Create Event</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>