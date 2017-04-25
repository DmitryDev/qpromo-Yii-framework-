<?php
/* @var $this FaqController */
/* @var $model Faq */

$this->breadcrumbs=array(
	'FAQs'=>array('index'),
	'#' . $model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'FAQs List', 'url'=>array('index')),
	array('label'=>'Create FAQ', 'url'=>array('create')),
	array('label'=>'View FAQ', 'url'=>array('view', 'id'=>$model->id)),	
    array('label'=>'Delete FAQ', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this question?')),
);
?>

<h1>Update FAQ  #<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>