<footer id="footer">
    <div class="footer_inner">
        <div class="footer_layout">
            <?php $this->widget('FooterMenu'); ?>
            <!--ul id="left_nav">
                <li><?= CHtml::link('Help / Guidelines', array('/site/help')); ?></li>                
                <li><?= CHtml::link('Marketing Toolbox', array('/site/marketing')); ?></li>
                <li><?= CHtml::link('Product Catalogues', array('/page/catalog')); ?></li>
                <li><?= CHtml::link('Warranty', array('/site/warranty')); ?></li>
            </ul-->
            <!--ul id="right_nav">
                <li><?= CHtml::link('Contact Us', array('/site/contact')); ?></li>
                <li><?= CHtml::link('FAQ', array('/faq')); ?></li>
                <li><?= CHtml::link('Privacy Policy', array('/site/policy')); ?></li>
                <li><?= CHtml::link('Terms and Conditions', array('/site/terms')); ?></li>            
            </ul-->

			<?php $page = Page::model()->findByAttributes(array('url' => 'main'));
			      $columns = PageSection::model()->findAllByAttributes(array('page_id' => $page->id));
			?>			

            <? if ($this->_is_mobile()) : ?>
                <div id="copy">
                	<?php
            		
					echo htmlspecialchars_decode(stripslashes($columns[0]->content));
					?> 
                    <? //CHtml::image("/images/footer_copy_img.png")?>
                    <!-- p>Copying any content from this website is strictly prohibited and protected by law. Copyright &copy;2013 Qpromo</p-->
                </div>
                <div id="note">
                	<?php
            		
					echo htmlspecialchars_decode(stripslashes($columns[1]->content));
					?> 
                    <!-- p>Note: All product specifications, product availability, and the availability of rush service are subject to change with-<br/>out notice. Please confirm all important details with your sales rep before placing an order.</p-->
                </div>
            <?php else : ?>
            	<div id="copy">
            		<?php
            		
					echo htmlspecialchars_decode(stripslashes($columns[0]->content));
					?> 
            		<!-- p>Copying any content from this website is strictly prohibited and protected by law. Copyright &copy;2013 Qpromo</p-->
                    <? //CHtml::image("/images/footer_copy_img.png")?>
                </div>
                <div id="note">
                	<?php echo stripslashes($columns[1]->content); ?>
                    <!-- p>Note: All product specifications, product availability, and the availability of rush service are subject to change with-<br/>out notice.</p>
                    <p>Please confirm all important details with your sales rep before placing an order.</p-->
                </div>
            <?php endif;  ?>

            <div id="footer_logo">
                <?= CHtml::link('', array('site/index'), array('class'=>'footer_logo')); ?>
                <a href="https://plus.google.com/112513925457400892134?prsrc=3" class="footer_gp hidden-phone"></a>
                <a href="http://www.facebook.com/pages/Qpromocom/120184601389852" class="footer_fb hidden-phone"></a>
            </div>
        </div><!-- .footer_layout -->
    </div>        
</footer><!-- #footer -->

<?php $this->widget('Authorization'); ?>