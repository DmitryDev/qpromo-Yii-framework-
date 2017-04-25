<div id="push"></div>
</div>
<footer id="footer">
    <div class="footer_inner">
        <div class="footer_layout">
            <ul id="left_nav">
                <li><a href="#">Help / Guidelines</a></li>
                <li><a href="#">Downloads / Drivers</a></li>
                <li><a href="#">Product Catalogues</a></li>
                <li><a href="#">Warranty</a></li>
            </ul>
            <ul id="right_nav">
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms and Conditions</a></li>
            </ul>

            <? if (is_mobile()) : ?>
            <div id="copy">
                <img src="images/footer_copy_img.png" alt="" />
                <p>Copying any content from this website is strictly prohibited and protected by law. Copyright &copy;2013 Qpromo</p>
            </div>
            <div id="note">
                <p>Note: All product specifications, product availability, and the availability of rush service are subject to change with-<br/>out notice. Please confirm all important details with your sales rep before placing an order.</p>
            </div>
            <?php else : ?>
            <div id="copy">
                <p>Copying any content from this website is strictly prohibited and protected by law. Copyright &copy;2013 Qpromo</p>
                <img src="images/footer_copy_img.png" alt="" />
            </div>
            <div id="note">
                <p>Note: All product specifications, product availability, and the availability of rush service are subject to change with-<br/>out notice.</p>
                <p>Please confirm all important details with your sales rep before placing an order.</p>
            </div>
            <?php endif;  ?>
            <div id="footer_logo">
                <a class="footer_logo" href=""></a>
                <a class="footer_gp hidden-phone" href="#"></a>
                <a class="footer_fb hidden-phone" href="#"></a>
            </div>
        </div>
    </div>
</footer><!-- #footer -->

<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="modal-body">
        <div class="tab-pane">
            <ul class="nav nav-tabs">
                <li class=""><a class="login" href="#tab1">Log In</a></li>
                <li class="active"><a class="signup" href="#tab2">Sign Up</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab1">
                    <form id="login-form" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label" for="inputUsername">Username:</label>
                            <div class="controls">
                                <input type="text" id="inputUsername" placeholder="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword">Password:</label>
                            <div class="controls">
                                <input type="password" id="inputPassword" placeholder="">
                            </div>
                        </div>
                        <div class="control-group forgot_up">
                            <div class="controls">
                                Forgot <a id="forgot_user" href="javascript:void(0);" class="">username</a> or <a id="forgot_pass" href="javascript:void(0);">password</a>?
                            </div>
                        </div>
                        <div class="control-group buttons">
                            <div class="controls">
                                <button id="submit_login" type="submit" class="btn btn-primary">Sign in</button>
                                <button id="cancel_login" type="text" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane active" id="tab2">
                    <form id="signup-form" class="form-horizontal" action="" method="">
                        <div class="control-group">
                            <label class="control-label" for="name_first">Name:</label>
                            <div class="controls">
                                <input class="input-small first" type="text" id="name_first" placeholder="First">
                                <input class="input-small" type="text" id="name_last" placeholder="Last">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputEmail1">Email:</label>
                            <div class="controls">
                                <input type="text" id="inputEmail1" placeholder="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="phone">Phone Number:</label>
                            <div class="controls">
                                <input type="text" id="phone" placeholder="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="company">Company Name:</label>
                            <div class="controls">
                                <input type="text" id="company" placeholder="">
                            </div>
                        </div>
                        <div class="sep1"></div>
                        <div class="control-group">
                            <label class="control-label" for="membership">Membership #:</label>
                            <div class="controls">
                                <input type="text" id="membership" placeholder="">
                                <span class="help-block">e.g. ASI // PPAI // PPAC // SAGE#</span>
                            </div>
                        </div>
                        <div class="control-group sep2">
                            <label class="control-label"></label>
                            <div class="controls">
                                Username must be more than 5 characters and can only contain letters and digits.
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="username">Choose a Username:</label>
                            <div class="controls">
                                <input type="text" id="username" placeholder="">
                            </div>
                        </div>
                        <div class="control-group sep3">
                            <label class="control-label"></label>
                            <div class="controls">
                                Password must be atleast 5 characters long, and may include letters, numbers, and specific special characters. It is case sensitive.
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword1">Password:</label>
                            <div class="controls">
                                <input type="password" id="inputPassword1" placeholder="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword2">Confirm Password:</label>
                            <div class="controls">
                                <input type="password" id="inputPassword2" placeholder="">
                            </div>
                        </div>
                        <div class="control-group newsletter">
                            <label class="control-label">Newsletter:</label>
                            <div class="controls">
                                We'll send you occasional news and promotions, and absolutely never share your address with anyone else. Please click on the below image to subscribe/un-subscribe to Qpromo newsletter.
                                <a href="#" class="subscribe">Subscribe</a><a href="#" class="subscribe_no">No, Thank you.</a>
                            </div>
                        </div>
                        <div class="control-group buttons">
                            <div class="controls">
                                <button id="submit" type="submit" class="btn btn-primary">Sign in</button>
                                <button id="cancel" type="text" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <button id="cancel_reset_top" type="button" class="close"></button>
    <div class="modal-body">
        <form id="reset" class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="inputPasswordnew">Your Email:</label>
                <div class="controls">
                    <input type="password" id="inputPasswordnew" placeholder="">
                </div>
            </div>
            <div class="control-group buttons">
                <div class="controls">
                    <button id="submit_reset" type="submit" class="btn btn-primary">Send</button>
                    <button id="cancel_reset" type="text" class="btn">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap/js/bootstrap.js"></script>
<script src="fonts/cufon.js" type="text/javascript"></script>
<script src="fonts/dinpro-medium.font.js" type="text/javascript"></script>
<script src="js/slider/jquery.flexslider-min.js"></script>
<!--<script src="js/response.min.js"></script>-->
<!--<script src="js/yepnope.min.js"></script>-->

<!-- Faq page only -->
<script src="js/faq-page.js"></script>
<!-- End Faq page only -->

<!-- Search page only scripts -->
<script src="js/cusel/js/cusel.js"></script>
<script src="js/cusel/js/jquery.mousewheel.js"></script>
<script src="js/search-page.js"></script>
<!-- End Search page only -->

<!-- Product page only scripts -->
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/product-page.js"></script>
<!-- End Product page only -->

<!--<script type="text/javascript">
    yepnope({
        test: 920 >= screen.width, // devices 320 and up
        yep  : 'js/mobile-site.js',
        nope : 'js/site.js'
    });
</script>-->

<? if (is_mobile()) : ?>
<script src="js/mobile-site.js"></script>
<? else : ?>
<script src="js/site.js"></script>
<? endif; ?>

</body>
</html>