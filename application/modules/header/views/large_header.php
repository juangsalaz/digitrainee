<section id="large-header">
	<div id="large-header-container">
		<div id="fix-menu">
			<div class="nav-container">
				<div class="row">
					<a href="#" class="nav-logo">
						<img src="<?php echo base_url();?>assets/images/logo.png">
					</a>
					<nav class="navbar pull-right">
						<div class="collapse navbar-collapse">
							<ul class="nav navbar-nav">
								<li><input type"text" name="search" class="header-search" placeholder="Identify Course..."></li>
								<?php 
									if (!empty($name) AND !empty($email)) {
								?>
										<li class="user-menu">
											<div class="account-info" style="min-width: 200px;"><a href="#" style="font-weight: bold; float: left;"><?php echo $name?></a> <a style="font-weight: bold; float: right;" href="#">500 Point</a><div class="clear"></div></div>
											<ul class="fallback shadow">
												<li><a style="padding: 3px 10px 3px 10px;" href="#">Profile <img style="float: right;" src="<?php echo base_url();?>assets/images/Profile.png"></a></li>
												<li><a style="padding: 3px 10px 3px 10px;" href="#">Learning<img style="float: right;" src="<?php echo base_url();?>assets/images/Learning.png"></a></li>
												<li><a style="padding: 3px 10px 3px 10px;" href="#">Teaching<img style="float: right; width: 25px;" src="<?php echo base_url();?>assets/images/Teaching.png"></a></li>
												<li><a style="padding: 3px 10px 3px 10px;" href="#">Wishlist<img style="float: right; width: 25px;" src="<?php echo base_url();?>assets/images/Wishlist.png"></a></li>
												<li><a style="padding: 3px 10px 3px 10px;" href="#">Deposit<img style="float: right;" src="<?php echo base_url();?>assets/images/Deposit.png"></a></li>
												<li><a style="padding: 3px 10px 3px 10px;" href="<?php echo base_url();?>index.php/user/logout">Logout<img style="float: right;" src="<?php echo base_url();?>assets/images/Logout.png"></a></li>
											</ul>
										</li>
								<?php
									} else {
								?>
										<li style="margin-top: 5px;"><a href="#" class="show-overlay-login">LOGIN</a></li>
										<li><img src="<?php echo base_url();?>assets/images/line.png"></li>
										<li style="margin-top: 5px;"><a href="#" class="show-overlay-signup" style="padding-right: 0;">SIGNUP</a></li>
								<?php }?>
							</ul>
						</div>
					</nav>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<div id="menu">
			<div class="nav-container">
				<div class="row">
					<a href="#" class="nav-logo">
						<img src="<?php echo base_url();?>assets/images/logo.png">
					</a>
					<nav class="navbar pull-right">
						<div class="collapse navbar-collapse">
							<ul class="nav navbar-nav">
								<?php 
									if (!empty($name) AND !empty($email)) {
								?>
										<li class="user-menu">
											<div class="account-info" style="min-width: 200px;"><a href="#" style="font-weight: bold; float: left;"><?php echo $name?></a> <a style="font-weight: bold; float: right;" href="#">500 Point</a><div class="clear"></div></div>
											<ul class="fallback shadow">
												<li><a style="padding: 3px 10px 3px 10px;" href="#">Profile <img style="float: right;" src="<?php echo base_url();?>assets/images/Profile.png"></a></li>
												<li><a style="padding: 3px 10px 3px 10px;" href="#">Learning<img style="float: right;" src="<?php echo base_url();?>assets/images/Learning.png"></a></li>
												<li><a style="padding: 3px 10px 3px 10px;" href="#">Teaching<img style="float: right; width: 25px;" src="<?php echo base_url();?>assets/images/Teaching.png"></a></li>
												<li><a style="padding: 3px 10px 3px 10px;" href="#">Wishlist<img style="float: right; width: 25px;" src="<?php echo base_url();?>assets/images/Wishlist.png"></a></li>
												<li><a style="padding: 3px 10px 3px 10px;" href="#">Deposit<img style="float: right;" src="<?php echo base_url();?>assets/images/Deposit.png"></a></li>
												<li><a style="padding: 3px 10px 3px 10px;" href="<?php echo base_url();?>index.php/user/logout">Logout<img style="float: right;" src="<?php echo base_url();?>assets/images/Logout.png"></a></li>
											</ul>
										</li>
								<?php
									} else {
								?>
										<li style="margin-top: 5px;"><a href="#" class="show-overlay-login">LOGIN</a></li>
										<li><img src="<?php echo base_url();?>assets/images/line.png"></li>
										<li style="margin-top: 5px;"><a href="#" class="show-overlay-signup" style="padding-right: 0;">SIGNUP</a></li>
								<?php }?>
							</ul>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="caption" style="top: 15%;">
		<div class="container">
			<div class="main-caption">
				<h1>We Enter To Learn, <br>Leave To Achieve</h1>
				<div class="main-search">
					<div class="input-group">
						<form method="post" action="">
							<div id="search-form">
								<input type="text" name="input-search" id="input-search" placeholder="Identify Course...">
							</div>
							<div id="div-button">
								<button id="button-search" type="submit" value="Search">Search</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>