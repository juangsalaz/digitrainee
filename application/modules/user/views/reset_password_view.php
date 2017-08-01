<?php echo $header;?>
    <!-- LOGIN -->
    <section id="login-content" class="login-content">
        <div class="awe-parallax bg-login-content"></div>
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="row">

                <!-- FORM -->
                <div class="col-xs-12 col-lg-4 pull-right">
                    <div class="form-login">
                        <form method="post" action="<?php echo base_url();?>user/resetPasswordProcess">
                            <h2 class="text-uppercase">Reset Your Password</h2>
                            <div class="form-password">
                                <input type="text" name="email_hash" value="<?php echo $email_hash;?>" style="display: none;">
                                <input type="text" name="password" placeholder="Enter new password" required>
                            </div>
                            <div class="form-password">
                                <input type="text" name="password2" placeholder="Enter new password again" required>
                            </div>
                            <div class="form-submit-1">
                                <input type="submit" value="Submit" class="mc-btn btn-style-1">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END / FORM -->
    
                <div class="image">
                    <!-- <img src="<?php echo base_url();?>assets/theme/images/homeslider/img-thumb.png" alt=""> -->
                </div>
    
            </div>
        </div>
    </section>
    <!-- END / LOGIN -->
    
<?php echo $footer;?>