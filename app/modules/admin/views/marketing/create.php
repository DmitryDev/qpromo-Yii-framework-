<?php
/* @var $this MarketingController */
/* @var $model MarketingTool */

$this->breadcrumbs=array(
	'Marketing Issues'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Issues', 'url'=>array('index')),
);
?>

<h1>Create Issue</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>