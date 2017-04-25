<div class="tab-pane" id="tab2">
<?php $form=$this->beginWidget('CActiveForm', array(
                                'id'=>'signup-form',                                
                                'enableClientValidation'=>false,
                                'enableAjaxValidation'=>true,
                                'action'=>Yii::app()->createUrl('site/signup'),
                                'focus'=>array($model,'first_name'),
                                'clientOptions'=>array('validateOnSubmit'=>true),
                                'htmlOptions'=>array('class'=>'form-horizontal')
                            ));
?>    
        <div class="control-group">            
            <label class="control-label" for="SignupForm_first_name">Name *</label>
            <div class="controls">
                <?=$form->textField($model,'first_name', array('placeholder'=>'First', 'class'=>'input-small first')); ?>
                <?=$form->textField($model,'last_name', array('placeholder'=>'Last', 'class'=>'input-small')); ?>
                <?=$form->error($model,'first_name'); ?>
                <?=$form->error($model,'last_name'); ?>
            </div>
        </div>
        <div class="control-group">
            <?=$form->labelEx($model,'email', array('class'=>'control-label')); ?>
            <div class="controls">
                <?=$form->textField($model,'email', array('placeholder'=>'')); ?>
                <?=$form->error($model,'email'); ?>                
            </div>
        </div>
        <div class="control-group">
            <?=$form->labelEx($model,'phone', array('class'=>'control-label')); ?>
            <div class="controls">
                <?=$form->textField($model,'phone', array('placeholder'=>'')); ?>
                <?=$form->error($model,'phone'); ?>
            </div>
        </div>
        <div class="control-group">
            <?=$form->labelEx($model,'company', array('class'=>'control-label')); ?>            
            <div class="controls">
                <?=$form->textField($model,'company', array('placeholder'=>'')); ?>
                <?=$form->error($model,'company'); ?>
            </div>
        </div>
        <div class="control-group">
        </div>
        <div class="control-group">
            <label class="control-label" for="industry_asi">Membership #</label>
            <div class="controls">
                <?=$form->textField($model,'industry_asi', array('placeholder'=>'ASI', 'class'=>'input-tiny')); ?>                
                <?=$form->textField($model,'industry_ppai', array('placeholder'=>'PPAI', 'class'=>'input-tiny')); ?>                
                <?=$form->textField($model,'industry_sage', array('placeholder'=>'SAGE', 'class'=>'input-tiny')); ?>                
                <?=$form->textField($model,'industry_upic', array('placeholder'=>'UPIC', 'class'=>'input-tiny')); ?>
                <?=$form->error($model,'industry_sage'); ?>
                <?=$form->error($model,'industry_ppai'); ?>
                <?=$form->error($model,'industry_asi'); ?>
                <?=$form->error($model,'industry_upic'); ?>                                
                <!--span class="help-block">e.g. ASI // PPAI // PPAC // SAGE#</span-->
            </div>            
        </div>
        <div class="control-group">
            <label class="control-label" for="username"></label>
            <div class="controls">
                <span class="help-block">Username must be more than 5 characters and can only contain letters and digits.</span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="SignupForm_username">Choose a Username *</label>
            <div class="controls">
                <?=$form->textField($model,'username'); ?>
                <?=$form->error($model,'username'); ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label"></label>
            <div class="controls">
                <span class="help-block">Password must be atleast 5 characters long, and may include letters, numbers, and specific special characters. It is case sensitive.</span>
            </div>
        </div>
        <div class="control-group">
            <?=$form->labelEx($model,'password', array('class'=>'control-label')); ?>            
            <div class="controls">
                <?=$form->passwordField($model,'password_repeat'); ?>
            </div>
        </div>
        <div class="control-group">
            <?=$form->labelEx($model,'password_repeat', array('class'=>'control-label')); ?>
            <div class="controls">
                <?=$form->passwordField($model,'password',  array('placeholder'=>'Password')); ?>
                <?= $form->error($model,'password'); ?>
            </div>
        </div>
        <div class="control-group newsletter">
            <label class="control-label">Newsletter:</label>
            <div class="controls">
                We'll send you occasional news and promotions, and absolutely never share your address with anyone else. Please click on the below image to subscribe/un-subscribe to Qpromo newsletter.

                <input type="hidden" name="SignupForm[subscribe]" value="no" />
                <?php echo CHtml::link('Subscribe', 'javascript:void(0)', array('class'=>'subscribe'))?>
                <?php echo CHtml::link('No, Thank you.', 'javascript:void(0)', array('class'=>'subscribe_no'))?>
            </div>
        </div>
        <div class="control-group buttons">
            <div class="controls">
                <button id="submit" type="submit" class="btn btn-primary">Sign in</button>
                <button id="cancel" type="text" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            </div>
        </div>
<?php $this->endWidget(); ?>
</div>