<div id="content">
    			<div class="search-page">

                <div class="search-wrap">
                    <h1 class="page-title">Search Result</h1>
                    <div class="search-stats">
                        Showing <span class="res_count"><?=count($products)?></span> results for <span class="keyword"><?=$keyword?></span> in <span class="curent_cat">All</span> categories
                    </div>
                    <div class="search-filter" style="display:none;">
                        <form id="search-filter" action="#">
                                <label>Filter by Category:</label>
                                <select id="cats" name="cats" tabindex="1">
                                    <?php foreach($filterList as $id=>$category):?>
                                    <option value="<?=$id?>"><?=$category?></option>
                                    <?php endforeach; ?>                                    
                                </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="collection_layout search">
                <ul class="thumb_list multilines">
                    <?php foreach($products as $product): ?>
                    <?php $this->widget('ProductThumbnail', array('model'=>$product)); ?>    
                    <?php endforeach;?>                                                            
                </ul>
            </div>
	        </div>  <!-- .search-page -->
</div><!-- #content -->