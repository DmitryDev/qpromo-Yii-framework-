<?php
/* @var $this MarketingController */
/* @var $model MarketingTool */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'marketing-form',
	'enableAjaxValidation'=>true,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>    

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'issued'); ?>
		<?php echo $form->dateField($model,'issued'); ?>        
        <?php echo $form->error($model,'issued'); ?>
	</div>	
        
	<?php if ($model->image):?>
    <div class="row" style="margin-top: 15px;">        
        <?php echo CHtml::checkBox('MarketingTool[deleteImage]'); ?><span>Delete Image</span>
        <div><?php echo CHtml::image(Yii::app()->params['marketingImagePath'].'/'.$model->thumbnail); ?></div>        
    </div>
    <?php endif;?>

    <div class="row">
        <?php echo CHtml::label('Upload a new image', '', array('style'=>'font-weight: bold;')); ?>        
        <?php echo CHtml::fileField('MarketingTool[image]', '', array('id'=>'image'));?>               
        <?php echo $form->error($model,'imageUploader'); ?>
    </div>
    
    <div class="row form-section">
        <strong><?php echo $form->labelEx($model,'mtcategory');?></strong><br/>
        <em>(Multiple categories can be assigned to a product. Just check on a category to assign/deassign it.)</em>                
        <?php $this->widget('MarketingCategoriesTree', array('model'=>$model, 'editable'=>true))?>
    </div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->