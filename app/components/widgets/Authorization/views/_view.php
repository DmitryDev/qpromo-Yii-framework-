<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <div class="modal-body">
        <div class="tab-pane">
            <ul class="nav nav-tabs">
                <li class="active"><a class="login" href="#tab1">Log In</a></li>
                <li class=""><a class="signup" href="#tab2">Sign Up</a></li>
            </ul>
            <div class="tab-content">
                <?php $this->render('_login_tab', array('model'=>$loginModel));?>
                <?php $this->render('_signup_tab', array('model'=>$signupModel));?>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <button type="button" class="close" id="cancel_reset_top" ></button>
    <?php $this->render('_recovery', array('model'=>$recoveryModel));?>
</div>
