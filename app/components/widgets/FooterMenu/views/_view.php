<ul id="left_nav">
    <?php foreach($leftItems as $item): ?>    
    <li>
        <?php if (!empty($item->url)): ?>
        <?= CHtml::link($item->name, array($item->url)); ?>
        <?php elseif(!empty($item->slug)):?>
        <?= CHtml::link($item->name, array('page/'.$item->slug)); ?>
        <?php else:?>
        <?= CHtml::link($item->name, array('page/'.$item->id)); ?>
        <?php endif; ?>        
    </li>                
    <?php endforeach; ?>
    
</ul>
<ul id="right_nav">
    <?php foreach($rightItems as $item): ?>
    <li>
        <?php if (!empty($item->url)): ?>
        <?= CHtml::link($item->name, array($item->url)); ?>
        <?php elseif(!empty($item->slug)):?>
        <?= CHtml::link($item->name, array('page/'.$item->slug)); ?>
        <?php else:?>
        <?= CHtml::link($item->name, array('page/'.$item->id)); ?>
        <?php endif; ?>        
    </li>
    <?php endforeach; ?>
    <li>
    <a href="http://qpromo.us2.list-manage1.com/subscribe?u=6c4c1ef7b9b53f9e31dd2f44f&id=5322b41f82">Newsletter</a>
    </li>
</ul>