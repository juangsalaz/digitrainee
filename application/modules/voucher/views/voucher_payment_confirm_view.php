<?php echo $header;?>
<!-- PAYMENT CONFIRM -->
    <section id="login-content" class="login-content">
        <div class="awe-parallax bg-login-content"></div>
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="row">
                <!-- FORM -->
                <div class="col-lg-12">
                    <div class="form-login">
                        <form method="post" action="">
                            <h2 class="text-uppercase">Confirm Reuqest</h2>
                            <?php if ($this->session->flashdata('success_msg')) { ?>
                                <div class="alert alert-success" style="display:block"> <?php echo $this->session->flashdata('success_msg'); ?> </div>
                            <?php } ?>

                            <?php if ($this->session->flashdata('error_msg')) { ?>
                                <div class="alert alert-danger" style="display:block"> <?php echo $this->session->flashdata('error_msg'); ?> </div>
                            <?php } ?>

                            <div class="form-datebirth">
                                <input type="text" name="no_inv" placeholder="Invoice Number" value="<?php echo $noInv; ?>">
                            </div>
                            <div class="form-datebirth">
                                <input class="datepicker" name="date_confirm" placeholder="dd/mm/yyyy">
                            </div>
                            <div class="form-email">
                                <input type="text" name="acc_name" placeholder="Your Bank Account Name">
                            </div>
                            <div class="form-email">
                                <input type="text" name="acc_number" placeholder="Your Bank Account Number">
                            </div>                            
                            <div class="form-email">
                                <input type="text" name="ref_number" placeholder="Reference Number">
                            </div>                            
                            <div class="form-email">
                                <input type="text" name="total_transfer" placeholder="Total Transfer">
                            </div>
                            <div class="form-submit-1">
                                <input type="submit" value="Confirm" class="mc-btn btn-style-1">
                            </div>                            
                        </form>
                    </div>
                </div>
                <!-- END / FORM -->
            </div>
        </div>
    </section>
    <!-- END / REGISTER -->

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/css/library/bootstrap-datepicker.min.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/bootstrap-datepicker.min.js"></script>

    <script>
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
        })
    </script>
    
<?php echo $footer;?>