<div id="content">    
    <div class="collection">
        <div class="slide_selector hidden-phone">
				<div class="slide_tabs">
                    <a id="scroll_left"></a>
					<ul>
                        <?php foreach($subcategories as $subcategory): ?>
                        <li style="float: left;">
                            <?php if ($category->id==$subcategory->id):?>
                                <?php echo CHtml::link($subcategory->name, 
                                        Yii::app()->createUrl('collection/view', array('id'=>$subcategory->id)),
                                        array('class'=>'active', 'data-id'=>$subcategory->id));?>
                            <?php else:?>
                                <?php echo CHtml::link($subcategory->name, 
                                        Yii::app()->createUrl('collection/view', array('id'=>$subcategory->id)),
                                                array('data-id'=>$subcategory->id)); ?>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>						
					</ul>
                    <a id="scroll_right"></a>
				</div>
				<div class="slide_panels">
                    <?php foreach($subcategories as $subcategory): ?>
                    <p class="panel"><?php //echo $subcategory->description; ?></p>
                    <?php endforeach;?>
				</div>
        </div>
        <div class="collection_mob visible-phone">
            <h1 class="title">USB</h1>
            <div class="description">
                <p>Our Leather & Wood Models are sophisticated and unique options sure to distinguish you from the pack. Leather styles are currently the only drives that can be hot-stamped, a process which creates an impression of your one-color graphic on the products surface.</p>
                <p>Wood Models include magnetically-attaching caps and come in three great styles; Maple, Walnut, and Redwood. Wood Models can be laser-engraved to achieve a rustic, burned-in effect.</p>
            </div>
        </div>

        <div class="collection_layout">
            <ul class="thumb_list">
                <?php foreach($products as $product): ?>
                <?php $this->widget('ProductThumbnail', array('model'=>$product)); ?>
                <?php endforeach;?>
            </ul>
        </div>
        
    </div><!--.collection-->
</div> <!-- #content -->