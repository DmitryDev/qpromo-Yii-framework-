<?php
/* @var $this AccessoryController */
/* @var $model Accessory */

$this->breadcrumbs=array(
	'Accessory'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Accessories', 'url'=>array('index')),
	array('label'=>'Create Accessory', 'url'=>array('create')),
	array('label'=>'Update Accessory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Accessory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>View Accessory "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'description'		
	),
)); ?>


<?php if ($model->image):?>
<div style="margin-top: 15px;">    
    <div><?php echo CHtml::image(Yii::app()->params['accessoriesImagePath']. $model->small); ?></div>
</div>
<?php endif;?>
