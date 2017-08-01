<?php echo $header;?>
<?php echo $profile_header;?>
<!-- PROFILE -->
    <section class="content-bar">
        <div class="container">
            <ul>
                <li>
                    <a href="<?php echo base_url();?>profile/learning">
                        <i class="icon md-book-1"></i>
                        Learning
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url();?>profile/teaching">
                        <i class="icon md-people"></i>
                        Teaching
                    </a>
                </li>
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
    <section class="profile">
        <div class="container">
            <h3 class="md black">Profile</h3>
            <div class="row">
                <div class="col-md-9">
                    <form method="post" action="<?php echo base_url();?>profile/saveProfile" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="avatar-acount">
                            <div class="changes-avatar">
                                <div class="img-acount">
                                    <?php 
                                        if (!empty($data_user[0]->picture)) {
                                            $picture = $data_user[0]->picture;
                                        } else {
                                            $picture = "avatar.png";
                                        }
                                    ?>
                                    <img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">
                                </div>
                                <div class="choses-file up-file">
                                    <input type="file" name="userfile" value="">
                                    <!-- <input type="hidden"> -->
                                    <a href="" class="mc-btn btn-style-6">Changes image</a>
                                </div>
                            </div>   
                            <div class="info-acount">
                                <h3 class="md black"><?php echo $name;?></h3>
                                <textarea name="user_about" style="border: none;"><?php echo $data_user[0]->about; ?></textarea>
                                <div class="security">
                                    <div class="tittle-security"> 
                                        <?php 
                                            if ($this->session->flashdata('error_alert')) {
                                        ?>
                                                <div class="alert alert-danger" role="alert"><?php echo $this->session->flashdata('error_alert');?></div>
                                        <?php
                                            } if ($this->session->flashdata('success_alert')) {
                                        ?>
                                                <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success_alert');?></div>
                                        <?php
                                            } if ($this->session->flashdata('success_image_alert')) {
                                        ?>
                                                <div class="alert alert-success" role="alert"><?php echo $this->session->flashdata('success_image_alert');?></div>
                                        <?php
                                            }
                                        ?>     
                                        <h5>Email</h5>
                                        <input type="text" name="email" value="<?php echo $email;?>">
                                        <h5>Company</h5>
                                        <select name="company" style="display: block;
                                                                    width: 100%;
                                                                    height: 30px;
                                                                    border: 1px solid #d4d4d4;
                                                                    border-radius: 3px;
                                                                    margin-top: 10px;
                                                                    padding: 0 10px;
                                                                    font-family: 'Raleway', sans-serif;
                                                                    font-size: 13px;
                                                                    color: #666;
                                                                    margin-bottom: 20px;">
                                            <option>-Personal-</option>
                                            <?php foreach($companyList as $comp) {
                                                echo '<option value="'.$comp->id.'" '.($comp->id == $data_user[0]->company_id ? "selected" : "").'>'.$comp->name.'</option>';
                                            }?>
                                        </select>
                                        <h5>Password</h5>
                                        <input type="password" name="current_password" placeholder="Current password">
                                        <input type="password" name="new_password" placeholder="New password">
                                        <input type="password" name="confirm_password" placeholder="Confirm password">
                                    </div>
                                </div>
                            </div>
                            <div class="input-save">   
                                <input type="submit" value="Save changes" class="mc-btn btn-style-1">
                            </div>
                        </div>
                    </form>
                </div>
				<!--
                <div class="col-md-3">
                    <div class="social-connect">
                        <h5>Social connect</h5>
                        <ul>
                            <li>
                                <a href="#" class="twitter">
                                    <i class="icon md-twitter"></i>
                                    <p>https://www.twitter.com/</p>
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
                                    <p>https://plus.google.com/</p>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="printerest">
                                    <i class="icon md-pinterest-1"></i>
                                    <p>https://www.pinterest.com/</p>
                                </a>
                            </li>
                        </ul>
                        <div class="add-link">
                            <i class="icon md-plus"></i>
                            <input type="text" placeholder="paste link here">
                        </div>
                    </div>
                </div>
				-->
            </div>
        </div>
    </section>
<?php echo $footer;?>