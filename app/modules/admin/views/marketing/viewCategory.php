<?php
/* @var $this MarketingController */
/* @var $model MtCategory */

$this->breadcrumbs=array(
    'Marketing'=>array('index'),	
	'Categories'=>array('categoriesList'),	
	$model->name,
);

$this->menu=array(
	array('label'=>'Categories Tree View', 'url'=>array('categoriesList')),
	array('label'=>'Create Category', 'url'=>array('createCategory', 'root_id'=>$model->id)),
	array('label'=>'Update Category', 'url'=>array('updateCategory', 'id'=>$model->id, 'root_id'=>$model->getRootNode()->id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array(
            'submit'=>array('deleteCategory','id'=>$model->id),
            'confirm'=>'Are you sure you want to delete category "' .$model->name . '" (all the nested categories will be also deleted)?'
        )),	
);
?>

<h1>View marketing category "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(				
		'name',		
	),
)); ?>


<?= CHtml::label('Parent Category', NULL, array('style'=>'font-weight: bold;'));?>
<?php $this->widget('MarketingCategoriesTree', array('model'=>$model))?>