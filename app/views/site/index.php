<div id="content">
    <div class="text_intro">Makers of the coolest high-tech promotional items!</div>

    <?php $this->widget('SpecialsSlider'); ?>   
        
    <div class="section top_shadow">
        <div class="section_inner <?php if(count($events)):?>bottom_shadow<?php endif; ?>">
            <div class="subnav">
                <div class="navbar">
                    <a href="javascript:void(0)" class="visible-phone subnav_btn" data-toggle="collapse" data-target=".nav-collapse">Product Category</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav2">
                            <?php $defaultCategory = null;?>
                            <?php foreach($categories as $index=>$category): ?>
                            <?php if($category->is_published == 'no') continue;?>
                            <?php if($defaultCategory === null) $defaultCategory = $index?>
                            <li><a href="<?= $this->createUrl('index', array(
                                                            'category'=>$category->id,
                                                            'product'=>$select['product']
                                        ))?>"
                                <?php if (($select['category']==null && $index==$defaultCategory) ||
                                            ($select['category']==$category->id)): ?>
                                   class="active"
                                <?php endif; ?>
                                >
                                <?=$category->name?></a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>

                <div class="sep hidden-phone"></div>
                <ul class="nav3">
                    <li><a href="<?= $this->createUrl('index', array(
                                                    'category'=>$select['category'],
                                                    'product'=>'popular'
                                ))?>"
                            <?php if ($select['product']=='popular') echo 'class="active"' ?>
                        >Popular</a>
                    </li>
                    <li><a href="<?= $this->createUrl('index', array(
                                                    'category'=>$select['category'],
                                                    'product'=>'new'
                                ))?>"
                            <?php if ($select['product']=='new') echo 'class="active"' ?>
                        >New Products</a>
                    </li>
                </ul>
            </div>
            <div class="thumb_wrap">
                <ul class="thumb_list">
                    <?php foreach($products as $product): ?>
                    <?php $this->widget('ProductThumbnail', array('model'=>$product)); ?>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div><!-- .section -->


    <?php if(count($events)):?>
    <div id="home_events">
        <div class="title">Upcoming Events</div>
        <ul>
            <?php foreach($events as $event):?>
            <li class="event">
                <div class="event_title"><?=date("F", strtotime($event->date));?></div>
                <div class="event_date">
                    <?= date("d", strtotime($event->date));?>
                    <?php if($event->duration>1):
                    $event_day = date("d", strtotime($event->date))+$event->duration;
                    $arr_month1 = array('1','3','5','7','8','10','12'); 
                    $arr_month2 = array('4','6','9','11');
                    $month = date("m", strtotime($event->date));
                     if(in_array($month,$arr_month1) && $event_day>31) {
                    	$event_end = $event_day - 31;
                     } else {
                     	if(in_array($month,$arr_month2) && $event_day>30) {
                    		$event_end = $event_day - 30;
                     	} else {
                     		if($month == 2 && $event_day >28){
                     			$event_end = $event_day - 28;
                     		}
                     	}
                     } 
                     if($event_day <=31){
                     	$event_end = $event_day;
                     }
                    ?>
                    <?= "-" . $event_end;?>
                    <?php endif;?>
                </div>
                <div class="event_desc">
                
                    <?php if(!empty($event->link)):?>
                        <a href="<?=$event->link?>"><?=$event->name?></a>
                    <?php else: ?>
                        <?=$event->name?>
                    <?php endif;?>
                </div>
                <div class="event_place"><?=$event->place?></div>
            </li>
            <?php endforeach;?>
        </ul>
    </div><!-- #home_events -->
    <?php endif;?>

    <!--
    <div id="q_club" class="top_shadow">
    <div class="title">Q/Club</div>
    <div class="q_club_inner">
        <? //if (is_mobile()) : ?>
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <div class="q_club_item">
                            <div class="q_club_thumb">
                                <img src="img/q_club_demo.jpg" alt="" title="" />
                            </div>
                            <div class="q_club_desc">
                                Title of the blog post / promotional feature will go here and possibly here if the title is very long like in this case.
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="q_club_item">
                            <div class="q_club_thumb">
                                <img src="img/q_club_demo.jpg" alt="" title="" />
                            </div>
                            <div class="q_club_desc">
                                Title of the blog post / promotional feature will go here and possibly here if the title is very long like in this case.
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        <? //else : ?>
                    <div class="q_club_item">
                        <div class="q_club_thumb">
                            <img src="img/q_club_demo.jpg" alt="" title="" />
                        </div>
                        <div class="q_club_desc">
                            Title of the blog post / promotional feature will go here and possibly here if the title is very long like in this case.
                        </div>
                    </div>
                    <div class="q_club_item">
                        <div class="q_club_thumb">
                            <img src="img/q_club_demo.jpg" alt="" title="" />
                        </div>
                        <div class="q_club_desc">
                            Title of the blog post / promotional feature will go here and possibly here if the title is very long like in this case.
                        </div>
                    </div>
        <? //endif; ?>
    </div>
</div>
    -->
    <!-- #q_club -->

</div><!-- #content -->