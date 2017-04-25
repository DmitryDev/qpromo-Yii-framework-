<style type="text/css">
<!--
	div.cover_header {
	  width: 100%; border: none;
      height: 30mm;
	  background-image:url(<?=$_SERVER['DOCUMENT_ROOT']?>/images/pdf/pdf_header_new.png);
	  background-repeat: no-repeat;                  
	  /*border-bottom: solid 1px rgb(0,173,236);*/
	  padding: 2mm;
	  
    }
    div.cover_content {
        width: 100%;
        border: none;
        padding: 0mm;
        padding-left:10mm;
        padding-top:5mm; 
        padding-bottom:5mm;       
    }
    div.page_header {
	  width: 100%; border: none;
	  height:30mm;
      background-image:url(<?=$_SERVER['DOCUMENT_ROOT']?>/images/pdf/pdf_header_new.png);
	  background-repeat: no-repeat;                  
	  /*border-bottom: solid 1px rgb(0,173,236);*/
	  padding: 2mm;
	  padding-top:10mm;
	  
    }
	div.page_footer {
        width: 100%;
        height:12mm;
        border: none;
       /* border-top: solid 1px rgb(0,173,236);*/
        padding-right: 5mm;
        background-image:url(<?=$_SERVER['DOCUMENT_ROOT']?>/images/pdf/pdf_footer_new.png);
	  	background-repeat: no-repeat;
	  	text-align: center;
	  	
    }
    
    div.description {
        text-align: justify;
        padding-top:22mm;
    }
    div.images {
    	margin-top:10mm;
    }
    div.images img {
        margin-right: 30mm;
        margin-bottom: 10mm;
        /*margin-top: 10mm;*/
        margin-left:30mm;
    }
    div.color {
        border: 1px solid black;
        border-radius: 2mm;
        height: 4mm;
        width: 4mm;        
        display: inline;
        margin-left: 1mm;
    }
    div.size_spec {
        display: inline;
        margin-left: 1mm;        
        width: auto;
    }
    
    table.specification {
        width: 100%;
        padding-top:18mm;        
    }
    
    table.specification td {
        width: 50%;
        vertical-align: text-top;
    }
    div.method-name {
        display: inline;
        margin-left: 5mm;
    }    
	
	h1 {color: #000033}
	h2 {color: #000055}
	h3 {color: #000033; margin-bottom: 2mm;}
		
-->
</style>

<page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm" style="font-size: 12pt;text-aligh:center;">
    <bookmark title="QPromo Products Catalog" level="0" ></bookmark>
	<page_header>
        <div class="cover_header" style="font-size:21pt;font-weight:bold;color:#3B78BD;padding-top:8mm;padding-left:5mm;">Products & Services</div>
        <div class="cover_content">
            <img src="<?=$_SERVER['DOCUMENT_ROOT']. '/images/pdf/pdf-catalog-title.png'?>" />
        </div>        
	</page_header>
	 <page_footer>
    	
    	<div class="page_footer">
    	<span style="font-size:14pt;color:#ffffff;margin-top:5mm;margin-left:10mm;">
    	Page [[page_cu]] of [[page_nb]]
    	</span>
    	<!-- table class="page_footer">
			<tr>
				<td style="width: 100%; text-align: right">
					page [[page_cu]]/[[page_nb]]
				</td>
			</tr>
		</table-->
		</div>
	</page_footer>	
</page>


<?php foreach($products as $product):?>
<page backtop="10mm"  backleft="0mm" backright="0mm" style="font-size: 12pt;">
    <bookmark title="<?=$product->name?>" level="0" ></bookmark><h1><?=$product->name?></h1>
    <page_header>
    	<?php if(strlen($product->name) >= 28){ ?>
    	<div class="cover_header" style="font-size:19pt;font-weight:bold;color:#3B78BD;padding-top:2mm;padding-left:5mm;"><div style="width:40%;"><?=$product->name?></div><span style="font-size:16pt;color:#3B78BD;padding-left:3mm;">(<?=$product->model_number?>)</span></div>
    	<?php }
    	else {?>
		<div class="cover_header" style="font-size:19pt;font-weight:bold;color:#3B78BD;padding-top:8mm;padding-left:5mm;"><?=$product->name?><br/><span style="font-size:16pt;color:#3B78BD;padding-left:3mm;">(<?=$product->model_number?>)</span></div>    		
    	<?php }?>
                
	</page_header>
		

	<div class="images">
        <?php $counter = 0;
        $img_width = 0;
        ?>
        <?php foreach($product->images as $image): ?>
            <?php if ($image!== null): ?> 
                <?php $img = Yii::app()->image->load($_SERVER['DOCUMENT_ROOT'].Yii::app()->params['productImagesPath']. $image->large);
                $img_width += $img->width;?>               
                <img src="<?=$_SERVER['DOCUMENT_ROOT'].Yii::app()->params['productImagesPath']. $image->large?>" class="product-image" />                
                <?php if (++$counter == 2) break; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        
	</div>
	
	 
	<?php if( $img_width <700  ){ ?>
		
    	<div class="description" style="padding-top:2mm;"><?=$product->description?></div>
    <?php } else {?>
    	<div class="description"><?=$product->description?></div>
    <?php } ?>
    <?php if(strlen($product->description)>=500 ){?>
    	 <page_footer>
    	
    	<div class="page_footer">
    	<span style="font-size:14pt;color:#ffffff;margin-top:5mm;margin-left:10mm;">
    	Page [[page_cu]] of [[page_nb]]
    	</span>
    	<!-- table class="page_footer">
			<tr>
				<td style="width: 100%; text-align: right">
					page [[page_cu]]/[[page_nb]]
				</td>
			</tr>
		</table-->
		</div>
	</page_footer>
    <?php }?>
    <table class="specification">
        <tr>
            <td><?php $this->renderPartial('_specification', array('product'=>$product));?></td>
            <td><?php $this->renderPartial('_imprint', array('product'=>$product));?></td>
        </tr>
    </table>
        
    <page_footer>
    	
    	<div class="page_footer">
    	<span style="font-size:14pt;color:#ffffff;margin-top:5mm;margin-left:10mm;">
    	Page [[page_cu]] of [[page_nb]]
    	</span>
    	<!-- table class="page_footer">
			<tr>
				<td style="width: 100%; text-align: right">
					page [[page_cu]]/[[page_nb]]
				</td>
			</tr>
		</table-->
		</div>
	</page_footer>
</page>
<?php endforeach; ?>