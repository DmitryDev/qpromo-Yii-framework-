<ul>
    <!--li class="mobile_social"><a href="#" class="mobile_gp"></a><a href="#" class="mobile_fb"></a></li-->
    <?php foreach ($root->children as $category): ?>
    <?= $this->categoriesList($category); ?>
    <?php endforeach;?>    
</ul>