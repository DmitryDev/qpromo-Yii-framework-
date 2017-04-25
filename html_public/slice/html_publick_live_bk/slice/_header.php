<?php function is_mobile() {
    if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipaq|mobi|ipod|j2me|java|midp|mini|mmp|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
    return 1;
    else
    return 0; //change this back to 0 after testing
} ?>
<!DOCTYPE html>
<html>
<head>
    <title>Qpromo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <link rel="stylesheet" type="text/css" href="fonts/stylesheet.css" />
    <!-- home page -->
    <link href="js/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="js/fancybox/jquery.fancybox.css" rel="stylesheet" media="screen">
    <!-- end home page -->
    <link href="js/slider/flexslider.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" type="text/css" href="css/authorization.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />

    <? if (is_mobile()) : ?>
    <link href="js/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link href="css/mobile.css" rel="stylesheet" media="screen">
    <? endif; ?>
    <!--[if lt IE 9]>
    <script src="/js/html5.js" type="text/javascript"></script>
    <![endif]-->

    <!-- Search page, and Product page only -->
    <link href="js/cusel/css/cusel.css" rel="stylesheet" media="screen">
    <!-- End Search page, Product page only -->
</head>
<body>
<header id="header">
    <div class="header_inner">
        <div class="layout">
            <div class="social_top hidden-phone">
                <a href="#" class="gp"></a>
                <a href="#" class="fb"></a>
            </div>
            <div class="header_center">
                    <a href="javascript:void(0);" class="visible-phone" id="nav_mobile"></a>
                    <div id="nav">
                        <ul>
                            <li class="mobile_social"><a class="mobile_gp"></a><a class="mobile_fb"></a></li>
                            <li>
                                <a href="#">USB</a>
                                <ul>
                                    <li><a href="#">Multifunction</a></li>
                                    <li><a href="#">Executive Pens</a></li>
                                    <li><a href="#">Assmbled in the USA</a></li>
                                    <li class="current-item"><a href="#">Cap-less</a></li>
                                    <li><a href="#">Leather / Wood</a></li>
                                    <li><a href="#">Metals</a></li>
                                    <li><a href="#">Eco-Friendly</a></li>
                                    <li><a href="#">Custom Shapes</a></li>
                                    <li><a href="#">Webkeys</a></li>
                                    <li><a href="#">Novelties</a></li>
                                    <li><a href="#">MP3 / Portable Media</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Mobile</a></li>
                            <li><a href="#">Tablet</a></li>
                            <li><a href="#">Audio</a></li>
                            <li><a href="#">Other</a></li>
                        </ul>
                    </div>
                <a href="#" id="logo"></a>
                <div id="search" class="hidden-phone">
                    <form method="post" action="">
                        <input type="text" placeholder="Search" class="search_text">
                        <button type="submit" class="btn" id="search_button">Search</button>
                    </form>
                </div>
                <a href="#" id="search_mobile" class="visible-phone"></a>
            </div>
            <ul id="user_nav" class="hidden-phone">
                <li><a href="#">Events</a></li>
                <li><a id="loginout" href="#myModal" class="" data-toggle="modal">Log In / Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</header><!-- #header -->
<div id="main">