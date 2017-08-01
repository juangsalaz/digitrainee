<html>
<head>
    <title>Digitrainee | Hand In Hand We Learn</title>
    <link href="http://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    <!-- <link href="<?php echo base_url();?>assets/css/bootstraps/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
    <link href="<?php echo base_url();?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/css/app.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
    <script>
        $(function() {
            $( "#tabs" ).tabs();
        });
    </script>
</head>
<body>
    <div id="backtotop">
        <img src="<?php echo base_url();?>assets/images/tombol_up.png">
    </div>
    <div class="overlay"></div>
    <div class="login-popup">
        <header class="login-header">
            <div id="login-fix-menu">
                <div class="nav-container">
                    <div class="row">
                        <a href="#" class="nav-logo">
                            <img src="<?php echo base_url();?>assets/images/logo.png">
                        </a>
                        <nav class="navbar pull-right">
                            <div class="collapse navbar-collapse">
                                <a class="close-overlay close-popup" href="#">
                                    <div class="close-popup">
                                        <span class="close-icon">X</span>
                                    </div>
                                </a>
                            </div>
                        </nav>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </header>
        <div class="login-container">
            <div class="login-head">
                <h1>Login Now</h1>
                <h4>Login with your account details</h4>
            </div>
            <div class="login-form">
                <div>
                    <div class="input-form">
                        <div><label>Your Email ID</label></div>
                        <div><input type="email" name="email" placeholder="yourname@example.com"></div>
                    </div>
                    <div class="input-form" style="margin-top: 10px;">
                        <div><label>Your Password</label></div>
                        <div><input type="password" name="password" placeholder="xxxxxx"></div>
                    </div>
                    <div class="keep-login">
                        <input type="checkbox" name="keep"> <label>Keep me logged in</label>
                    </div>
                    <div class="button-form">
                        <a href="#">Forgot Password?</a> <input type="button" value="Login">
                    </div>
                    <div class="clear"></div>
                    <div style="text-align: center;">
                        <h1 style="font-size: 28px; color: #666a75; font-weight: 500; margin: 0;">or</h1>
                    </div>
                    <div class="sosmed-login">
                        <a href="#"><img id="facebook-login" src="<?php echo base_url();?>assets/images/facebook_login.jpg"></a> <a href="#"><img id="google-login" src="<?php echo base_url();?>assets/images/google_login.jpg"></a> <a href="#"><img id="linkedin-login" src="<?php echo base_url();?>assets/images/linkedin_login.jpg"></a>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                    <div class="signup-here">
                        <h3>Still don't have account, <a href="#" class="open-signup">SignUp here</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="signup-popup">
        <header class="signup-header">
            <div id="signup-fix-menu">
                <div class="nav-container">
                    <div class="row">
                        <a href="#" class="nav-logo">
                            <img src="<?php echo base_url();?>assets/images/logo.png">
                        </a>
                        <nav class="navbar pull-right">
                            <div class="collapse navbar-collapse">
                                <a class="close-overlay close-popup" href="#">
                                    <div class="close-popup">
                                        X
                                    </div>
                                </a>
                            </div>
                        </nav>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </header>
        <div class="signup-container">
            <div class="signup-head">
                <h1>SignUp Now</h1>
                <h4>Get started with DigiTrainee</h4>
            </div>
            <div class="signup-form">
                <div>
                    <div class="input-form">
                        <div><label>Full Name</label></div>
                        <div><input type="text" name="name" placeholder="Full name"></div>
                    </div>
                    <div class="input-form">
                        <div><label>Mobile</label></div>
                        <div><input type="text" name="mobile" placeholder="Mobile No."></div>
                    </div>
                    <div class="input-form">
                        <div><label>Your Email ID</label></div>
                        <div><input type="email" name="email" placeholder="yourname@example.com"></div>
                    </div>
                    <div class="input-form" style="margin-top: 10px;">
                        <div><label>Your Password</label></div>
                        <div><input type="password" name="password" placeholder="xxxxxx"></div>
                    </div>
                    <div class="button-form">
                        <input type="button" value="signup">
                    </div>
                    <div class="clear"></div>
                    <div class="signup-here">
                        <h3>Already have an account, <a href="#" class="open-login">Login here</a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $header; ?>
    <section class="bottom-nav">
        <div class="nav-container">
            <div class="row">
                <nav class="pull-left">
                    <div class="bottom-nav-wrap">
                        <ul>
                            <li><a href="<?php echo base_url();?>">All</a></li>
                            <li><a href="#">Telecommunication</a></li>
							<li><a href="#">IT Course</a></li>
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Academic</a></li>
                            <li><a href="#">Art & Creativity</a></li>
                            <li><a href="#">Exam & Certification Prep</a></li>
                        </ul>
                    </div>
                </nav>
                <nav class="pull-right">
                    <div class="right-nav-wrap">
                        <ul>
                            <li><a href="<?php echo base_url();?>">All</a></li>
                            <li><a id="active" href="#">Paid</a></li>
                            <li><a href="#">Free</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="clear"></div>
            </div>
        </div>
    </section>
    <section class="red-line">
        <div></div>
    </section>
    <section class="main-content-addcourse gray-background">
        <div class="content-wrapper">
            <div class="row">
                <div class="title-content" style="height: 50px; margin-left: 55px;">
                    <div id="draf-course">
                        <h1><span class="bold">Draft</span> Course</h1>
                    </div>
                    <a href="#">
                        <div id="preview">
                            Preview
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="add-course-form">
        <div id="course-form-wrap">
            <div style="margin: 0 0 0 15px;">
                <form class="form-horizontal" role="form">
                    <div id="right-course-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" style="width: 145px;" for="course_name">Course Name</label>
                            <div class="col-sm-10" style="width: 400px;">
                                <input type="text" class="form-control" id="course_name" style="width: 400px;" placeholder="Enter Course Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" style="width: 145px;" for="category">Category</label>
                            <div class="col-sm-10" style="width: 400px;">
                                <select class="form-control" id="category" style="width: 400px;">
                                    <option value="">Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" style="width: 145px;" for="sub_category">Sub Category</label>
                            <div class="col-sm-10" style="width: 400px;">
                                <select class="form-control" id="sub_category" style="width: 400px;">
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="left-course-form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" style="width: 145px;" for="point">Point</label>
                            <div class="col-sm-10" style="width: 400px;">
                                <input type="text" class="form-control" id="course_name" style="width: 400px;" placeholder="Enter Course Point">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="btn btn-default btn-file">
                                Upload Icon <input type="file">
                            </span>
                            <label id="upload-label"></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" style="width: 145px;" for="promo_video">Promo Video</label>
                            <div class="col-sm-10" style="width: 400px;">
                                <input type="text" class="form-control" id="promo_video" style="width: 400px;" placeholder="Enter Promo Video">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="clear"></div>
            <br>
            <br>
            <div style="width: 1120px; margin: 0 auto;">
                <div id="tabs">
                  <ul>
                    <li><a href="#tabs-1">Detail</a></li>
                    <li><a href="#tabs-2">Video</a></li>
                    <li><a href="#tabs-3">Profile</a></li>
                    <li><a href="#tabs-4">Curriculum</a></li>
                    <li><a href="#tabs-5">FAQ</a></li>
                  </ul>
                  <div id="tabs-1">
                    <textarea id="detail" name="detail"></textarea>
                  </div>
                  <div id="tabs-2">
                    <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
                  </div>
                  <div id="tabs-3">
                    <textarea id="profile" name="profile"></textarea>
                  </div>
                  <div id="tabs-4">
                    <textarea id="curriculum" name="curriculum"></textarea>
                  </div>
                  <div id="tabs-5">
                    <textarea id="faq" name="faq"></textarea>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <br>
    <br>
    <br>
    <br>
    <section class="footer">
        <div class="footer-wrap">
            <div class="footer-left">
                <header>
                    <h3 style="float: left;">Why</h3> <img src="<?php echo base_url();?>assets/images/icon_digitraini.jpg" style="float: left;">
                </header>
                <div>
                    <p>Kami menyediakan berbagai penawaran pelatihan baik perorangan maupun institusi dengan berbagai pilihan paket yang menarik. Untuk penjelasan lebih lengkap klik disini.</p>
                    <p>Follow Us</p>
                    <a href="#"><img src="<?php echo base_url();?>assets/images/fb_icon.jpg"></a> <a href="#"><img src="<?php echo base_url();?>assets/images/twitter_icon.jpg"></a> <a href="#"><img src="<?php echo base_url();?>assets/images/google_icon.jpg"></a> <a href="#"><img src="<?php echo base_url();?>assets/images/linkedin_icon.jpg"></a>
                </div>
            </div>
            <div class="footer-center">
                <header>
                    <h3>Contact Us</h3>
                </header>
                <div>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</p>
                </div>
            </div>
            <div class="footer-right">
                <header>
                    <h3>How To Join Teach?</h3>
                </header>
                <div>
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</p>
                </div>
            </div>
            
            <div class="copyright">
                <p class="copyright-text">DigiTrainee. Copyright (c) 2014-2015 All right reserved.</p>
                <p class="policy"><a href="#">Privacy Policy</a> | <a href="#">Term of use</a></p>
            </div>
            <div class="clear"></div>
        </div>
    </section>
