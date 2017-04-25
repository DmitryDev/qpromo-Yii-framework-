<div class="tab-pane active" id="tab1">
<?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'login-form',                                
                                'enableClientValidation'=>false,
                                'enableAjaxValidation'=>true,
                                'action'=>Yii::app()->createUrl('site/login'),
                                'focus'=>array($model,'username'),
                                'clientOptions'=>array('validateOnSubmit'=>true),
                                'htmlOptions'=>array('class'=>'form-horizontal')
                            ));
?>
    <div class="control-group">
        <?=$form->labelEx($model,'username', array('class'=>'control-label')); ?>        
        <div class="controls">
            <?=$form->textField($model,'username', array('placeholder'=>'User Name')); ?>
            <?=$form->error($model,'username'); ?>
        </div>
    </div>	
    
    <div class="control-group">
        <?= $form->labelEx($model,'password', array('class'=>'control-label')); ?>        
        <div class="controls">            
            <?= $form->passwordField($model,'password', array('placeholder'=>'Password')); ?>
            <?= $form->error($model,'password'); ?>
        </div>
    </div>	
    <div class="control-group forgot_up">
        <div class="controls">
            Forgot <a id="forgot_user" href="javascript:void(0);" class="">username</a> or <a id="forgot_pass" href="javascript:void(0);">password</a>?
        </div>
    </div>
    <div class="control-group buttons">
        <div class="controls">
            <button id="submit_login" type="submit" class="btn btn-primary">Sign in</button>
            <button id="cancel_login" type="text" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
        </div>
    </div>    
<?php $this->endWidget(); ?>
</div>