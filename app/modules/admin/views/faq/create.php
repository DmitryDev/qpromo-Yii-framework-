<?php
/* @var $this FaqController */
/* @var $model Faq */

$this->breadcrumbs=array(
	'FAQs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'FAQs List', 'url'=>array('index')),	
);
?>

<h1>Create FAQ</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>