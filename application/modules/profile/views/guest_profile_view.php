<?php echo $header;?>
<?php echo $profile_header;?>
 <!-- CONTEN BAR -->
    <section class="content-bar">
        <div class="container">
            <ul>
                <?php 
                    if (empty($email) and empty($email)) {
                ?>
                        <li class="current">
                            <a href="<?php echo base_url();?>profile/guest">
                                <i class="icon md-user-minus"></i>
                                Profile
                            </a>
                        </li>
                <?php 
                    } else {
                ?>
                        <li class="current">
                            <a href="<?php echo base_url();?>profile">
                                <i class="icon md-user-minus"></i>
                                Profile
                            </a>
                        </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </section>
   <!-- END / CONTENT BAR -->
<!-- PROFILE -->
    
    <section class="profile">
        <div class="container">
            
            <h3 class="md black">Profile</h3>
            <div class="row">
                <div class="col-md-9">
                    <div class="avatar-acount">
                        <div class="changes-avatar">
                            <div class="img-acount">
                                <?php 
                                    if (!empty($profile[0]->picture)) {
                                        $picture = $profile[0]->picture;
                                    } else {
                                        $picture = 'avatar.png';
                                    }
                                ?>
                                <img src="<?php echo base_url();?>upload/images/<?php echo $picture;?>" alt="">
                            </div>
                        </div>   
                        <div class="info-acount">
                            <h3 class="md black"><?php echo $profile[0]->username;?></h3>
                            <p><?php echo $profile[0]->about;?></p>
                            <div class="profile-email-address">
                                <div class="profile-email">
                                    <h5>Email</h5>
                                    <p><?php echo $profile[0]->email;?></p>
                                </div>
                               <!--  <div class="profile-address">
                                    <h5>Password</h5>
                                    <p>Hanoi , Vietnam</p>
                                </div> -->
                            </div>
                        </div>
                    </div>    
                </div>
                <!-- <div class="col-md-3">
                    <div class="social-connect">
                        <h5>Social connect</h5>
                        <ul>
                            <li>
                                <a href="#" class="twitter">
                                    <i class="icon md-twitter"></i>
                                    <p>https://www.facebook.com/</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="facebook">
                                    <i class="icon md-facebook-1"></i>
                                    <p>https://www.facebook.com/</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="gg-plus">
                                    <i class="icon md-google-plus"></i>
                                    <p>https://www.facebook.com/</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="printerest">
                                    <i class="icon md-pinterest-1"></i>
                                    <p>https://www.facebook.com/</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>    
        </div>
    </section>


    <!-- END / PROFILE -->
<?php echo $footer;?>