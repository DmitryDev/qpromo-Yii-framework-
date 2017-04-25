<?php
/* @var $this PageController */
/* @var $model PageSectionItem */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
    $model->section->page->name=>array('view', 'id'=>$model->section->page_id),    
    'section "'. $model->section->name.'"'=>array('viewSection','id'=>$model->section_id),
    '"'. $model->name.'"',
	'Update',
);

$this->menu=array(
	array('label'=>'View Section', 'url'=>array('viewSection', 'id'=>$model->section_id)),
	array('label'=>'Create Item', 'url'=>array('createItem', 'section'=>$model->section_id)),
    array('label'=>'Delete Item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteItem','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>Update Page Section Item "<?php echo $model->name; ?>"</h1>

<?php echo $this->renderPartial('_formItem', array('model'=>$model)); ?>