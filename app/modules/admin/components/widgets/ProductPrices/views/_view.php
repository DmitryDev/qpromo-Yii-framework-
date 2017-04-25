<div class ="product-prices-widget">    
    <table class="existant-prices">
        <tr>
            <th width="158px">Quantity</th>
            <?php foreach($matrix['quantities'] as $quantity):?>
                <th class="centered"><?=$quantity?></th>
            <?php endforeach;?>
        </tr>
        <?php foreach($matrix['capacities'] as $capacity=>$prices): ?>
        <tr>
            <th><?php if ($capacity>0): ?>
                <?= Capacity::translateCapacity($capacity);?>
                <?php else: ?> 
                <?= count($matrix['capacities'])>1 ? 'No Capacity' :'Prices';?>
                <?php endif;?>
            </th>
            <?php foreach($matrix['quantities'] as $quantity):?>
                <td class="centered">
                    <?= isset($prices[$quantity])? $prices[$quantity]: 0 ?>                      
                </td>
            <?php endforeach;?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>