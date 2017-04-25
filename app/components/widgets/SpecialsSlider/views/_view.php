<div id="slider">
    <div class="slider_inner">
        <div class="flexslider">
            <ul class="slides">
                <?php foreach($specials as $special):?>
                <li><?= CHtml::link(
                            CHtml::image(Yii::app()->params['specialsImagePath'] . $special->image),
                            $special->link);
                    ?>                        
                </li>
                <?php endforeach; ?>                    
            </ul>
        </div>
    </div>
</div><!-- #slider -->