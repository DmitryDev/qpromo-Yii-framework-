<?php
/* @var $this PageController */
/* @var $model PAge */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug'); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>74,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>
    
    <div class="row">                    
        <?php echo $form->labelEx($model,'is_published', array('class'=>'caption')); ?>
        <?php echo $form->dropDownList($model,'is_published', array('no'=>'No', 'yes'=>'Yes')); ?>
    </div>
    
    <div class="row">                    
        <?php echo $form->labelEx($model,'logged_in', array('class'=>'caption')); ?>
        <?php echo $form->dropDownList($model,'logged_in', array('no'=>'No', 'yes'=>'Yes')); ?>
    </div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php $this->widget('ext.ckeditor.CKEditorWidget',array(
                        "model"=>$model,                 # Data-Model
                        "attribute"=>'description',          # Attribute in the Data-Model
                        "defaultValue"=>$model->description,     # Optional

                        # Additional Parameter (Check http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html)
                        "config" => array(
                            "height"=>"400px",
                            "width"=>"100%",
                            "toolbar"=>"Full",
                            ),

                        #Optional address settings if you did not copy ckeditor on application root
                        "ckEditor" => Yii::app()->basePath . "/../html_public/ckeditor/ckeditor.php",
                        
                        # Path to ckeditor.php
                        "ckBasePath" => Yii::app()->baseUrl."/ckeditor/",
                        # Realtive Path to the Editor (from Web-Root)
        )); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php $this->widget('ext.ckeditor.CKEditorWidget',array(
                        "model"=>$model,                 # Data-Model
                        "attribute"=>'content',          # Attribute in the Data-Model
                        "defaultValue"=>$model->content,     # Optional

                        # Additional Parameter (Check http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html)
                        "config" => array(
                            "height"=>"400px",
                            "width"=>"100%",
                            "toolbar"=>"Full",
                            ),

                        #Optional address settings if you did not copy ckeditor on application root
                        "ckEditor" => Yii::app()->basePath . "/../html_public/ckeditor/ckeditor.php",
                        
                        # Path to ckeditor.php
                        "ckBasePath" => Yii::app()->baseUrl."/ckeditor/",
                        # Realtive Path to the Editor (from Web-Root)
        )); ?>		
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->