<?php
/* @var $this MarketingController */
/* @var $model MtCategory */

$this->breadcrumbs=array(
    'Marketing'=>array('index'),	
	'Categories'=>array('categoriesList'),
	$model->name=>array('viewCategory','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Categories Tree View', 'url'=>array('categoriesList')),	
    array('label'=>'Create Category', 'url'=>array('createCategory', 'root_id'=>$model->id)),
	array('label'=>'View Category', 'url'=>array('viewCategory', 'id'=>$model->id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array(
            'submit'=>array('deleteCategory','id'=>$model->id),
            'confirm'=>'Are you sure you want to delete category "' .$model->name . '" (all the nested categories will be also deleted)?'
        )),
);
?>

<h1>Update marketing category "<?php echo $model->name; ?>"</h1>

<?php echo $this->renderPartial('_formCategory', array('model'=>$model)); ?>