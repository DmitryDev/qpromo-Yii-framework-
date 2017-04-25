<div class="form" style="margin: 0 auto; width: 900px; min-width: 1280px; padding: 80px 0;">
<?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'pwd-recovery-form',
                                    'enableClientValidation'=>true,
                                    'clientOptions'=>array('validateOnSubmit'=>true)
                            )); 
?>
    <h1 style="margin: 0 0 20px;">Password Recovery</h1>
    <p>Please provide an e-mail address where to send the recovery instructions:<br/>
	<em class="note" style="margin: 0 0 20px;">(fields with <span class="required">*</span> are required)</em>
    </p>

    <div class="control-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

    <div class="control-group buttons centered">
		<?php echo CHtml::submitButton('Recover'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
