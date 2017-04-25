<?php
/* @var $this PageController */
/* @var $model PageSection */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
    $page->name=>array('view', 'id'=>$page->id),    
	'Create Section',
);

$this->menu=array(
	array('label'=>'View Page', 'url'=>array('view', 'id'=>$page->id)),
);
?>

<h1>Create Page Section</h1>

<?php echo $this->renderPartial('_formSection', array('model'=>$model, 'page'=>$page)); ?>