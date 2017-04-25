<section id="images" class="bottom_shadow">
    <div id="slider">
        <div class="slider_inner">
            <div class="flexslider">
                <ul class="slides">
                    <?php foreach($model->product_images as $image):?>
                    <li>
                        <img src="<?=Yii::app()->params['productImagesPath'] . $image->full?>" />
                    </li>
                    <?php endforeach;?>                    
                </ul>
            </div>
        </div>
    </div><!-- #slider -->
    <div class="prod_tit_btns">
        <span><?=$model->model_number?></span>
        <h1 class="product-title"><?=$model->name?></h1>
        <div class="prod_btns_wrap">
            <a class="prod_btn" href="#myModal3" id="i_quote"  data-toggle="modal">Instant Quote</a>
            <a class="prod_btn" href="#" id="buy_sample">Buy Sample - $3</a>
            <a class="prod_btn" href="javascript:void(0);" id="print">print</a>
            <a class="prod_btn" href="javascript:void(0);" id="email">email</a>
        </div>
    </div>
</section>

<div class="accordion" id="accordion2">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse1">
                Specifications
            </a>
        </div>
        <div id="collapse1" class="accordion-body">
            <div class="accordion-inner">
                <!-- specifications
                ================================================== -->
                <section id="specifications">
                    <div class="prod_layout">
                        <p class="text-center"><?=$model->description?></p>
                        <?php if(count($model->capacities)>0 && $model->capacities[0]->capacity>0):?>
                        <p class="text-center">Capacities:
                            <?php foreach($model->capacities as $key=>$capacity):?>
                                <?= ($capacity->capacity>0)? Capacity::translateCapacity($capacity->capacity) : '';?>
                                <?php if(count($model->capacities) > ($key+1)) echo ', ';?>
                                <?php endforeach;?>
                        </p>
                        <?php endif;?>
                        <div class="prod_spec">
                            <?php $size_in = ($model->size_in=='in')?'"':$model->size_in?>
                            <?php if($model->width>0): ?>
                            <div class="prod_height <?php if ($model->height>0 || $model->length>0 || $model->diameter>0) echo 'spec_sep'?>">
                                <span>Width</span>
                                <div class="dinpro"><?=number_format($model->width,2).' '.$size_in?></div>
                            </div>
                            <?php endif; ?>                            
                            <?php if($model->height>0): ?>
                            <div class="prod_height <?php if ($model->length>0 || $model->diameter>0) echo 'spec_sep'?>">
                                <span>Height</span>
                                <div class="dinpro"><?=number_format($model->height, 2).' '.$size_in?></div>
                            </div>
                            <?php endif; ?>
                            <?php if($model->length>0): ?>
                            <div class="prod_height <?php if ($model->diameter>0) echo 'spec_sep'?>">
                                <span>Length</span>
                                <div class="dinpro"><?=number_format($model->length,2).' '.$size_in?></div>
                            </div>
                            <?php endif; ?>
                            <?php if($model->diameter>0): ?>
                            <div class="prod_diameter">
                                <span>Diameter</span>
                                <div class="dinpro"><?=number_format($model->diameter, 2).' '.$size_in?></div>
                            </div>
                            <?php endif; ?>
                            <?php if($model->weight>0): ?>
                            <div class="prod_weight">
                                <span>Unit Weight</span>
                                <div class="dinpro"><?= number_format($model->weight, 3).' '.$model->weight_in?></div>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="product_colors">
                            <p class="text-center">
                                <?php if($model->custom_color=='yes'): ?>
                                Custom Colors Also Available
                                <?php endif ?>
                            </p>
                            <ul class="colors">
                                <?php foreach($model->colorsArray as $color):?>
                                <li><span class="color" style="background: #<?=$color?>;"></span></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>




                </section>
            </div>
        </div>
    </div>
    
    
    <?php if ($model->imprint !== null  && !empty($model->imprint->printings)):?>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2">
                Imprint Options
            </a>
        </div>
        <div id="collapse2" class="accordion-body">
            <div class="accordion-inner">
                <!-- imprint
                ================================================== -->
                <section id="imprint" class="top_shadow">
                    <div class="bottom_shadow">
                        <div class="prod_layout">
                            <div class="imprint_area">
                                <div class="imprint_area_tit">
                                    <span>Imprint Location</span>
                                    <?php foreach($model->imprint->areasArray as $area):?>
                                    <div class="dinpro"><?=$area?></div>
                                    <?php endforeach;?>
                                </div>
                                <div class="imprint_width">
                                    <div class="dinpro"><?=$model->imprint->width?>"</div>
                                </div>
                                <div class="imprint_height">
                                    <div class="dinpro"><?=$model->imprint->height?>"</div>
                                </div>
                            </div>
                            <!--div class="color_opts">
                                <?php foreach($model->imprint->printingModels as $key=>$printingMethod): ?>
                                <?php //$col = ($key % 2)?>
                                <div class="col text-center">
                                    <h2><?=$printingMethod->name?></h2>
                                    <p><?=$printingMethod->description?></p>
                                    <a href="javascript:void(0);" class="preload_checkbox"><input type="checkbox" class="printing" data-method="<?=$printingMethod->id ?>" style="display: none;" /></a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="clearfix"></div>
                            <p class="text-center fontsize14">Vector art files are required for producing graphics. <a href="#">Click Here</a> for help getting started. View our service<br/>
                                guidelines, ordering instructions, info on submitting proper graphics for product customization, and more.</p-->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php endif; //$model->imprint !== null ?>
    
    <?php if (count($model->prices)>0):?>
    <div class="accordion-group">

        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse4">
                Pricing
            </a>
        </div>
        <div id="collapse4" class="accordion-body">
            <div class="accordion-inner">
                <!-- pricing
                ================================================== -->
                <section id="pricing" class="top_shadow">
                    <div class="bottom_shadow">
                        <div class="prod_layout price_layout">
                            <div class="price_calc">
                                <input type="text" id="quantity" class="input-small" name="quantity" value="" placeholder="Desired Qty" maxlength="6" />
                                <div id="price">
                                    <span class="currency">$</span>
                                    <span class="dinpro">0.00</span>                                    
                                    <?php if(!Yii::app()->user->isGuest):?>
                                        <span class="note">Note: Net Price</span>
                                    <?php else:?>
                                        <?php if($model->priceCode !== null): ?>
                                        <span class="note">Note: <?php echo $scaleWidth . $model->priceCode->code?></span>
                                        <?php endif; ?>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="units_price">
                                <p class="text-center fontsize14">Minimum <span class="qty-minimum"><?php
                                    if ($model->prices[0]->quantity>1) echo $model->prices[0]->quantity;
                                    else if (count($model->prices)>1)  echo $model->prices[1]->quantity;
                                    else echo $model->prices[0]->quantity;
                                ?></span> units<br/>
                                    One color, one location imprint included.</p>
                                <?php if (count($model->capacitiesListBoxArray)>0):?>                
                                <ul class="price-capacity">
                                    <?php $checked = false;?>
                                    <?php foreach($model->capacitiesListBoxArray as $key=>$capacity):?>
                                    <li>
                                        <input type="radio" name="priceCapacity" value="<?=$key?>"
                                        <?php if (!$checked) { echo 'checked="checked"'; $checked=true; } ?> /><span><?=$capacity?></span>
                                    </li>
                                    <?php endforeach;?>
                                </ul>
                                <?php endif;?>
                                <div class="q_line">

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>


    </div>
    <?php endif; //count($model->prices)>0 ?>
    
    
    
    <?php if ($model->productPreloaded !== null && !empty($model->productPreloaded->preloaded)):?>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse3">
                Preload & Data Services
            </a>
        </div>
        <div id="collapse3" class="accordion-body">
            <div class="accordion-inner">
                <!-- Preload & Data Services
                ================================================== -->                
                <section id="preload">
                    <div class="prod_layout">
                        <div class="text-center preload_text">We offer a variety innovative options to deliver your custom content, whether it is a simple PDF catalog, a web page set to autorun, or a dazzling Flash presentation that loads automatically. Our preload options can add power and lasting impact to your promotional marketing campaign. For more advanced content delivery like software distribution and other kinds of integrated data solutions, we offer <a href="#">RTS portable security software</a>, <a href="#">portable freeware applications</a>, <a href="#">custom icon creation</a>, and much more. See below for details and call or send an email to <a href="mailto:sales@qpromo.com">sales@qpromo.com</a> to discuss your project.</div>

                        <div class="well text-center">
                            <span class="dinpro">Important Note:</span> With the exception of the Standard Preload, the above options will only work reliably on a Windows-based computer (and newer than Windows 98). Talk to a sales rep for info on how to have content accesible on a Mac while still having non-standard options work on a Windows PC.
                        </div>

                        <ul class="preload_opts">
                            <?php foreach($model->productPreloaded->preloadedModels as $preloaded):?>
                            <li>
                                <span class="preload_img"><img src="<?=Yii::app()->params['preloadedImagePath'].$preloaded->image?>" /></span>
                                <h2><?=$preloaded->name?></h2>
                                <p><?=$preloaded->description?></p>
                                <a href="javascript:void(0);" class="preload_checkbox"><input type="checkbox" class="preloaded" data-preloaded="<?=$preloaded->id?>" name="preloaded[<?=$preloaded->id?>]" style="display: none;" /></a>
                            </li>
                            <?php endforeach; ?>                            
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php endif; //$model->productPreloaded !== null ?> 
        
    
    <?php if ($model->productPackaging !== null && !empty($model->productPackaging->packaging)):?>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse5">
                Product Packaging Options
            </a>
        </div>
        <div id="collapse5" class="accordion-body">
            <div class="accordion-inner">
                <!-- packaging
                ================================================== -->
                <section id="packaging">
                    <div class="prod_layout">
                        <div class="preload_text text-center">Listed below are the most popular USB Flash Drive customized packaging options that we offer to fulfill our clients' diverse presentation needs. We have options for a wide a variety of purposes, for orders big and small. If you have a packaging idea not listed below, contact a friendly sales representative and let him/her know. We will likely have the resources to make your idea a reality.</div>
                        <ul class="packaging_opts">
                            <?php foreach($model->productPackaging->packagingModels as $pack): ?>
                            <li>
                                <span class="preload_img"><img src="<?=Yii::app()->params['packagingImagePath'].$pack->image?>" /></span>
                                <h2 class="pack_title"><?=$pack->name?></h2>
                                <p><?=$pack->description?></p>
                                <p class="text-center"><h2 class="sub_title">Dimensions:</h2></p>
                                <div class="pack_dimensions">
                                    <?php if($pack->length > 0):?>
                                    <div class="pack_length spec_sep">
                                        <div class="dinpro"><?=number_format($pack->length, 2)?>"</div>
                                        <span><?=number_format($pack->length*25.4, 2)?>mm</span>
                                    </div>
                                    <?php endif;?>
                                    <?php if($pack->width > 0):?>
                                    <div class="pack_width spec_sep">
                                        <div class="dinpro"><?=number_format($pack->width, 2)?>"</div>
                                        <span><?=number_format($pack->width*25.4, 2)?>mm</span>
                                    </div>
                                    <?php endif;?>                                        
                                    <?php if($pack->height > 0):?>
                                    <div class="pack_height spec_sep">
                                        <div class="dinpro"><?=number_format($pack->height, 2)?>"</div>
                                        <span><?=number_format($pack->height*25.4, 2)?>mm</span>
                                    </div>
                                    <?php endif;?>                    
                                    <?php if($pack->diameter > 0):?>
                                    <div class="pack_diameter spec_sep">
                                        <div class="dinpro"><?=number_format($pack->diameter, 2)?>"</div>
                                        <span><?=number_format($pack->diameter*25.4, 2)?>mm</span>
                                    </div>
                                    <?php endif;?> 
                                </div>
                                <?php if(!empty($pack->customization)):?>
                                <p class="text-center"><h2 class="sub_title">Possible Customization:</h2></p>
                                <p class="text-center"><?=$pack->customization?></p>
                                <?php endif; ?>
                                <a href="javascript:void(0);" class="preload_checkbox"><input type="checkbox" class="packaging" data-packaging="<?=$pack->id?>" name="packaging[<?=$pack->id?>]" style="display: none;" /></a>
                            </li>
                            <?php endforeach;?>
                        </ul>

                    </div>
                </section>
            </div>
        </div>

    </div>
    <?php endif; //$model->productPackaging !== null ?>
    
    <?php if ($model->productAccessories !== null && !empty($model->productAccessories->accessories)):?>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse6">
                Accessory Options
            </a>
        </div>
        <div id="collapse6" class="accordion-body">
            <div class="accordion-inner">
                <!-- accessories
                ================================================== -->
                <section id="accessories" class="top_shadow">
                    <div class="prod_layout">
                        <div class="preload_text text-center">
                            <p>All of the accessories below make great add-ons with your order. When you are ready to request a quote with us, please select the accessories you'd like to add-on and we'll make sure to include this with your quote.</p>
                            <p>Please check with a sales rep to make sure that the accessory you are interested in is compatible with the Flash Drive model you choose.</p>
                        </div>
                        <ul class="accessories_opts">
                           <?php foreach($model->productAccessories->accessoryModels as $accessory): ?>
                            <li>
                                <span class="preload_img"><img src="<?=Yii::app()->params['accessoriesImagePath'].$accessory->image?>" /></span>
                                <h2><?=$accessory->name?></h2>
                                <a href="javascript:void(0);" class="preload_checkbox"><input type="checkbox" class="accessory" data-accessory="<?=$accessory->id?>" name="accessory[<?=$accessory->id?>]" style="display: none;" /></a>
                            </li>            
                            <?php endforeach;?>
                        </ul>
                    </div>
                </section>
            </div>
        </div>


    </div>
    <?php endif; //$model->productAccessories !== null ?>
</div>