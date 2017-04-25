<?php if($product->imprint !== null):?>

<h3>Customization Options:</h3>
<?php if (!empty($product->imprint->areas)):?>
<div>Printing Areas: <?=$product->imprint->areas?>
</div>
<?php endif;?>

<?php if($product->imprint->width>0 || $product->imprint->height>0):?>
    <div>Area Size:
        <?php if($product->imprint->width>0): ?>
        <div class="size_spec"><?=number_format($product->imprint->width,2).'"'?></div>
        <?php if($product->imprint->height>0) echo '&times;'?>
        <?php endif; ?>
        <?php if($product->imprint->height>0): ?>
        <div class="size_spec"><?=number_format($product->imprint->height,2).'"'?></div>
        <?php endif; ?>
    </div>
<?php endif;?>

<?php if(!empty($product->imprint->printings)):?>
<div>Printing Methods:
    <?php foreach($product->imprint->printingModels as $method):?>
    <div class="method-name"><?=$method->name;?></div>
    <?php endforeach;?>
</div>
<?php endif;?>

<?php endif; ?>