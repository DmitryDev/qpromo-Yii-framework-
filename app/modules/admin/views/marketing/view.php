<?php
/* @var $this MarketingController */
/* @var $model Marketing */

$this->breadcrumbs=array(
	'Marketing Issues'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Issues', 'url'=>array('index')),
	array('label'=>'Create Issue', 'url'=>array('create')),
	array('label'=>'Update Issue', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Issue', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>View Issue "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'issued'		
	),
)); ?>


<?php if(count($model->categories)>0):?>
<?php echo CHtml::label('Assigned Category', NULL, array('style'=>'font-weight: bold;'));?>
<?php $this->widget('MarketingCategoriesTree', array('model'=>$model))?>
<?php endif;?>

<?php if ($model->image):?>
<div style="margin-top: 15px;">    
    <div><?php echo CHtml::image(Yii::app()->params['marketingImagePath']. $model->thumbnail); ?></div>
</div>
<?php endif;?>

