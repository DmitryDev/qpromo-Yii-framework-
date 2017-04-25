<?php include_once('_header.php'); ?>

    <div id="content">
        <div class="account-page-wrap">
            <div class="account-page-intro">
                <h1 class="page-title">My Account</h1>
            </div>
            <div class="intro">
                <div class="warranty-page-intro">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ullamcorper, lectus id ultrices euismod, mi dolor vestibulum neque, eget ullamcorper nulla id lectus.</p>
                </div>
            </div>
            <form class="form-horizontal">
            <div class="account-page">
                <section class="col1">
                    <div class="basic">
                        <h2 class="dinpro">Basic Information</h2>

                        <div class="control-group">
                            <label class="control-label dinpro" for="company">Company:</label>
                            <div class="controls">
                                <input type="text" id="company" placeholder="YMEE">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label dinpro" for="name">Name:</label>
                            <div class="controls">
                                <input type="text" id="name" placeholder="Michael Scott">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label dinpro" for="username">Username:</label>
                            <div class="controls">
                                <input type="text" id="username" placeholder="ms2013">
                            </div>
                        </div>

                    </div>
                    <div class="pass">
                        <h2 class="dinpro">Password</h2>

                        <div class="control-group">
                            <label class="control-label dinpro" for="cur_pass">Current Password:</label>
                            <div class="controls">
                                <input type="password" id="cur_pass" placeholder="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label dinpro" for="new_pass">New Password:</label>
                            <div class="controls">
                                <input type="password" id="new_pass" placeholder="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label dinpro" for="new_pass_confirm">Confirm New Password:</label>
                            <div class="controls">
                                <input type="password" id="new_pass_confirm" placeholder="">
                            </div>
                        </div>

                    </div>
                </section>
                <section class="col2">
                    <div class="contact">
                        <h2 class="dinpro">Contact Information</h2>
                        <div class="control-group">
                            <label class="control-label dinpro" for="email">Email:</label>
                            <div class="controls">
                                <input type="text" id="email" placeholder="ms2013@gmail.com">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label dinpro" for="phone">Phone Number:</label>
                            <div class="controls">
                                <input type="text" id="phone" placeholder="phone number">
                            </div>
                        </div>
                    </div>
                    <div class="other">
                        <h2 class="dinpro">Other Information</h2>
                        <div class="control-group">
                            <label class="control-label dinpro" for="asi">ASI <span>(optional)</span>:</label>
                            <div class="controls">
                                <input type="text" id="asi" placeholder="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label dinpro" for="ppai">PPAI <span>(optional)</span>:</label>
                            <div class="controls">
                                <input type="text" id="ppai" placeholder="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label dinpro" for="upic">UPIC <span>(optional)</span>:</label>
                            <div class="controls">
                                <input type="text" id="upic" placeholder="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label dinpro" for="sage">SAGE <span>(optional)</span>:</label>
                            <div class="controls">
                                <input type="text" id="sage" placeholder="">
                            </div>
                        </div>

                    </div>
                </section>
            </div>  <!-- .account-page -->
            <div class="control_btns">
                <input type="button" id="cancel" value="Cancel" />
                <input type="button" id="save" value="Save" />
            </div>
            </form>
        </div>  <!-- .account-page-wrap -->
    </div><!-- #content -->

<?php include_once('_footer.php'); ?>
