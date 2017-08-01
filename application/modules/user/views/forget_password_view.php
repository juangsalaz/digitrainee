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
                        <form method="post" action="<?php echo base_url();?>user/forgetPasswordProcess">
                            <h2 class="text-uppercase">Forget Password</h2>
                            <div class="form-email">
                                <input type="text" name="email" placeholder="Submit your email">
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