    <h3>Product Specs:</h3>
    <div>Model #: <?=$product->model_number?></div>
    <?php if(count($product->capacities)>0 && ($product->capacities[0]->capacity>0)):?>
    <div>Capacities: 
            <?php foreach($product->capacities as $key=>$capacity):?>
            <?= ($capacity->capacity>0)? Capacity::translateCapacity($capacity->capacity) : '';?>
            <?php if(count($product->capacities) > ($key+1)) echo ', ';?>
            <?php endforeach;?>
    </div>
    <?php endif;?>
    
    <?php if (count($product->colorsArray)): ?>
    <div>Available Colors: 
    <?php foreach($product->colorsArray as $color): ?>
        <?php if (!empty($color)): ?>
                <div class="color" style="background-color: #<?=$color?>;"></div>
        <?php endif;?>
    <?php endforeach; ?>
    </div>
    <?php endif; ?>    
    
    <?php if($product->custom_color=='yes'): ?>
        <div>Custom Colors Available: yes</div>
    <?php endif ?>
        
    <?php if($product->width>0 || $product->length>0 || $product->height>0 || $product->diameter>0):?>
    <div>Physical Size:
        <?php $size_in = ($product->size_in=='in')?'"':$product->size_in?>
        <?php if($product->width>0): ?>
        <div class="size_spec"><?=number_format($product->width,2).' '.$size_in?>(w)</div>
        <?php if($product->length>0 || $product->height>0 || $product->diameter>0) echo '&times;'?>
        <?php endif; ?>
        <?php if($product->length>0): ?>
        <div class="size_spec"><?=number_format($product->length,2).' '.$size_in?>(l)</div>
        <?php if($product->height>0 || $product->diameter>0) echo '&times;'?>
        <?php endif; ?>
        <?php if($product->height>0): ?>
        <div class="size_spec"><?=number_format($product->height,2).' '.$size_in?>(h)</div>
        <?php if($product->diameter>0) echo '&times;'?>
        <?php endif; ?>
        <?php if($product->diameter>0): ?>
        <div class="size_spec"><?=number_format($product->diameter,2).' '.$size_in?>(d)</div>        
        <?php endif; ?>
    </div>
    <?php endif;?>
        
    <?php if($product->weight>0): ?>
        <div>Weight: <?=number_format($product->weight,3).' '.$product->weight_in?></div>
    <?php endif; ?>    