</body>
</html>
<script>
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready(function(){
        $(window).on('scroll',function() {
            var scrolltop = $(this).scrollTop();

            if(scrolltop >= 225) {
                $('#fix-menu').fadeIn(1000);
            } else if(scrolltop <= 225) {
                $('#fix-menu').fadeOut(250);
            }
        });

        $(".close-overlay").click(function(){
            $(".overlay").hide();
            $(".login-popup").hide();
            $(".signup-popup").hide();
        });

        $(".show-overlay-login").click(function(){
            $(".overlay").show();
            $(".login-popup").show();
        });

        $(".show-overlay-signup").click(function(){
            $(".overlay").show();
            $(".signup-popup").show();
        });

        $(".open-login").click(function(){
            $(".signup-popup").hide();
            $(".login-popup").show();
        });

        $(".open-signup").click(function(){
            $(".login-popup").hide();
            $(".signup-popup").show();
        });

        $(window).scroll(function() {
            if($(this).scrollTop() != 0) {
                $('#backtotop').fadeIn();
            } else {
                $('#backtotop').fadeOut();
            }
        });
 
        $('#backtotop').click(function() {
            $('body,html').animate({scrollTop:0},800);
        });

        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
            // console.log(numFiles);
            // console.log(label);
            $("#upload-label").text(label);
        });

        CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace('detail', {
            toolbar: [
                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline'] },
                        { name: 'paragraph', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                        { name: 'styles', items: [ 'Font', 'FontSize' ] },
                        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                        { name: 'morestuff', items: ['NumberedList', 'BulletedList'] },
                    ],
            filebrowserBrowseUrl :'<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserImageBrowseUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserFlashBrowseUrl :'<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserUploadUrl  :'<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=File',
            filebrowserImageUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
            filebrowserFlashUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
        });

        CKEDITOR.replace('profile', {
            toolbar: [
                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline'] },
                        { name: 'paragraph', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                        { name: 'styles', items: [ 'Font', 'FontSize' ] },
                        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                        { name: 'morestuff', items: ['NumberedList', 'BulletedList'] },
                    ],
            filebrowserBrowseUrl :'<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserImageBrowseUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserFlashBrowseUrl :'<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserUploadUrl  :'<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=File',
            filebrowserImageUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
            filebrowserFlashUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
        });

        CKEDITOR.replace('curriculum', {
            toolbar: [
                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline'] },
                        { name: 'paragraph', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                        { name: 'styles', items: [ 'Font', 'FontSize' ] },
                        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                        { name: 'morestuff', items: ['NumberedList', 'BulletedList'] },
                    ],
            filebrowserBrowseUrl :'<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserImageBrowseUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserFlashBrowseUrl :'<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserUploadUrl  :'<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=File',
            filebrowserImageUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
            filebrowserFlashUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
        });

        CKEDITOR.replace('faq', {
            toolbar: [
                        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline'] },
                        { name: 'paragraph', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                        { name: 'styles', items: [ 'Font', 'FontSize' ] },
                        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                        { name: 'morestuff', items: ['NumberedList', 'BulletedList'] },
                    ],
            filebrowserBrowseUrl :'<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserImageBrowseUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserFlashBrowseUrl :'<?php echo base_url(); ?>assets/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/connector.php',
            filebrowserUploadUrl  :'<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=File',
            filebrowserImageUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
            filebrowserFlashUploadUrl : '<?php echo base_url(); ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
        });
    });
</script>