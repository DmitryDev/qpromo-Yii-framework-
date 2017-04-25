<div id="content">
    <div class="account-page-wrap">
        <div class="account-page-intro">
            <h1 class="page-title">My Account</h1>
        </div>
        <div class="intro">
            <div class="warranty-page-intro">
                
            </div>
            <?php if(Yii::app()->user->hasFlash('accountSaved')): ?>
            <div style ="text-align: center; color: green;"><?= Yii::app()->user->getFlash('accountSaved')?></div>
            <?php endif;?>
        </div>        
        <?php $form=$this->beginWidget('CActiveForm', array(
                                    'id'=>'account-form',
                                    'enableClientValidation'=>true,
                                    'enableAjaxValidation'=>true,
                                    'action'=>Yii::app()->createUrl('site/account'),
                                    'focus'=>array($model,'company'),
                                    'clientOptions'=>array('validateOnSubmit'=>true),
                                    'htmlOptions'=>array('class'=>'form-horizontal'),
                            )); 
        ?>
        <div class="account-page">            
            <section class="col1">
                <div class="basic">
                    <h2 class="dinpro">Basic Information</h2>

                    <div class="control-group">
                        <?=$form->labelEx($model,'company', array('class'=>'control-label dinpro')); ?>
                        <div class="controls">
                            <?=$form->textField($model,'company', array('placeholder'=>'ExamCorp LLC')); ?>
                            <?= $form->error($model,'company'); ?>
                        </div>
                        
                    </div>
                    <div class="control-group">
                        <?=$form->labelEx($model,'name', array('class'=>'control-label dinpro')); ?>
                        <div class="controls">
                            <?=$form->textField($model,'name', array('placeholder'=>'First Last')); ?>                            
                            <?= $form->error($model,'name'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <?=$form->labelEx($model,'username', array('class'=>'control-label dinpro')); ?>
                        <div class="controls">
                            <?=$form->textField($model,'username', array('placeholder'=>'ms2013')); ?>
                            <?= $form->error($model,'username'); ?>
                        </div>
                    </div>

                </div>
                <div class="pass">
                    <h2 class="dinpro">Password</h2>

                    <div class="control-group">
                        <?=$form->labelEx($model,'oldPassword', array('class'=>'control-label dinpro')); ?>                        
                        <div class="controls">                            
                            <?=$form->passwordField($model,'oldPassword'); ?>
                            <?= $form->error($model,'oldPassword'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <?=$form->labelEx($model,'password', array('class'=>'control-label dinpro')); ?>
                        <div class="controls">
                            <?=$form->passwordField($model,'password'); ?>
                            <?= $form->error($model,'password'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <?=$form->labelEx($model,'password_repeat', array('class'=>'control-label dinpro')); ?>                        
                        <div class="controls">
                            <?=$form->passwordField($model,'password_repeat'); ?>
                            <?= $form->error($model,'password_repeat'); ?>
                        </div>
                    </div>

                </div>
            </section>
            <section class="col2">
                <div class="contact">
                    <h2 class="dinpro">Contact Information</h2>
                    <div class="control-group">
                        <?=$form->labelEx($model,'email', array('class'=>'control-label dinpro')); ?>
                        <div class="controls">
                            <?=$form->textField($model,'email', array('placeholder'=>'ms2013@gmail.com')); ?>
                            <?= $form->error($model,'email'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <?=$form->labelEx($model,'phone', array('class'=>'control-label dinpro')); ?>
                        <div class="controls">
                            <?=$form->textField($model,'phone', array('placeholder'=>'phone number')); ?>
                            <?= $form->error($model,'phone'); ?>                            
                        </div>
                    </div>
                </div>
                <div class="other">
                    <h2 class="dinpro">Other Information</h2>
                    <div class="control-group">
                        <?=$form->labelEx($model,'industry_asi', array('class'=>'control-label dinpro')); ?>
                        <div class="controls">
                            <?=$form->textField($model,'industry_asi'); ?>
                            <?= $form->error($model,'industry_asi'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <?=$form->labelEx($model,'industry_ppai', array('class'=>'control-label dinpro')); ?>
                        <div class="controls">
                            <?=$form->textField($model,'industry_ppai'); ?>
                            <?= $form->error($model,'industry_ppai'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <?=$form->labelEx($model,'industry_sage', array('class'=>'control-label dinpro')); ?>
                        <div class="controls">
                            <?=$form->textField($model,'industry_sage'); ?>
                            <?= $form->error($model,'industry_sage'); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <?=$form->labelEx($model,'industry_upic', array('class'=>'control-label dinpro')); ?>
                        <div class="controls">
                            <?=$form->textField($model,'industry_upic'); ?>
                            <?= $form->error($model,'industry_upic'); ?>
                        </div>
                    </div>

                </div>
            </section>
        </div>  <!-- .account-page -->
        <div class="control_btns">
            <input type="reset" id="cancel" value="Cancel" />
            <input type="submit" id="save" value="Save" />
        </div>        
        <?php $this->endWidget(); ?>
    </div>  <!-- .account-page-wrap -->
</div> <!-- content -->