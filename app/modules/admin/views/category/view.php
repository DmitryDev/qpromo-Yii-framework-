<?php
/* @var $this CategoryController */
/* @var $model Category */

$this->breadcrumbs=array(
	'Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Categories Tree View', 'url'=>array('index')),
	array('label'=>'Create Category', 'url'=>array('create', 'root_id'=>$model->id)),
	array('label'=>'Update Category', 'url'=>array('update', 'id'=>$model->id, 'root_id'=>$model->getRootNode()->id)),
	array('label'=>'Delete Category', 'url'=>'#', 'linkOptions'=>array(
            'submit'=>array('delete','id'=>$model->id),
            'confirm'=>'Are you sure you want to delete category "' .$model->name . '" (all the nested categories will be also deleted)?'
        )),	
);
?>

<h1>View category "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(				
		'name',
		//'tag',
		'url',
        'description',
		'is_published',
		'updated_at',
		//'order',
	),
)); ?>


<?= CHtml::label('Parent Category', NULL, array('style'=>'font-weight: bold;'));?>
<?php $this->widget('CategoriesTree', array('model'=>$model))?>