<header id="header">
    <div class="header_inner">
        <div class="layout">
            <div class="social_top hidden-phone">
                <a href="https://plus.google.com/112513925457400892134?prsrc=3" class="gp"></a>
                <a href="http://www.facebook.com/pages/Qpromocom/120184601389852" class="fb"></a>
            </div>
            <div class="header_center">
                <a href="javascript:void(0);" class="visible-phone" id="nav_mobile"></a>
                <div id="nav">
                    <?php if ($this->_is_mobile()) $this->widget('CategoriesMenuMobile');                    
                           else $this->widget('CategoriesMenu');
                    ?>
                </div>

                <div id="logo">
                    <?= CHtml::link(CHtml::image("/images/logo.png"), array('site/index'), array('class'=>'last')); ?>
                </div>

                <div id="search" class="hidden-phone">
                
                    <?= CHtml::beginForm($this->createUrl('site/search'),'post'); ?>                       
                        <?= CHtml::textField('keyword','', array('placeholder'=>'Search', 'class'=>'search_text')) ?>
                        <?= CHtml::submitButton('Search', array('id'=>'search_button', 'class'=>'btn')) ?>
                    <?= CHtml::endForm(); ?>             
                </div>
                <?php if ($this->_is_mobile()):
                echo CHtml::beginForm($this->createUrl('site/search'),'post',array('id' => 'mobile_form_search')); ?>
                <a href="#" id="search_mobile" class="visible-phone"></a>
                <input type="text" placeholder="Search" name="search_mobile_input" id="search_mobile_input" class="search_text">
                <?php
                echo CHtml::endForm();
                endif; ?>
            </div>
            <ul id="user_nav" class="hidden-phone">
            
                <!--li><?php //echo CHtml::link('Q/Club', array('#')); ?></li-->
                <!--li><?// CHtml::link('Events', array('#')); ?></li-->
                <li>
                <?php if (!Yii::app()->user->isGuest): ?>
                    <?= CHtml::link('My Account', array('site/account')); ?>                
                <?php endif; ?>            
                </li>
                
                <li>
                <?php if (Yii::app()->user->isGuest): ?>
                    <?= CHtml::link('Log In / Sign Up', array('site/login'), array('id'=>'login-link', 'data-toggle'=>'modal')); ?>
                <?php else: ?>
                    
                    <?= CHtml::link('Log Out', array('site/logout')); ?>
                <?php endif; ?>            
                </li>
            </ul>

            
        </div>
    </div>    
</header><!-- #header -->