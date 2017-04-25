<?php
/* @var $this PageController */
/* @var $model PageSection */

$this->breadcrumbs=array(
	'Static Pages'=>array('index'),
    $model->page->name=>array('view', 'id'=>$model->page->id),
    'section "'. $model->name . '"'
);

$this->menu=array(
	array('label'=>'View Page', 'url'=>array('view', 'id'=>$model->page->id)),
	array('label'=>'Create Section', 'url'=>array('createSection', 'page'=>$model->page->id)),
	array('label'=>'Update Section', 'url'=>array('updateSection', 'id'=>$model->id)),
	array('label'=>'Delete Section', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteSection','id'=>$model->id),'confirm'=>'Are you sure you want to delete this page section?')),	
    
    array('label'=>'Create Item', 'url'=>array('createItem', 'section'=>$model->id)),
);
?>

<h1>View Page Section "<?= $model->name; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'name',		
	),
)); ?>

<div class="spacer"></div>
<h4>Description:</h4>
<div class=""><?=$model->description;?></div>

<?php if (count($model->items)):?>
<div class="spacer"></div>
<h4>Items:</h4>
<?php foreach($model->items as $item):?>
<div class="view">    
    <?php echo CHtml::link(CHtml::encode($item->name), array('updateItem', 'id'=>$item->id)); ?><br />
    <?php echo $item->spec; ?><br/>
    <?php if ($size = $item->fileSize):?>
    File uploaded. Size: <?=$item->translateFileSize($size)?>
    <?php else:?>
    <strong>Item Content:</strong>
    <div style="border:1px dotted lightblue; padding: 20px;">
    <?php echo $item->content; ?>
    </div>
    <?php endif;?>
</div>
<?php endforeach;?>

<?php elseif (!empty($model->content)):?>
<div class="spacer"></div>
<h4>Page section preview:</h4>

<div class="view">            
        <?php echo $model->content;?>
</div><!-- page_preview -->
<?php endif; ?>