<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs=array(
	'Static Pages'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Pages List', 'url'=>array('index')),
	array('label'=>'Create Page', 'url'=>array('create')),
	array('label'=>'Update Page', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Page', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this page?')),	
    
    array('label'=>'Create Section', 'url'=>array('createSection', 'page'=>$model->id)),
);
?>

<h1>View Page "<?= $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'slug',
        'url',
        'is_published',
        'logged_in'
	),
)); ?>

<div class="spacer"></div>
<h4>Description:</h4>
<div class=""><?=$model->description;?></div>

<?php if(count($model->sections)) :?>
<div class="spacer"></div>
<h4>Sections:</h4>
<?php foreach($model->sections as $section):?>
<div class="view">    
    <?php echo CHtml::link(CHtml::encode($section->name), array('viewSection', 'id'=>$section->id)); ?>		
</div>
<?php endforeach;?>

<?php elseif (!empty($model->content)):?>
<div class="spacer"></div>
<h4>Page preview:</h4>

<div class="view">            
        <?php echo $model->content;?>
</div><!-- page_preview -->
<?php endif; ?>