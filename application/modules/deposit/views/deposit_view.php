<html>
<head>
	<title>Digitrainee | Hand In Hand We Learn</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href='../assets/css/app.css' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="backtotop">
		<img src="<?php echo base_url();?>/assets/images/tombol_up.png">
	</div>
	<div class="overlay"></div>
	<div class="login-popup">
		<header class="login-header">
			<div id="login-fix-menu">
				<div class="nav-container">
					<div class="row">
						<a href="#" class="nav-logo">
							<img src="<?php echo base_url();?>/assets/images/logo.png">
						</a>
						<nav class="navbar pull-right">
							<div class="collapse navbar-collapse">
								<!-- <ul class="nav navbar-nav">
									<li><a href="#">LOGIN</a><img src="assets/images/line.png"></li>
									<li><a href="#">SIGNUP</a></li>
								</ul> -->
								<a class="close-overlay close-popup" href="#">
									<div class="close">
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
		<div class="login-container">
			<div class="login-head">
				<h1>Login Now</h1>
				<h4>Login with your account details</h4>
			</div>
			<div class="login-form">
				<div>
					<form method="post" action="<?php echo base_url(); ?>index.php/user/login">
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
							<a href="#">Forgot Password?</a> <input type="submit" value="Login">
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
					</form>
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
							<img src="../assets/images/logo.png">
						</a>
						<nav class="navbar pull-right">
							<div class="collapse navbar-collapse">
								<a class="close-overlay close-popup" href="#">
									<div class="close">
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
					<form method="post" action="<?php echo base_url(); ?>index.php/user/signup">
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
							<input type="submit" value="Signup">
						</div>
						<div class="clear"></div>
						<div class="signup-here">
							<h3>Already have an account, <a href="#" class="open-login">Login here</a></h3>
						</div>
					</form>
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
							<li><a href="#">IT Course</a></li>
							<li><a href="#">Business</a></li>
							<li><a href="#">Lifestyle</a></li>
							<li><a href="#">Academic</a></li>
							<li><a href="#">Art & Creativity</a></li>
							<li><a href="#">Telco</a></li>
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
	<section class="main-content gray-background">
		<div class="content-wrapper">
			<div class="row">
				<div class="title-content" style="width: 1155px; height: 50px; margin-left: 55px;">
					<p><a href="<?php echo base_url();?>" style="color: #6c8dde;">Home</a> / <a href="#" style="color: black; text-decoration: none;" class="bold">My Account</a></p>
					<h1>Deposit Cash</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="deposit-content">
		<div class="content-wrapper">
			<div style="width: 1155px; margin-left: 55px;">
				<div class="pull-left left-content">
					<div class="left-container">
						<h1>How Much Prepaid Credit Do You Want To Deposit?</h1>
						<h3>Deposits are in IDR, are non-refundable and will expire one year from last 
	deposit. For larger amounts, contact the help Team.</h3>
						<div class="deposit-option">
							<input type="radio" name="deposit-option"> <label>IDR 100.000</label>
							<ul>
								<li>A full access to our facility</li>
								<li>reward for promote</li>
								<li>Discount Online & Offline course</li>
								<li>Signup Fee 10 Credit</li>
							</ul>
						</div>
						<div class="deposit-option">
							<input type="radio" name="deposit-option"> <label>IDR 250.000</label>
							<ul>
								<li>A full access to our facility</li>
								<li>reward for promote</li>
								<li>Discount Online & Offline course</li>
								<li>Signup Fee 25 Credit</li>
							</ul>
						</div>
						<div class="deposit-option">
							<input type="radio" name="deposit-option"> <label>IDR 500.000</label>
							<ul>
								<li>A full access to our facility</li>
								<li>reward for promote</li>
								<li>Discount Online & Offline course</li>
								<li>Signup Fee 50 Credit</li>
							</ul>
						</div>
						<div class="deposit-option">
							<input type="radio" name="deposit-option"> <label>IDR 1000.000</label>
							<ul>
								<li>A full access to our facility</li>
								<li>reward for promote</li>
								<li>Discount Online & Offline course</li>
								<li>Signup Fee 100 Credit</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="pull-left right-content">
					<div class="current-credit">
						<h1>Current Credit Balance</h1>
						<h1 class="credit-point">$0.00</h1>
						<h2><a href="#">View Account History</a></h2>
					</div>
					<div class="tax-invoice">
						<h1>Need a tax invoice?</h1>
						<h2>Make sure you’ve added your company name to your</h2>
						<h2><a href="#">Personal information page</a></h2>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</section>
	<section class="payment-option">
		<div class="content-wrapper">
			<div style="width: 1155px; margin-left: 55px;">
				<div class="payment-content">
					<h1>How Do You Want to Pay?</h1>
					<hr class="line">
					<img class="pull-left" src="../assets/images/paypal_icon.jpg"> <img class="pull-left" style="margin-left: 60px;" src="../assets/images/visa_icon.jpg"> <a href="#"><div class="pull-right deposit-button"><h2>Make Deposit IDR</h2></div></a>
					<div class="clear"></div>
					<h3>You will be transferred to a secure PayPal page. After payment your cash will display in top panel.</h3>
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
					<h3 style="float: left;">Why</h3> <img src="../assets/images/icon_digitraini.jpg" style="float: left;">
				</header>
				<div>
					<p>Kami menyediakan berbagai penawaran pelatihan baik perorangan maupun institusi dengan berbagai pilihan paket yang menarik. Untuk penjelasan lebih lengkap klik disini.</p>
					<p>Follow Us</p>
					<a href="#"><img src="../assets/images/fb_icon.jpg"></a> <a href="#"><img src="../assets/images/twitter_icon.jpg"></a> <a href="#"><img src="../assets/images/google_icon.jpg"></a> <a href="#"><img src="../assets/images/linkedin_icon.jpg"></a>
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
<script src="../assets/js/jquery.js"></script>
<script>
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
	});
</script>