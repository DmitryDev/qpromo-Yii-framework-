<div id="content">
    <div class="faq-page-wrap">
        <div class="faq-page single-page">
            <h1 class="page-title">Frequently Asked Questions</h1>
            <div class="accordion" id="accordion2">
                <?php foreach($questions as $key=>$faq):?>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?=$key+1?>">
                            <?=$faq->question?>
                        </a>
                    </div>
                    <div id="collapse<?=$key+1?>" class="accordion-body">
                        <div class="accordion-inner">
                            <?=$faq->answer?>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>  <!-- .faq-page -->
    </div>  <!-- .faq-page-wrap -->
</div><!-- #content -->
