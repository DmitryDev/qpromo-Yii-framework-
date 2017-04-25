<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs=array(
	'Products',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage products</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<div style="float:right;">
    <?php echo CHtml::linkButton('Add product', array('href'=>'/admin/product/create')); ?>
</div>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search($pageSize),
	'filter'=>$model,
	'columns'=>array(	
        array(
            'header'=>'Catalog',
            'class'=>'CCheckBoxColumn',
            'selectableRows'=>2,
            'checked'=>'ProductController::itemChecked($data->id)'            
        ),        
		'name',                
		'model_number',
        array(
            'filter'=>  CHtml::activeDateField($model, 'release_date'),
            'name'=>'release_date',            
        ),                
        array(
            'filter'=>array('yes'=>'yes', 'no'=>'no'),
            'name'=>'is_published',            
        ),                
		array(
			'class'=>'CButtonColumn',            
		),
	),    
)); ?>

<div class="limit-selector">
    Limit:
    <a href="<?=$this->createUrl('index', array('pageSize'=>10))?>" class="limit <?php if ($pageSize==10) echo 'active'?>">10</a>
    <a href="<?=$this->createUrl('index', array('pageSize'=>25))?>" class="limit <?php if ($pageSize==25) echo 'active'?>">25</a>
    <a href="<?=$this->createUrl('index', array('pageSize'=>50))?>" class="limit <?php if ($pageSize==50) echo 'active'?>">50</a>
    <a href="<?=$this->createUrl('index', array('pageSize'=>100))?>" class="limit <?php if ($pageSize==100) echo 'active'?>">100</a>
    <a href="<?=$this->createUrl('index', array('pageSize'=>'all'))?>" class="limit <?php if ($pageSize==1000000) echo 'active'?>">All</a>
</div>

<input type="button" value="Generate Catalog" class="generate-catalog-btn"/>
<input type="button" value="Export" class="export-btn"/>
