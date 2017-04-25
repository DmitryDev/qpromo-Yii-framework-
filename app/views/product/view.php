<div id="content">
<div class="product-page">
<?php if(Yii::app()->user->hasFlash('backToCategory')): ?>
<?php $category = Yii::app()->user->getFlash('backToCategory');?>
<div class="text_intro"><a href="<?= $this->createUrl("/collection/view", array('id'=>$category->id))?>">Back to <?=$category->name;?></a></div>
<?php endif; ?>

<div class="product-wrap">
<?php if(Yii::app()->user->hasFlash('quoteSent')):?>
    <span class="<?=Yii::app()->user->getFlash('quoteSentResult')?>"><?=Yii::app()->user->getFlash('quoteSent')?></span>
<?php endif;?>
<?php if($this->_is_mobile())
            $this->renderPartial('_mobile', array('model'=>$model,'scaleWidth'=>$scaleWidth));
      else  $this->renderPartial('_desktop', array('model'=>$model,'scaleWidth'=>$scaleWidth));
?>

</div>
</div>  <!-- .product-page -->
</div><!-- #content -->

<?php $this->renderPartial('_quote', array('product'=>$model, 'quote'=>$quote));?>
