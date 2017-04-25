<div class="modal" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="modal-body">       
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'quote-form',
                'enableAjaxValidation'=>true,            
                //'enableClientValidation'=>false,                                
                //'action'=>Yii::app()->createUrl('/product/view', array('id'=>$product->id)),
                'focus'=>array($user,'first_name'),
                //'clientOptions'=>array('validateOnSubmit'=>true),            
                'htmlOptions'=>array('class'=>'form-horizontal')
        )); ?>        
            <h2 class="dinpro">Instant Quote</h2>
            <div class="control-group">                             
                
                <label class="control-label" for="first_name">Name:</label>                
                <div class="controls">
                    <?php echo $form->textField($quote,'first_name',array(
                                'class'=>'input-small first',
                                'placeholder'=>'First',
                                'id'=>'name_first1')); ?>
                    <?php echo $form->textField($quote,'last_name',array(
                                'class'=>'input-small', 
                                'placeholder'=>'Last',
                                'id'=>'name_last1')); ?>   
                    <?=$form->error($quote,'first_name'); ?>
                    <?=$form->error($quote,'last_name'); ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="company1">Company:</label>
                <div class="controls">
                    <?php echo $form->textField($quote,'company',array('id'=>'company1')); ?> 
                    <?=$form->error($quote,'company'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="email1">Email:</label>
                <div class="controls">
                    <?php echo $form->textField($quote,'email',array('id'=>'email1')); ?> 
                    <?=$form->error($quote,'email'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="phone1">Phone Number:</label>
                <div class="controls">
                    <?php echo $form->textField($quote,'phone',array('id'=>'phone1')); ?> 
                    <?=$form->error($quote,'phone'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="model">Product Model:</label>
                <div class="controls">
                    <?php echo $form->textField($product,'model_number',array('id'=>'model')); ?>                    
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="rush">Rush Production:</label>
                <div class="controls">
                    <select id="rush" name="rush" tabindex="1">
                        <option value="0">Please select desired rush production option.</option>
                        <option value="1">3 Business Day Rush Service</option>
                        <option value="2">7 Business Day Rush Service</option>
                    </select>
                </div>
            </div>
            <div class="control-group newsletter">
                <label class="control-label">Logistics Fulfillment:</label>
                <div class="controls">
                    Qpromo's fulfillment solution manages the shipping process of your promotional products directly to your customers.
                    <a href="#" class="subscribe">Interested</a><a href="#" class="subscribe_no">No, Thank you.</a>
                </div>
            </div>

            <div class="control-group membership">
                <label class="control-label" for="membership">Membership #:</label>
                <div class="controls">
                    <?php
                        $industry='';
                        if (!empty($quote->industry_asi)) $industry .= 'ASI:'.$quote->industry_asi;
                        if (!empty($quote->industry_ppai)) {
                            $industry .= !empty($industry) ? ', PPAI:'.$quote->industry_ppai : 'PPAI:'.$quote->industry_ppai; 
                        }
                        if (!empty($quote->industry_sage)) {
                            $industry .= !empty($industry) ? ', SAGE:'.$quote->industry_sage : 'SAGE:'.$quote->industry_sage; 
                        }
                        if (!empty($quote->industry_upic)) {
                            $industry .= !empty($industry) ? ', UPIC:'.$quote->industry_upic : 'UPIC:'.$quote->industry_upic; 
                        }
                    ?>
                    <input type="text" id="membership" name="membership" placeholder="" value="<?=$industry?>">
                    <span class="help-block">e.g. ASI // PPAI // PPAC // SAGE#</span>
                </div>
            </div>


            <div class="control-group message">
                <label class="control-label" for="comment">Message:</label>
                <div class="controls">
                    <textarea id="comment" name="comment" placeholder="Please write us any comments."></textarea>
                </div>
            </div>

            <div class="control-group buttons">
                <div class="controls">
                    <span>A Qpromo representative will contact you in 1-2 business days.</span>
                    <button id="submit" type="submit" class="btn">Submit</button>
                </div>
            </div>
        <?php $this->endWidget(); ?>
        <!--/form-->
    </div>
</div>
