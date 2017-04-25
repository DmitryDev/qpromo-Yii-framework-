<div class ="product-prices-widget">    
    <table class="existant-prices">
        <tr>
            <th width="158px">Quantity</th>
            <?php foreach($matrix['quantities'] as $quantity):?>
                <th class="centered"><?=$quantity?><br/>
                    <?php echo CHtml::checkBox("QuantityDelete[$quantity]"); ?>
                    <?php echo CHtml::label('Delete', "QuantityDelete[$quantity]"); ?>
                </th>
            <?php endforeach;?>
        </tr>
        <?php foreach($matrix['capacities'] as $capacity=>$prices): ?>
        <tr>
            <th><?php if ($capacity>0): ?>
                <?= Capacity::translateCapacity($capacity);?>
                <?php else: ?> 
                <?= count($matrix['capacities'])>1 ? 'No Capacity' :'Prices';?>
                <?php endif;?><br/>
                <?php echo CHtml::checkBox("CapacityDelete[$capacity]"); ?>
                <?php echo CHtml::label('Delete', "CapacityDelete[$capacity]"); ?>
            </th>
            <?php foreach($matrix['quantities'] as $quantity):?>
                <td class="centered">
                    <input type="text" value="<?= isset($prices[$quantity])? $prices[$quantity]: 0 ?>" 
                           size="4" name="Price[<?=$capacity?>][<?=$quantity?>]" />
                </td>
            <?php endforeach;?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>