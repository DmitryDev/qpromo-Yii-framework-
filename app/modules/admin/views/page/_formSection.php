<?php
/* @var $this PageController */
/* @var $model PageSection */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-section-form',
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