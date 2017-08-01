    <div id="spinner2"></div>
    <!-- FOOTER -->
    <footer id="footer" class="footer">
        <div class="first-footer">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="widget megacourse">
                            <h3 class="md">DigiTrainee</h3>
                            <p>We provide courses to millions people and we help them pick up brand new skills, switch careers, and explore new hobbies.</p>
                            <a href="#" class="mc-btn btn-style-1">Get started</a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="widget widget_latest_new">
                            <h3 class="sm">Latest News</h3>
                            <ul>
                                <li>
                                    <a href="#">
                                        <div class="image-thumb">
                                            <img src="<?php echo base_url(); ?>assets/theme/images/team-13.jpg" alt="">
                                        </div>
                                        <span>How to develop Android application on iOS?</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="image-thumb">
                                            <img src="<?php echo base_url(); ?>assets/theme/images/team-13.jpg" alt="">
                                        </div>
                                        <span>How to design Disaster Recovery Center?</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="widget quick_link">
                            <h3 class="sm">Quick Links</h3>
                            <ul class="list-style-block">
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Terms of use</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="widget news_letter">
                            <div class="awe-static bg-news_letter"></div>
                            <div class="overlay-color-3"></div>
                            <div class="inner">
                                <div class="letter-heading">
                                    <h3 class="md">News letter</h3>
                                    <p>Don’t miss a course sale! Join our network today and keep it up!</p>
                                </div>
                                <div class="letter">
                                    <form>
                                        <input class="input-text" type="text" id="newsletter_email">
                                        <div id="newsletter-msg" class="alert alert-danger" style="display:none;"></div>
                                        <span class="no-spam">* No spam guaranteed</span>
                                        <input type="button" id="submit-newsletter" value="Submit now" class="mc-btn btn-style-2">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="second-footer">
            <div class="container">
                <div class="contact">
                    <div class="email">
                        <i class="icon md-email"></i>
                        <a href="#">info@digitrainee.com</a>
                    </div>
                    <div class="phone">
                        <i class="fa fa-mobile"></i>
                        <span>+62 999 999 999</span>
                    </div>
                    <div class="address">
                        <i class="fa fa-map-marker"></i>
                        <span>Jakarta, ID</span>
                    </div>
                </div>
                <p class="copyright">Copyright © 2015 Digitrainee. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <!-- END / FOOTER -->


    <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery.owl.carousel.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery.appear.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/scripts.js"></script>

    <script>
        $('#submit-newsletter').on('click', '', function() {
            var email = $('#newsletter_email').val();

            if (validateEmail(email)) {
                var postData = {
                    'email' : email
                };
                $("#spinner2").show();

                $.post('/user/addNewsletter', postData, function(data){
                    console.log(data);

                    //This should be JSON preferably. but can't get it to work on jsfiddle
                    //Depending on what your controller returns you can change the action
                    if (data == true) {
                        $("#spinner").hide(); 
                        $('#newsletter-msg').removeClass('alert-danger').addClass('alert-success');
                        $('#newsletter-msg').html('Register newsletter success');
                        $('#newsletter-msg').show();
                        $('#newsletter_email').val('');
                    } else {
                        $('#newsletter-msg').removeClass('alert-success').addClass('alert-danger');
                        $('#newsletter-msg').html('Your email already registered');
                        $('#newsletter-msg').show();
                    }
                });
            } else {
                $('#newsletter-msg').removeClass('alert-success').addClass('alert-danger');
                $('#newsletter-msg').html('Your email invalid');
                $('#newsletter-msg').show();
            }
        })

        function validateEmail(email) {
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            return re.test(email);
        }
    </script>



</div>
<!-- END / PAGE WRAP -->
</body>
</html>