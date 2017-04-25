<?php
/* @var $this PageController */
/* @var $model PageSection */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
    $model->page->name=>array('view', 'id'=>$model->page->id),    
    'section "'. $model->name.'"'=>array('viewSection','id'=>$model->id),    
	'Update',
);

$this->menu=array(
	array('label'=>'View Page', 'url'=>array('view', 'id'=>$page->id)),
	array('label'=>'Create Section', 'url'=>array('createSection', 'page'=>$page->id)),
	array('label'=>'View Section', 'url'=>array('viewSection', 'id'=>$model->id)),	
    array('label'=>'Delete Section', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteSection','id'=>$model->id),'confirm'=>'Are you sure you want to delete this page section?')),
);
?>

<h1>Update Page Section "<?php echo $model->name; ?>"</h1>

<?php echo $this->renderPartial('_formSection', array('model'=>$model, 'page'=>$page)); ?>