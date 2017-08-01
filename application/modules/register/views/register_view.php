<?php echo $header;?>
<!-- REGISTER -->
    <section id="login-content" class="login-content">
        <div class="awe-parallax bg-login-content"></div>
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="row">
    
    
                
                <!-- FORM -->
                <div class="col-lg-4 pull-right">
                    <div class="form-login">
                        <form method="post" action="<?php echo base_url();?>user/signup">
                            <h2 class="text-uppercase">sign up</h2>
                            <div class="form-datebirth">
                                <input type="text" name="name" placeholder="Full name">
                            </div>
                            <div class="form-datebirth">
                                <input type="text" name="mobile" placeholder="Mobile">
                            </div>
                            <div class="form-email">
                                <input type="text" name="email" placeholder="Email">
                            </div>
                            <div class="form-email">
                                <select name="company" style="display: block;
                                                           font-family: 'Lato', sans-serif;
                                                            font-size: 14px;
                                                            color: #A5A5A5;
                                                            padding: 0 12px;
                                                            height: 40px;
                                                            width: 100%;
                                                            border-radius: 4px;
                                                            border: 0;
                                                            margin-top: 20px;">
                                    <option>Company</option>
                                    <option>Personal</option>
                                    <?php foreach($companyList as $comp) {
                                        echo '<option value="'.$comp->id.'">'.$comp->name.'</option>';
                                    }?>
                                </select>
                            </div>
                            <div class="form-password">
                                <input type="password" name="password" placeholder="Password">
                            </div>
                            
                            <div class="form-submit-1">
                                <input type="submit" value="Become a member" class="mc-btn btn-style-1">
                            </div>
                            <div class="link">
                                <a href="<?php echo base_url();?>login">
                                    <i class="icon md-arrow-right"></i>Already have account ? Log in
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
    <!-- END / REGISTER -->
    
<?php echo $footer;?>