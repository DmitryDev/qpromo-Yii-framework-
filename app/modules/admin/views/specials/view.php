<?php
/* @var $this SpecialsController */
/* @var $model Specials */

$this->breadcrumbs=array(
	'Specials'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Specials List', 'url'=>array('index')),
	array('label'=>'Create Specials', 'url'=>array('create')),
	array('label'=>'Update Specials', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Specials', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<h1>View Specials "<?php echo $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'link',
		'image',
		'is_published',
	),
)); ?>

<?php if ($model->small):?>
<div style="margin-top: 15px;">    
    <div><?php echo CHtml::image(Yii::app()->params['specialsImagePath']. $model->small); ?></div>
</div>
<?php endif;?>
