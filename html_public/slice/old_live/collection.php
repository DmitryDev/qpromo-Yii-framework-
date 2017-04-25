<? require_once '_header.php' ?>

        <div id="content">

			<div class="collection">

			<div class="slide_selector">
				<div class="slide_tabs">
					<ul>
						<li><a href="#" class="active">Multifunction</a></li>
						<li><a href="#">Executive Pens</a></li>
						<li><a href="#">Assembled in the USA</a></li>
						<li><a href="#">Cap-less</a></li>
						<li><a href="#">Leather / Wood</a></li>
						<li><a href="#">Metals</a></li>
						<li><a href="#">Eco-friendly</a></li>
						<li><a href="#">Custom Shapes</a></li>
						<li><a href="#">Webkeys</a></li>
						<li><a href="#">Novelties</a></li>
						<li><a href="#">MP3 / Ponevidnonihrena</a></li>
					</ul>
				</div>
				<div class="slide_panels">
					<p class="panel">	description 1 </p>
					<p class="panel">	description 2 </p>
					<p class="panel">	description 3 </p>
					<p class="panel">	description 4 </p>
					<p class="panel">	Our Leather & Wood Models are sophisticated and unique options sure to distinguish you from the pack. 
		Leather styles are currently the only drives that can be hot-stamped, a process which creates an impression of 
		your one-color graphic on the products surface.
		Wood Models include magnetically-attaching caps and come in three great styles; Maple, Walnut, and 
		Redwood. Wood Models can be laser-engraved to achieve a rustic, burned-in efect.
		</p>
					<p class="panel">	description 6 </p>
					<p class="panel">	description 7 </p>
					<p class="panel">	description 8 </p>
					<p class="panel">	description 9 </p>
					<p class="panel">	description 10 </p>
					<p class="panel">	description 11 </p>
				</div>
			</div>

<!--             <div class="subnav">
                <ul class="nav2">
                    <li><a href="#">USB</a></li>
                    <li><a href="#">Mobile</a></li>
                    <li><a href="#">Tablet</a></li>
                    <li><a href="#">Audio</a></li>
                    <li><a href="#">Other</a></li>
                </ul>
                <div class="sep"></div>
                <ul class="nav3">
                    <li><a href="#">Popular</a></li>
                    <li><a href="#">New Releases</a></li>
                </ul>
            </div> -->


            <ul class="thumb_list">
				
				<? for ($i=0; $i < 20; $i++) { 
					?>

		                <li class="list_item">
		                    <a href="#" class="thumb"><img src="img/thumb.jpg"></a>
		                    <div class="title">Alpine Pro</div>
		                    <div class="desc">1GB - 16GB</div>
		                    <ul class="colors">
		                        <li><a href="#" class="color black"></a></li>
		                        <li><a href="#" class="color blue"></a></li>
		                        <li><a href="#" class="color white"></a></li>
		                        <li><a href="#" class="color gray"></a></li>
		                        <li><a href="#" class="color red"></a></li>
		                        <li><a href="#" class="color yellow"></a></li>
		                    </ul>
		                </li>

					<?
				}
				?>

            </ul>
	        </div>  <!-- .collection -->
        </div><!-- #content -->

<? require_once '_footer.php' ?>