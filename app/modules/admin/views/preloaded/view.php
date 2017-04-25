<?php
/* @var $this PreloadedController */
/* @var $model Preloaded */

$this->breadcrumbs=array(
	'Preloaded Data'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Preloaded Data', 'url'=>array('index')),
	array('label'=>'Create Preloaded Data', 'url'=>array('create')),
	array('label'=>'Update Preloaded Data', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Preloaded Data', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>View Preloaded Data "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'description'		
	),
)); ?>


<?php if ($model->small):?>
<div style="margin-top: 15px;">    
    <div><?php echo CHtml::image(Yii::app()->params['preloadedImagePath']. $model->small); ?></div>
</div>
<?php endif;?>
