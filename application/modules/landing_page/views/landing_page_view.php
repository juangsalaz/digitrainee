

<div class="overlay-landing-page"></div>
<div class="landing-page">
	<div class="landing-page-container">
		<img src="<?php echo base_url();?>assets/images/banner1.jpg"><br>
		<center><h1><a style="color: white;" href="#" id="signup">Signup Sekarang</a></h1></center>
	</div>
</div>
<div class="presignup-popup">
	<div class="signup-container">
		<div class="signup-head">
			<h1>SignUp Now</h1>
			<h4>Get started with DigiTrainee</h4>
		</div>
		<div class="signup-form">
			<div>
				<!-- <form method="post" action="<?php echo base_url(); ?>index.php/user/signup"> -->
					<div class="input-form">
						<div><label>Full Name</label></div>
						<div><input type="text" name="name" id="name" placeholder="Full name"></div>
					</div>
					<div class="input-form">
						<div><label>Mobile</label></div>
						<div><input type="text" name="mobile" id="mobile" placeholder="Mobile No."></div>
					</div>
					<div class="input-form">
						<div><label>Your Email ID</label></div>
						<div><input type="email" name="email" id="email" placeholder="yourname@example.com"></div>
					</div>
					<div class="input-form" style="margin-top: 10px;">
						<div><label>Your Password</label></div>
						<div><input type="password" name="password" id="password" placeholder="xxxxxx"></div>
					</div>
					<div class="button-form">
						<input type="submit" id="signup-button" value="Signup">
					</div>
					<div class="clear"></div>
				<!-- </form> -->
			</div>
		</div>
	</div>
</div>

<div class="congrats-popup">
	<div class="congrats-container">
		<div class="congrats-head">
			<h1 id="selamat">Selamat</h1>
			<h2>Registrasi anda sudah berhasil</h2>
			<br>
			<h3>Berikut adalah link referral anda</h3>
			<input type="text" id="referral-code">
			<br>
			<br>
			<div class="fb-share-button" data-href="http://www.digitrainee.com/index.php/home?ref=5353534" data-layout="button"></div>
		</div>
	</div>
</div>
<script>
	$("#signup").click(function(){
		$(".landing-page").hide();
		$(".presignup-popup").show();
	});

	var getUrlParameter = function getUrlParameter(sParam) {
	    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
	        sURLVariables = sPageURL.split('&'),
	        sParameterName,
	        i;

	    for (i = 0; i < sURLVariables.length; i++) {
	        sParameterName = sURLVariables[i].split('=');

	        if (sParameterName[0] === sParam) {
	            return sParameterName[1] === undefined ? true : sParameterName[1];
	        }
	    }
	};

	$("#signup-button").click(function(){
		var referrer_var = getUrlParameter('ref');
		if (referrer_var != null) {
			var referrer = referrer_var;
		} else {
			var referrer = "";
		}

		$.post("<?php echo base_url(); ?>index.php/user/presignup", 
            {
                name : $("#name").val(),
                mobile : $("#mobile").val(),
                email : $("#email").val(),
                password : $("#password").val(),
                referrer : referrer
            }, 

            function(data) {
                var dataArray = $.parseJSON(data);
                
                if (dataArray.status_signup == 0) {
                	alert("Email "+dataArray.email+" sudah digunakan.");
                } else {
                	$(".presignup-popup").hide();
                	$(".congrats-popup").show();
                	$("#selamat").append(" "+dataArray.nama);
                	$("#referral-code").val("<?php echo base_url();?>index.php/home?ref="+dataArray.referral_code);
                	$(".fb-share-button").attr("data-href", "<?php echo base_url();?>index.php/home?ref="+dataArray.referral_code);
                }
            }
        );
	});
</script>