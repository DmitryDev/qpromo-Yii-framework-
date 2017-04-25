<?php
/* @var $this PackagingController */
/* @var $model Packaging */

$this->breadcrumbs=array(
	'Packaging'=>array('index'),
	$model->model_number,
);

$this->menu=array(
	array('label'=>'List Packaging', 'url'=>array('index')),
	array('label'=>'Create Packaging', 'url'=>array('create')),
	array('label'=>'Update Packaging', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Packaging', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>View Packaging "<?php echo $model->model_number; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        'model_number',
		'name',
        array ('label'=>'Width','type'=>'raw','value'=>number_format($model->width, 2).'"'),
        array ('label'=>'Height','type'=>'raw','value'=>number_format($model->height, 2).'"'),
        array ('label'=>'Length','type'=>'raw','value'=>number_format($model->length, 2).'"'),
        array ('label'=>'Diameter','type'=>'raw','value'=>number_format($model->diameter, 2).'"'),
        array ('label'=>'Weight','type'=>'raw','value'=>number_format($model->weight, 4).' lbs'),        
        'customization',
		'description',		
	),
)); ?>


<?php if ($model->small):?>
<div style="margin-top: 15px;">    
    <div><?php echo CHtml::image(Yii::app()->params['packagingImagePath']. $model->small); ?></div>
</div>
<?php endif;?>
<?php if ($model->small2):?>
<div style="margin-top: 15px;">    
    <div><?php echo CHtml::image(Yii::app()->params['packagingImagePath']. $model->small2); ?></div>
</div>
<?php endif;?>
