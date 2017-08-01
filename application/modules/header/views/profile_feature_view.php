 <!-- PROFILE FEATURE -->
    <section class="profile-feature">
        <div class="awe-parallax bg-profile-feature"></div>
        <div class="awe-overlay overlay-color-3"></div>
        <div class="container">
            <div class="info-author">
                <div class="image">
                    <?php 
                        if (!empty($data_user[0]->picture)) {
                            $picture = $data_user[0]->picture;
                        } else {
                            $picture = "avatar.png";
                        }
                    ?>
                    <img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">
                </div>    
                <div class="name-author">
                    <h2 class="big"><?php echo $name;?></h2>
                </div>     
               <!--  <div class="address-author">
                    <i class="fa fa-map-marker"></i>
                    <h3>Bandung, Indonesia</h3>
                </div> -->
            </div>
            <div class="info-follow">
                <!-- <div class="trophies">
                    <span>12</span>
                    <p>Trophies</p>
                </div>
                <div class="trophies">
                    <span>12</span>
                    <p>Follower</p>
                </div>
                <div class="trophies">
                    <span>20</span>
                    <p>Following</p>
                </div> -->
                <div class="trophies">
                    <span>IDR 0</span>
                    <!-- <p>Balance</p> -->
                </div>
            </div>
        </div>
    </section>
