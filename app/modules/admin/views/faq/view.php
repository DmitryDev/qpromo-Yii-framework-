<?php
/* @var $this FaqController */
/* @var $model Faq */

$this->breadcrumbs=array(
	'FAQs'=>array('index'),
	'#'.$model->id,
);

$this->menu=array(
	array('label'=>'FAQs List', 'url'=>array('index')),
	array('label'=>'Create FAQ', 'url'=>array('create')),
	array('label'=>'Update FAQ', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete FAQ', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>View FAQ #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'question',
		'answer',
		'is_published',
		//'order',
	),
)); ?>
