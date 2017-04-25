<?php
/* @var $this PageController */
/* @var $model PageSectionItem */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
    $model->section->name=>array('view', 'id'=>$model->section_id),
    'section '.$model->section->name=>array('viewSection', 'id'=>$model->section_id),    
	'Create Section Item',
);

$this->menu=array(
	array('label'=>'View Section', 'url'=>array('viewSection', 'id'=>$model->section_id)),
);
?>

<h1>Create Page Section Item</h1>

<?php echo $this->renderPartial('_formItem', array('model'=>$model)); ?>