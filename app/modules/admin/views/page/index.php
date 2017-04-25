<?php
/* @var $this PageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Static Pages',
);

$this->menu=array(
	array('label'=>'Create Page', 'url'=>array('create')),	
);
?>

<h1>Static Pages</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

