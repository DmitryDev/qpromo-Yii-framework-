<?php
/* @var $this FaqController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'FAQs',
);

$this->menu=array(
	array('label'=>'Create FAQ', 'url'=>array('create')),	
);
?>

<h1>Frequently Asked Questions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
