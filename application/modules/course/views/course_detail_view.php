<?php echo $header;?>
<!-- SUB BANNER -->
    <section class="sub-banner sub-banner-course">
        <div class="awe-static bg-sub-banner-course"></div>
        <div class="container">
            <div class="sub-banner-content">
                <h2 class="text-center"><?php echo $data_course[0]['course_title']; ?></h2>
            </div>
        </div>
    </section>
    <!-- END / SUB BANNER -->

    <!-- COURSE -->
    <section class="course-top">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="sidebar-course-intro">
                        <div class="breadcrumb">
                            <a href="<?php echo base_url();?>">Home</a> / 
                            <a href="<?php echo base_url();?>course">Course</a> / 
                            <?php echo $data_course[0]['course_title']; ?>
                        </div>   
                        <div class="video-course-intro">
                            <div class="inner">
                                <?php 
                                    if (!empty($data_course[0]['video_promo'])) {

                                    } else {
                                ?>
                                        <img src="<?php echo base_url();?>upload/images/no_video.png" alt="">
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="price">
                                <?php 
                                    if ($data_course[0]['is_free'] == 0) {
                                        echo 'IDR '.$data_course[0]['price'];
                                ?>
                                        <input type="text" value="<?php echo $data_course[0]['price'];?>" id="price-course" style="display: none;">
                                <?php
                                    } elseif ($data_course[0]['is_free'] == 1) {
                                        echo 'FREE';
                                ?>
                                        <input type="text" value="FREE" id="price-course" style="display: none;">   
                                <?php
                                    }
                                    
                                ?>
                            </div>
                            <?php 
                                if (isset($is_taked_course)) {
                                    if ($is_taked_course != 1) {
                            ?>
                                        <a href="#" class="take-this-course mc-btn btn-style-1">Take this course</a>
                            <?php
                                    }
                                }                      
                            ?>
                        </div>
                        <hr class="line">
                        <div class="about-instructor">
                            <h4 class="xsm black bold">About Instructor</h4>
                            <ul>
                                <li>
                                    <div class="image-instructor text-center">
                                        <?php 
                                            if (!empty($data_course[0]['picture'])) {
                                                $picture = $data_course[0]['picture'];
                                            } else {
                                                $picture = 'avatar.png';
                                            }
                                        ?>
                                        <img src="<?php echo base_url();?>upload/images/<?php echo $picture;?>" alt="">
                                    </div>
                                    <div class="info-instructor">
                                        <cite class="sm black"><a href="#"><?php echo $data_course[0]['username']; ?></a></cite>
                                        <p><?php echo $data_course[0]['about_instructur']; ?></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <hr class="line">
                        <div class="widget widget_equipment">
                            <i class="icon md-config"></i>
                            <h4 class="xsm black bold">Equipment</h4>
                            <div class="equipment-body">
                                <a href="#"><?php echo $data_course[0]['tool_requirement']; ?></a>
                            </div>
                        </div>
                        <div class="widget widget_tags">
                            <i class="icon md-download-2"></i>
                            <h4 class="xsm black bold">Tag</h4>
                            <div class="tagCould">
                                <a href="#"><?php echo $data_course[0]['tag']; ?></a>
                            </div>
                        </div>
                        <div class="widget widget_share">
                            <i class="icon md-forward"></i>
                            <h4 class="xsm black bold">Share course</h4>
                            <div class="share-body">
                                <a href="#" class="twitter" title="twitter">
                                    <i class="icon md-twitter"></i>
                                </a>
                                <a href="#" class="pinterest" title="pinterest">
                                    <i class="icon md-pinterest-1"></i>
                                </a>
                                <a href="#" class="facebook" title="facebook">
                                    <i class="icon md-facebook-1"></i>
                                </a>
                                <a href="#" class="google-plus" title="google plus">
                                    <i class="icon md-google-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="col-md-7">
                    <div class="tabs-page">
                        <ul class="nav-tabs" role="tablist">
                            <li class="active"><a href="#introduction" role="tab" data-toggle="tab">Introduction</a></li>
                            <li><a href="#outline" role="tab" data-toggle="tab">Outline</a></li>
                            <!-- <li><a href="#review" role="tab" data-toggle="tab">Review</a></li> -->
                            <li><a href="#student" role="tab" data-toggle="tab">Trainee</a></li>
                            <!-- <li><a href="#conment" role="tab" data-toggle="tab">Comment</a></li> -->
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- INTRODUCTION -->
                            <div class="tab-pane fade in active" id="introduction">
                                <?php echo $data_course[0]['course_description']; ?>
                            </div>
                            <!-- END / INTRODUCTION -->
    
                            <!-- OUTLINE -->
                            <div class="tab-pane fade" id="outline">
    
                                <!-- SECTION OUTLINE -->
                                
                                    <?php
                                        $j=1;
                                        $i=1;
                                        foreach ($data_curriculum as $curriculum) {
                                    ?>
                                            <div class="section-outline">
                                                <h4 class="tit-section xsm">Section <?php echo $i;?>: <?php echo $curriculum['name']?></h4>
                                                <ul class="section-list">
                                                <?php 
                                                    foreach ($data_curriculum_unit as $curriculum_unit) {
                                                        if ($curriculum_unit['curriculum_id'] == $curriculum['id']) {
                                                ?>
                                                            <li>
                                                                <?php 
                                                                    if ($curriculum_unit['type'] == 2) {
                                                                ?>
                                                                        <div class="count"><span><i class="icon md-search"></i></span></div>
                                                                <?php
                                                                    } else {
                                                                ?>
                                                                        <div class="count"><span><?php echo $j;?></span></div>
                                                                <?php
                                                                            $j++;
                                                                    }
                                                                ?>
                                                                <div class="list-body">
                                                                    <?php 
                                                                        if ($curriculum_unit['type'] == 1) {
                                                                            if ($curriculum_unit['content_type'] == 'video') {
                                                                    ?>
                                                                                <i class="icon md-camera"></i>
                                                                    <?php
                                                                            } elseif ($curriculum_unit['content_type'] == 'document') {
                                                                    ?>
                                                                                <i class="icon md-gallery-2"></i>
                                                                    <?php   
                                                                            }
                                                                        } elseif ($curriculum_unit['type'] == 2) {
                                                                    ?>
                                                                            <i class="icon md-files"></i>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                    <p><a href="#"><?php echo $curriculum_unit['topic'];?></a></p>
                                                                    <div class="data-lessons">
                                                                        <!-- <span>36:56</span> -->
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                    if ($curriculum_unit['is_free'] == 1) {
                                                                ?>
                                                                        <a href="<?php echo base_url();?>course/learning/<?php echo $curriculum_unit['unit_id'];?>/<?php echo $curriculum_unit['topic'];?>" class="mc-btn-2 btn-style-2">Preview</a>
                                                                <?php
                                                                    }
                                                                ?>
                                                            </li>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                                </ul>
                                            </div>
                                    <?php      
                                            $i++;
                                        }
                                    ?>
                                <!-- END / SECTION OUTLINE -->
                            </div>
                            <!-- END / OUTLINE -->
    
                            <!-- REVIEW -->
                            <div class="tab-pane fade" id="review">
                                <div class="total-review">
                                    <h3 class="md black">4 Reviews</h3>
                                    <div class="rating">
                                        <a href="#" class="active"></a>
                                        <a href="#" class="active"></a>
                                        <a href="#" class="active"></a>
                                        <a href="#"></a>
                                        <a href="#"></a>
                                    </div>
                                </div>  
                                <ul class="list-review">
                                    <li class="review">
                                        <div class="body-review">
                                            <div class="review-author">
                                                <a href="#">
                                                    <img src="<?php echo base_url();?>assets/theme/images/team-13.jpg" alt="">
                                                    <i class="icon md-email"></i>
                                                    <i class="icon md-user-plus"></i>
                                                </a>
                                            </div>
                                            <div class="content-review">
                                                <h4 class="sm black">
                                                    <a href="#">John Doe</a>
                                                </h4>
                                                <div class="rating">
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#"></a>
                                                    <a href="#"></a>
                                                </div>
                             
                                                <em>5 days ago</em>
                                                <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="review">
                                        <div class="body-review">
                                            <div class="review-author">
                                                <a href="#">
                                                    <img src="<?php echo base_url();?>assets/theme/images/team-13.jpg" alt="">
                                                    <i class="icon md-email"></i>
                                                    <i class="icon md-user-plus"></i>
                                                </a>
                                                <i class="icon"></i>
                                                <i class="icon"></i>
                                            </div>
                                            <div class="content-review">
                                                <h4 class="sm black">
                                                    <a href="#">John Doe</a>
                                                </h4>
                                                <div class="rating">
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#"></a>
                                                    <a href="#"></a>
                                                </div>
                                                <em>5 days ago</em>
                                                <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="review">
                                        <div class="body-review">
                                            <div class="review-author">
                                                <a href="#">
                                                    <img src="<?php echo base_url();?>assets/theme/images/team-13.jpg" alt="">
                                                    <i class="icon md-email"></i>
                                                    <i class="icon md-user-plus"></i>
                                                </a>
                                                <i class="icon"></i>
                                                <i class="icon"></i>
                                            </div>
                                            <div class="content-review">
                                                <h4 class="sm black">
                                                    <a href="#">John Doe</a>
                                                </h4>
                                                <div class="rating">
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#" class="active"></a>
                                                    <a href="#"></a>
                                                    <a href="#"></a>
                                                </div>
                                                <em>5 days ago</em>
                                                <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                            </div>
                                        </div>
                                    </li>                        
                                </ul>
                                <div class="load-more">
                                    <a href="">
                                    <i class="icon md-time"></i>
                                    Load more previous update</a>
                                </div>
                            </div>
                            <!-- END / REVIEW -->
    
                            <!-- STUDENT -->
                            <div class="tab-pane fade" id="student">
                                <h3 class="md black"><?php echo $course_members;?> Trainees applied</h3>
                                <div class="tab-list-student">
                                    <ul class="list-student">
                                        <?php 
                                            foreach ($data_users as $user) {
                                        ?>
                                                <!-- LIST STUDENT -->
                                                <li>
                                                    <div class="image">
                                                        <?php 
                                                            if (!empty($user['picture'])) {
                                                                $picture = $user['picture'];
                                                            } else {
                                                                $picture = "avatar.png";
                                                            }
                                                        ?>
                                                        <img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">
                                                    </div>
                                                    <div class="list-body">
                                                        <cite class="xsm"><a href="#"><?php echo $user['username'];?></a></cite>
                                                        <!-- <span class="address">Hanoi, Vietnam</span> -->
                                                    </div>
                                                </li>
                                        <!-- END / LIST STUDENT -->
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </div>
                                <div class="load-more">
                                    <a href="">
                                    <i class="icon md-time"></i>
                                    Load more previous update</a>
                                </div>
                            </div>
                            <!-- END / STUDENT -->
    
                            <!-- COMMENT -->
                            <div class="tab-pane fade" id="conment">
                                <div id="respond">
                                    <h3 class="md black">100 Comments</h3>
                                    <!-- <form method="post" action="<?php echo base_url();?>course/sentComment"> -->
                                        <div class="comment-form-comment">
                                            <textarea name="comment" placeholder="You have comment or question, write it here"></textarea>
                                        </div>
                                        <div class="form-submit">
                                            <input type="submit" value="Post" class="mc-btn-2 btn-style-2" id="post-comment">
                                        </div>
                                    <!-- </form> -->
                                </div>
                                <ul class="commentlist">
                                    <li class="comment">
                                        <div class="comment-body">
                                            <div class="comment-author">
                                                <a href="#">
                                                    <img src="<?php echo base_url();?>assets/theme/images/team-13.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="comment-content">
                                                <cite class="fn sm black bold"><a href="">John Doe</a></cite>
                                                <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                                
                                                <div class="comment-meta">
                                                   <a href="#">5 days ago</a>
                                                   <a href="#">Hide 2 replies</a>
                                                    <a href="#"><i class="icon md-arrow-up"></i>13</a>
                                                    <a href="#"><i class="icon md-arrow-down"></i>25</a>
                                                </div>
    
                                            </div>
                                        </div>
                                    </li>                           
                                </ul>
                                <div class="load-more">
                                    <a href="">
                                    <i class="icon md-time"></i>
                                    Load more previous update</a>
                                </div>
                            </div>
                            <!-- END / COMMENT -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE TOP -->

    <!-- FORM CHECKOUT -->
    <div class="form-checkout">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <!-- <form> -->
                        <ul id="bar">
                            <?php 
                                if (empty($email) and empty($name)) {
                            ?>
                                    <li class="active"><span class="count">1</span>Register</li>
                                    <li class=""><span class="count">2</span>Order and payment</li>
                                    <li class=""><span class="count">3</span>Finish checkout</li>
                            <?php
                                } else {
                            ?>
                                    <li class="active"><span class="count">1</span>Register</li>
                                    <li class="active"><span class="count">2</span>Order and payment</li>
                                    <li class=""><span class="count">3</span>Finish checkout</li>
                            <?php
                                }
                            ?>
                        </ul>
                        <span class="closeForm"><i class="icon md-close-1"></i></span>
                        <div class="form-body">
                            <!-- fieldsets -->
                            <?php 
                                if (empty($email) and empty($name)) {
                            ?>
                            <fieldset id="register">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-1">
                                            <h3 class="fs-title text-capitalize">sign in</h3>
                                            <div class="alert alert-danger" role="alert" style="display: none;">Email or password is not valid</div>
                                            <div class="form-email">
                                                <input type="text" name="email" id="email" placeholder="Email" value="">
                                            </div>
                                            <div class="form-password">
                                                <input type="password" name="password" id="password" placeholder="Password" value="">
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="check">
                                                <label for="check">
                                                <i class="icon md-check-2"></i>
                                                Remember me</label>
                                                <a href="#">Forget password?</a>
                                            </div>
                                            <div class="form-submit-1">
                                                <input type="button" value="Sign In and Continue" class="mc-btn btn-style-1 sign-in" style="margin-top: 0;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-2">
                                            <h3 class="fs-title text-capitalize">New Member</h3>
                                            <div class="form-firstname">
                                                <input type="text" placeholder="First name" />
                                            </div>
                                            <div class="form-lastname">
                                                <input type="text" placeholder="Last name" />
                                            </div>
                                            <div class="form-datebirth">
                                                <input type="text" placeholder="Date of Birth">
                                            </div>
                                            <div class="form-email">
                                                <input type="text" name="pass" placeholder="Annamolly@outlook.com" class="error">
                                                <span class="text-error">this email has been already taken</span>
                                            </div>
                                            <div class="form-password">
                                                <input type="password" name="pass" placeholder="Password" class="valid">
                                            </div>
                                            <div class="form-submit-1">
                                                <input type="button" value="Sign Up and Continue">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset id="payment">
                                <input type="text" id="id_course" value="<?php echo $data_course[0]['course_id']; ?>" style="display: none;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-1">
                                            <div class="mc-item mc-item-2">
                                                <div class="image-heading">
                                                    <?php 
                                                        if (!empty($data_course[0]['banner'])) {
                                                            $banner = 'upload/images/'.$data_course[0]['banner'];
                                                        } else {
                                                            $banner = "assets/theme/images/feature/img-1.jpg";
                                                        }
                                                    ?>
                                                    <div style="width: 270px; height: 160px; background-position: center center; background-size: cover; -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3); display: inline-block; background-image: url('../<?php echo $banner; ?>')"></div>
                                                </div>
                                                <div class="meta-categories"><a href="#"><?php echo $data_course[0]['category_name']; ?></a></div>
                                                <div class="content-item">
                                                    <div class="image-author">
                                                        <?php 
                                                            if (!empty($data_course[0]['picture'])) {
                                                                $picture = $data_course[0]['picture'];
                                                            } else {
                                                                $picture = 'avatar.png';
                                                            }
                                                        ?>
                                                        <img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">
                                                    </div>
                                                    <h4><a href="course-intro.html"><?php echo $data_course[0]['course_title']; ?></a></h4>
                                                    <div class="name-author">
                                                        By <a href="#"><?php echo $data_course[0]['username']; ?></a>
                                                    </div>
                                                </div>
                                                <div class="ft-item">
                                                    <div class="rating">
                                                        <a href="#" class="active"></a>
                                                        <a href="#" class="active"></a>
                                                        <a href="#" class="active"></a>
                                                        <a href="#"></a>
                                                        <a href="#"></a>
                                                    </div>
                                                    <div class="view-info">
                                                        <i class="icon md-users"></i>
                                                        <?php echo $course_members;?>
                                                    </div>
                                                    <div class="price">
                                                        <?php 
                                                            if ($data_course[0]['is_free'] == 0) {
                                                                echo 'IDR '.$data_course[0]['price'];
                                                            } elseif ($data_course[0]['is_free'] == 1) {
                                                                echo 'FREE';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-2">
                                            <!-- <h3 class="fs-title">Choose your payment method</h3>
                                            <ul class="pay">
                                                <li>
                                                    <input type="radio" name="pay" id="visa">
                                                    <label for="visa">
                                                        <i class="icon-radio"></i>
                                                        Visa / Master Card
                                                    </label>
                                                </li>
                                                <li>
                                                    <input type="radio" name="pay" id="paypal">
                                                    <label for="paypal">
                                                        <i class="icon-radio"></i>
                                                        Paypal
                                                    </label>
                                                </li>
                                                <li>
                                                    <input type="radio" name="pay" id="cash">
                                                    <label for="cash">
                                                        <i class="icon-radio"></i>
                                                        Cash
                                                    </label>
                                                </li>
                                            </ul>

                                            <div class="form-cardnumber">
                                                <label for="cardnumber">Card number</label>
                                                <input type="text" id="cardnumber">
                                            </div>

                                            <div class="form-expirydate">
                                                <label for="expirydate">Expiry date</label>
                                                <input type="text" id="expirydate">
                                                <input type="text">
                                            </div>

                                            <div class="form-code">
                                                <label for="code">Code</label>
                                                <input type="text" id="code">
                                            </div>

                                            <div class="clearfix"></div> -->

                                            <div class="form-total">
                                                <h4>Total Payment</h4>
                                                <?php 
                                                    if ($data_course[0]['is_free'] == 0) {
                                                        echo '<span class="price">IDR '.$data_course[0]['price'].'</span>';
                                                    } elseif ($data_course[0]['is_free'] == 1) {
                                                        echo '<span class="price">FREE</span>';
                                                    }
                                                ?>
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <div class="form-couponcode">
                                                <label for="couponcode">Coupon code</label>
                                                <input type="text" id="couponcode">
                                            </div>
                                            
                                            <div class="clearfix"></div>

                                            <div class="form-submit-1">
                                                <input type="button" value="Confirm and Finish" class="mc-btn btn-style-1 take-course">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <?php } else {
                            ?>
                            <fieldset id="register" style="opacity: 0; display: none;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-1">
                                            <h3 class="fs-title text-capitalize">sign in</h3>
                                            <div class="form-email">
                                                <input type="text" placeholder="Email">
                                            </div>
                                            <div class="form-password">
                                                <input type="password" placeholder="Password">
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" id="check">
                                                <label for="check">
                                                <i class="icon md-check-2"></i>
                                                Remember me</label>
                                                <a href="#">Forget password?</a>
                                            </div>
                                            <div class="form-submit-1">
                                                <input type="button" value="Sign In and Continue" class="mc-btn btn-style-1" style="margin-top: 0;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-2">
                                            <h3 class="fs-title text-capitalize">New Member</h3>
                                            <div class="form-firstname">
                                                <input type="text" placeholder="First name" />
                                            </div>
                                            <div class="form-lastname">
                                                <input type="text" placeholder="Last name" />
                                            </div>
                                            <div class="form-datebirth">
                                                <input type="text" placeholder="Date of Birth">
                                            </div>
                                            <div class="form-email">
                                                <input type="text" name="pass" placeholder="Annamolly@outlook.com" class="error">
                                                <span class="text-error">this email has been already taken</span>
                                            </div>
                                            <div class="form-password">
                                                <input type="password" name="pass" placeholder="Password" class="valid">
                                            </div>
                                            <div class="form-submit-1">
                                                <input type="button" value="Sign Up and Continue" class="mc-btn btn-style-1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset id="payment" style="display: block; left: 0%; opacity: 1;">
                                <input type="text" id="id_course" value="<?php echo $data_course[0]['course_id']; ?>" style="display: none;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-1" style="margin-left: 15px;">
                                            <div class="mc-item mc-item-2">
                                                <div class="image-heading">
                                                    <?php 
                                                        if (!empty($data_course[0]['banner'])) {
                                                            $banner = 'upload/images/'.$data_course[0]['banner'];
                                                        } else {
                                                            $banner = "assets/theme/images/feature/img-1.jpg";
                                                        }
                                                    ?>
                                                    <div style="width: 270px; height: 160px; background-position: center center; background-size: cover; -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3); display: inline-block; background-image: url('../<?php echo $banner; ?>')"></div>
                                                    <!--<img src="<?php echo base_url();?>assets/theme/images/feature/img-1.jpg" alt="">-->
                                                </div>
                                                <div class="meta-categories"><a href="#"><?php echo $data_course[0]['category_name']; ?></a></div>
                                                <div class="content-item">
                                                    <div class="image-author">
                                                        <?php 
                                                            if (!empty($data_course[0]['picture'])) {
                                                                $picture = $data_course[0]['picture'];
                                                            } else {
                                                                $picture = 'avatar.png';
                                                            }
                                                        ?>
                                                        <div style="width: 270px; height: 160px; background-position: center center; background-size: cover; -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3); display: inline-block; background-image: url('../<?php echo $banner; ?>')"></div>
                                                        <!--<img src="<?php //echo base_url();?>upload/images/<?php //echo $picture; ?>" alt="">-->
                                                    </div>
                                                    <h4><a href="course-intro.html"><?php echo $data_course[0]['course_title']; ?></a></h4>
                                                    <div class="name-author">
                                                        By <a href="#"><?php echo $data_course[0]['username']; ?></a>
                                                    </div>
                                                </div>
                                                <div class="ft-item">
                                                    <div class="rating">
                                                        <a href="#" class="active"></a>
                                                        <a href="#" class="active"></a>
                                                        <a href="#" class="active"></a>
                                                        <a href="#"></a>
                                                        <a href="#"></a>
                                                    </div>
                                                    <div class="view-info">
                                                        <i class="icon md-users"></i>
                                                        <?php echo $course_members;?>
                                                    </div>
                                                    <div class="price">
                                                        <?php 
                                                            if ($data_course[0]['is_free'] == 0) {
                                                                echo 'IDR '.$data_course[0]['price'];
                                                            } elseif ($data_course[0]['is_free'] == 1) {
                                                                echo 'FREE';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-2">
                                            <!-- <h3 class="fs-title">Choose your payment method</h3>
                                            <ul class="pay">
                                                <li>
                                                    <input type="radio" name="pay" id="visa">
                                                    <label for="visa">
                                                        <i class="icon-radio"></i>
                                                        Visa / Master Card
                                                    </label>
                                                </li>
                                                <li>
                                                    <input type="radio" name="pay" id="paypal">
                                                    <label for="paypal">
                                                        <i class="icon-radio"></i>
                                                        Paypal
                                                    </label>
                                                </li>
                                                <li>
                                                    <input type="radio" name="pay" id="cash">
                                                    <label for="cash">
                                                        <i class="icon-radio"></i>
                                                        Cash
                                                    </label>
                                                </li>
                                            </ul>

                                            <div class="form-cardnumber">
                                                <label for="cardnumber">Card number</label>
                                                <input type="text" id="cardnumber">
                                            </div>

                                            <div class="form-expirydate">
                                                <label for="expirydate">Expiry date</label>
                                                <input type="text" id="expirydate">
                                                <input type="text">
                                            </div>

                                            <div class="form-code">
                                                <label for="code">Code</label>
                                                <input type="text" id="code">
                                            </div>

                                            <div class="clearfix"></div> -->

                                            <div class="form-total">
                                                <h4>Total Payment</h4>
                                                <?php 
                                                    if ($data_course[0]['is_free'] == 0) {
                                                        echo '<span class="price">IDR '.$data_course[0]['price'].'</span>';
                                                    } elseif ($data_course[0]['is_free'] == 1) {
                                                        echo '<span class="price">FREE</span>';
                                                    }
                                                ?>
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <div class="form-couponcode">
                                                <label for="couponcode">Coupon code</label>
                                                <input type="text" id="couponcode">
                                            </div>
                                            
                                            <div class="clearfix"></div>

                                            <div class="form-submit-1">
                                                <input type="button" value="Confirm and Finish" class="mc-btn btn-style-1 take-course">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <?php
                            } 
                            ?>
                            

                            <fieldset id="finish">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-1">
                                            <div class="mc-item mc-item-2">
                                                <div class="image-heading">

                                                    <img src="<?php echo base_url();?>assets/theme/images/feature/img-1.jpg" alt="">
                                                </div>
                                                <div class="meta-categories"><a href="#"><?php echo $data_course[0]['category_name']; ?></a></div>
                                                <div class="content-item">
                                                    <div class="image-author">
                                                        <?php 
                                                            if (!empty($data_course[0]['picture'])) {
                                                                $picture = $data_course[0]['picture'];
                                                            } else {
                                                                $picture = 'avatar.png';
                                                            }
                                                        ?>
                                                        <img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">
                                                    </div>
                                                    <h4><a href="course-intro.html"><?php echo $data_course[0]['course_title']; ?></a></h4>
                                                    <div class="name-author">
                                                        By <a href="#"><?php echo $data_course[0]['username']; ?></a>
                                                    </div>
                                                </div>
                                                <div class="ft-item">
                                                    <div class="rating">
                                                        <a href="#" class="active"></a>
                                                        <a href="#" class="active"></a>
                                                        <a href="#" class="active"></a>
                                                        <a href="#"></a>
                                                        <a href="#"></a>
                                                    </div>
                                                    <div class="view-info">
                                                        <i class="icon md-users"></i>
                                                        <?php echo $course_members;?>
                                                    </div>
                                                    <div class="price">
                                                        <?php 
                                                            if ($data_course[0]['is_free'] == 0) {
                                                                echo 'IDR '.$data_course[0]['price'];
                                                            } elseif ($data_course[0]['is_free'] == 1) {
                                                                echo 'FREE';
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <input type="text" name="course_id" value="<?php echo $data_course[0]['course_id']?>" style="display: none;"> -->
                                        <div class="form-2">
                                            <!-- <form method="post" action="<?php echo base_url();?>course/learn/<?php echo $data_course[0]['course_id']?>/<?php echo $data_course[0]['course_title']?>"> -->
                                                <h3 class="fs-title">Thank You For Your Purchase</3>
                                                <!-- <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci.</p> -->

                                                <div class="widget widget_share">
                                                    <h4>Share</h4>
                                                    <div class="share-body">
                                                        <a href="#" class="twitter" title="twitter">
                                                            <i class="icon md-twitter"></i>
                                                        </a>
                                                        <a href="#" class="pinterest" title="pinterest">
                                                            <i class="icon md-pinterest-1"></i>
                                                        </a>
                                                        <a href="#" class="facebook" title="facebook">
                                                            <i class="icon md-facebook-1"></i>
                                                        </a>
                                                        <a href="#" class="google-plus" title="google plus">
                                                            <i class="icon md-google-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="form-submit-1">
                                                    <a href="<?php echo base_url();?>course/learn/<?php echo $data_course[0]['course_id']?>/<?php echo $data_course[0]['course_title']?>" class="mc-btn btn-style-1">Start Learning</a>
                                                    <!-- <input type="submit" value="Start Learning" class="mc-btn btn-style-1"> -->
                                                </div>
                                            <!-- </form>
                                        </div> -->
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
    <!-- END / FORM CHECKOUT -->
    
	<!--
    <section id="course-concern" class="course-concern">
        <div class="container">
            <h3 class="md black">Courses you may concern</h3>
            <div class="row">
                <div class="col-xs-6 col-sm-4 col-md-3">
                    
                    <div class="mc-item mc-item-2">
                        <div class="image-heading">
                            <img src="<?php echo base_url();?>assets/theme/images/feature/img-1.jpg" alt="">
                        </div>
                        <div class="meta-categories"><a href="#">Web design</a></div>
                        <div class="content-item">
                            <div class="image-author">
                                <img src="<?php echo base_url();?>assets/theme/images/avatar-1.jpg" alt="">
                            </div>
                            <h4><a href="course-intro.html">The Complete Digital Photography Course Amazon Top Seller</a></h4>
                            <div class="name-author">
                                By <a href="#">Name of Mr or Mrs</a>
                            </div>
                        </div>
                        <div class="ft-item">
                            <div class="rating">
                                <a href="#" class="active"></a>
                                <a href="#" class="active"></a>
                                <a href="#" class="active"></a>
                                <a href="#"></a>
                                <a href="#"></a>
                            </div>
                            <div class="view-info">
                                <i class="icon md-users"></i>
                                2568
                            </div>
                            <div class="comment-info">
                                <i class="icon md-comment"></i>
                                25
                            </div>
                            <div class="price">
                                $190
                                <span class="price-old">$134</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
    
                <div class="col-xs-6 col-sm-4 col-md-3">
                    
                    <div class="mc-item mc-item-2">
                        <div class="image-heading">
                            <img src="<?php echo base_url();?>assets/theme/images/feature/img-1.jpg" alt="">
                        </div>
                        <div class="meta-categories"><a href="#">Web design</a></div>
                        <div class="content-item">
                            <div class="image-author">
                                <img src="<?php echo base_url();?>assets/theme/images/avatar-1.jpg" alt="">
                            </div>
                            <h4><a href="course-intro.html">The Complete Digital Photography Course Amazon Top Seller</a></h4>
                            <div class="name-author">
                                By <a href="#">Name of Mr or Mrs</a>
                            </div>
                        </div>
                        <div class="ft-item">
                            <div class="rating">
                                <a href="#" class="active"></a>
                                <a href="#" class="active"></a>
                                <a href="#" class="active"></a>
                                <a href="#"></a>
                                <a href="#"></a>
                            </div>
                            <div class="view-info">
                                <i class="icon md-users"></i>
                                2568
                            </div>
                            <div class="comment-info">
                                <i class="icon md-comment"></i>
                                25
                            </div>
                            <div class="price">
                                $190
                                <span class="price-old">$134</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
    
                <div class="col-xs-6 col-sm-4 col-md-3">
                    
                    <div class="mc-item mc-item-2">
                        <div class="image-heading">
                            <img src="<?php echo base_url();?>assets/theme/images/feature/img-1.jpg" alt="">
                        </div>
                        <div class="meta-categories"><a href="#">Web design</a></div>
                        <div class="content-item">
                            <div class="image-author">
                                <img src="<?php echo base_url();?>assets/theme/images/avatar-1.jpg" alt="">
                            </div>
                            <h4><a href="course-intro.html">The Complete Digital Photography Course Amazon Top Seller</a></h4>
                            <div class="name-author">
                                By <a href="#">Name of Mr or Mrs</a>
                            </div>
                        </div>
                        <div class="ft-item">
                            <div class="rating">
                                <a href="#" class="active"></a>
                                <a href="#" class="active"></a>
                                <a href="#" class="active"></a>
                                <a href="#"></a>
                                <a href="#"></a>
                            </div>
                            <div class="view-info">
                                <i class="icon md-users"></i>
                                2568
                            </div>
                            <div class="comment-info">
                                <i class="icon md-comment"></i>
                                25
                            </div>
                            <div class="price">
                                $190
                                <span class="price-old">$134</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
    
                <div class="col-xs-6 col-sm-4 col-md-3">
                    
                    <div class="mc-item mc-item-2">
                        <div class="image-heading">
                            <img src="<?php echo base_url();?>assets/theme/images/feature/img-1.jpg" alt="">
                        </div>
                        <div class="meta-categories"><a href="#">Web design</a></div>
                        <div class="content-item">
                            <div class="image-author">
                                <img src="<?php echo base_url();?>assets/theme/images/avatar-1.jpg" alt="">
                            </div>
                            <h4><a href="course-intro.html">The Complete Digital Photography Course Amazon Top Seller</a></h4>
                            <div class="name-author">
                                By <a href="#">Name of Mr or Mrs</a>
                            </div>
                        </div>
                        <div class="ft-item">
                            <div class="rating">
                                <a href="#" class="active"></a>
                                <a href="#" class="active"></a>
                                <a href="#" class="active"></a>
                                <a href="#"></a>
                                <a href="#"></a>
                            </div>
                            <div class="view-info">
                                <i class="icon md-users"></i>
                                2568
                            </div>
                            <div class="comment-info">
                                <i class="icon md-comment"></i>
                                25
                            </div>
                            <div class="price">
                                $190
                                <span class="price-old">$134</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    -->

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/vendor/sweetalert/lib/sweet-alert.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/vendor/sweetalert/lib/sweet-alert.min.js"></script>

<?php echo $footer;?>
<script>
var current_fs, next_fs, previous_fs;
var left, opacity, scale;
var animating;

$(".take-course").click(function(){
    var couponcode = $("#couponcode").val();
    var course_id = $("#id_course").val();
    var course_price = $("#price-course").val();

    if (course_price != "FREE") {
        if (couponcode != "") {
            $.post("<?php echo base_url();?>course/takeCourse",
                {
                    couponcode : couponcode,
                    course_id : course_id
                },
                function(data) {
                    var result = $.parseJSON(data);
                    
                    if (result == 1) {
                        //alert("berhasil");
                        swal("Take course", "Success", "success");

                        $(".take-this-course").hide();

                        current_fs = $(this).closest('fieldset');
                        next_fs = $(this).closest('fieldset').next();
                        
                        $(".form-checkout #bar li").eq($("fieldset").index(next_fs)).addClass("active");

                        $("#payment").css("display", "none");
                        $("#payment").css("opacity", "0");

                        $("#finish").css("display", "block");
                        $("#finish").css("opacity", "1");
                        $("#finish").css("left", "0%");
                    } else if(result == 2) {
                        //alert("nilai voucher anda tidak cukup");
                        swal("Sorry...", "Your voucher balance is not enough!", "error");
                    } else if (result == 0) {
                        //alert("Voucher tidak valid");
                        swal("Sorry...", "Your voucher balance is not valid!", "error");
                    }
                }
            );
        } else {
            //alert("insert coupon voucher number");
            swal("Oops...", "Please fill your coupon number!", "warning");
        }
    } else {
        $.post("<?php echo base_url();?>course/takeFreeCourse",
            {
                course_id : course_id
            },
            function(data) {
                var result = $.parseJSON(data);
                
                if (result == 1) {
                    //alert("berhasil");
                    swal("Take course", "Success", "success");

                    $(".take-this-course").hide();

                    current_fs = $(this).closest('fieldset');
                    next_fs = $(this).closest('fieldset').next();
                    
                    $(".form-checkout #bar li").eq($("fieldset").index(next_fs)).addClass("active");

                    $("#payment").css("display", "none");
                    $("#payment").css("opacity", "0");

                    $("#finish").css("display", "block");
                    $("#finish").css("opacity", "1");
                    $("#finish").css("left", "0%");
                } else {
                    //alert("Transaksi gagal");
                    swal("Sorry...", "Your transaction is failed. Please try again in several minutes!", "error");
                }
            }
        );
    }
});

$(".sign-in").click(function(){
    $.post("<?php echo base_url();?>user/ajaxLogin",
        {
            email : $("#email").val(),
            password : $("#password").val()
        },
        function(data) {
            var arrayAnggota = $.parseJSON(data);
            
            if (arrayAnggota == true) {
                current_fs = $(this).closest('fieldset');
                next_fs = $(this).closest('fieldset').next();

                $(".form-checkout #bar li").eq($("fieldset").index(next_fs)+2).addClass("active");
                
                $("#register").css("display", "none");
                $("#register").css("opacity", "0");

                $("#payment").css("display", "block");
                $("#payment").css("opacity", "1");
                $("#payment").css("left", "0%");
            } else {
                $("#email").addClass("error");
                $("#password").addClass("error");
                $(".alert-danger").show();
            }
        }
    );
});
</script>