<div id="content">
    <ul id="year-picker">
        <li><a href="#" class="active" data-year="all">All</a></li>
        <?php foreach($years as $year):?>
        <li><a href="#" data-year="<?=$year?>"><?=$year?></a></li>
        <?php endforeach; ?>
    </ul>
    <div class="marketing-category">
        <select id="mt-categories">
            <?php foreach($categoryOptions as $id=>$name): ?>
            <option value="<?=$id?>"><?=$name?></option>
            <?php endforeach;?>            
        </select>
    </div>
    <section id="pages">
        <div class="page active" data-year="all">
            <?php foreach($pages as $year=>$months):?>
                <?php foreach($months as $month=>$days):?>
                    <article class="month">
                        <h3><?=$month . ' ' . $year?></h3>
                        <?php foreach($days as $issue): ?>
                        <span class="issue" data-categories="<?=$issue->categoriesList?>">
                            <p class="title"><?=$issue->name?></p>
                            <?php if(!empty($issue->image)):?>
                            <a href="<?=$this->createUrl('site/marketing', array('issue'=>$issue->image))?>" class="download">Download Now</a>
                            <a href="<?=$this->createUrl('site/marketing', array('issue'=>$issue->image))?>">
                                <img src="<?=Yii::app()->params['marketingImagePath'] . $issue->thumbnail?>" />
                            </a>
                            <?php endif; ?>
                        </span>
                        <?php endforeach; ?>
                    </article>
                <?php endforeach;?>
            <?php endforeach;?>            
        </div>        
        
        <?php foreach($years as $year):?>
        <div class="page" data-year="<?=$year?>">
            <?php foreach($pages as $page_year=>$months):?>
                <?php if($year != $page_year) continue; ?>
                <?php foreach($months as $month=>$days):?>
                    <article class="month">
                        <h3><?=$month . ' ' . $year?></h3>
                        <?php foreach($days as $issue): ?>
                        <span class="issue" data-categories="<?=$issue->categoriesList?>">
                            <p class="title"><?=$issue->name?></p>
                            <?php if(!empty($issue->image)):?>
                            <a href="<?=$this->createUrl('site/marketing', array('issue'=>$issue->image))?>" class="download">Download Now</a>
                            <a href="<?=$this->createUrl('site/marketing', array('issue'=>$issue->image))?>">
                                <img src="<?=Yii::app()->params['marketingImagePath'] . $issue->thumbnail?>" />
                            </a>
                            <?php endif; ?>
                        </span>
                        <?php endforeach; ?>
                    </article>
                <?php endforeach;?>
            <?php endforeach;?>
        </div>
        <?php endforeach; ?>
    </section>
</div>