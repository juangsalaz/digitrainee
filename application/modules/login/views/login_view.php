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
                        <form method="post" action="<?php echo base_url();?>user/login">
                            <h2 class="text-uppercase">sign in</h2>
                            <div class="form-email">
                                <input type="text" name="email" placeholder="Email">
                            </div>
                            <div class="form-password">
                                <input type="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="check">
                                <label for="check">
                                <i class="icon md-check-2"></i>
                                Remember me</label>
                                <a href="<?php echo base_url();?>user/forgetPassword">Forget password?</a>
                            </div>
                            <div class="form-submit-1">
                                <input type="submit" value="Sign In" class="mc-btn btn-style-1">
                            </div>
                            <div class="link">
                                <a href="<?php echo base_url();?>register">
                                    <i class="icon md-arrow-right"></i>Don’t have account yet ? Join Us
                                </a>
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