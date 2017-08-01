<?php echo $header;?>
<!-- REQUEST -->
    <section id="login-content" class="login-content">
        <div class="awe-parallax bg-login-content"></div>
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="row">
                <!-- FORM -->
                <div class="col-lg-12">
                    <div class="form-login">
                        <form method="post" action="">
                            <h2 class="text-uppercase">Reuqest Voucher</h2>
                            <?php if ($this->session->flashdata('success_msg')) { ?>
                                <div class="alert alert-success" style="display:block"> <?php echo $this->session->flashdata('success_msg'); ?> </div>
                            <?php } ?>

                            <?php if ($this->session->flashdata('error_msg')) { ?>
                                <div class="alert alert-danger" style="display:block"> <?php echo $this->session->flashdata('error_msg'); ?> </div>
                            <?php } ?>

                            <div class="form-datebirth">
                                <input type="number" name="nominal" placeholder="Nominal">
                            </div>
                            <div class="form-datebirth">
                                <input type="number" name="total_voucher" placeholder="Total Voucher">
                            </div>
                            <div class="form-email">
                                <input type="text" name="email" placeholder="Email">
                            </div>
                            <div class="form-email">
                                <input type="text" name="name" placeholder="Name">
                            </div>                            
                            <div class="form-submit-1">
                                <input type="submit" value="Send Request" class="mc-btn btn-style-1">
                            </div>                            
                        </form>
                    </div>
                </div>
                <!-- END / FORM -->
            </div>
        </div>
    </section>
    <!-- END / REGISTER -->
    
<?php echo $footer;?>