<div id="content">
    <div class="download-page-wrap">
        <div class="warranty-page-intro">
            <h1 class="page-title"><?=$page->name?></h1>
        </div>
        <div class="intro">
            <div class="download-page-intro">
                <p><?=$page->description?></p>
            </div>
        </div>
        
        <div class="privacy-page">

            <?php if(!$this->_is_mobile()): ?>
                <div id="product_nav" class="bs-docs-sidebar" data-spy="affix" data-offset-top="200" data-offset-bottom="500">
                    <ul class="nav nav-list product_nav">
                        <?php foreach($page->sections as $section):?>
                        <li><a href="#section_<?=$section->id?>"><?=$section->name?></a></li>
                        <?php endforeach; ?>                        
                    </ul>
                </div>
            <?php endif; ?>

            <?php foreach($page->sections as $section):?>
            <section id="section_<?=$section->id?>">
                <h2 class="dinpro"><?=$section->name?></h2>
                <div class="download_decs">
                    <p><?=$section->description?></p>
                </div>
                <?php if(count($section->items)):?>
                    <ul class="download_list">
                        <?php foreach($section->items as $item):?>
                        <li>
                            <div class="title dinpro"><?=$item->name?></div>
                            <?php if($size = $item->fileSize):?>                                
                                <div class="size" style="font-size: larger;">
                                    <?php if(!empty($item->spec)): ?>
                                    <span style="display: inline-block; margin-right: 20px;"><?=$item->spec?></span>
                                    <?php endif;?>
                                    Size: <span class="dinpro" style="font-size: large;"><?=$item->translateFileSize($size)?></span></div>                                
                                <a class="download_btn dinpro" href="<?=$this->createUrl('site/download', array('item'=>$item->id))?>" class="download">Download</a>
                            <?php else:?>
                                <div class="size"><span style="display: inline-block; margin-right: 20px;"><?=$item->spec?></span></div>
                            <?php endif;?>
                        </li>
                        <?php endforeach;?>
                    </ul>
                <?php else: ?>
                <?=$section->content?>
                <?php endif; ?>
            </section>
            <?php endforeach; ?>
            
        </div>  <!-- .faq-page -->
    </div>  <!-- .faq-page-wrap -->
</div><!-- #content -->