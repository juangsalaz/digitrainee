<?php echo $header;?>
<?php echo $profile_header;?>
<section class="content-bar">
        <div class="container">
            <ul>
                <li>
                    <a href="<?php echo base_url();?>profile/learning">
                        <i class="icon md-book-1"></i>
                        Learning
                    </a>
                </li>
                <li class="current">
                    <a href="<?php echo base_url();?>profile/teaching">
                        <i class="icon md-people"></i>
                        Teaching
                    </a>
                </li>
                <!-- <li>
                    <a href="account-assignment.html">
                        <i class="icon md-shopping"></i>
                        Assignment
                    </a>
                </li> -->
                <?php 
                    if (empty($email) and empty($email)) {
                ?>
                        <li>
                            <a href="<?php echo base_url();?>profile/guest">
                                <i class="icon md-user-minus"></i>
                                Profile
                            </a>
                        </li>
                <?php 
                    } else {
                ?>
                        <li>
                            <a href="<?php echo base_url();?>profile">
                                <i class="icon md-user-minus"></i>
                                Profile
                            </a>
                        </li>
                <?php
                    }
                ?>
               <!--  <li>
                    <a href="account-inbox.html">
                        <i class="icon md-email"></i>
                        Inbox
                    </a>
                </li> -->
            </ul>
        </div>
    </section>
<!-- COURSE CONCERN -->
    <section id="course-concern" class="course-concern">
        <div class="container">
            
            <div class="price-course">
                <!-- <i class="icon md-database"></i> -->
                <!-- <h3>Available Balance</h3>
                <span>IDR 0</span> -->
                
                <div class="create-coures">
                    <a href="<?php echo base_url();?>course/bTeacher" class="mc-btn btn-style-1">Create New Course</a>
                    <!-- <a href="#" class="mc-btn btn-style-5">Request Payment</a> -->
                </div>

            </div>
            <div class="row">
                <?php
                foreach ($courses as $course) {
                    ?>
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <!-- MC ITEM -->
                        <div class="mc-teaching-item mc-item mc-item-2">
                            <div class="image-heading">
                                <?php 
                                    if (!empty($course['banner'])) {
                                        $banner = 'upload/images/'.$course['banner'];
                                    } else {
                                        $banner = "assets/theme/images/feature/img-1.jpg";
                                    }
                                ?>
                                <div style="width: 270px; height: 160px; background-position: center center; background-size: cover; -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3); display: inline-block; background-image: url('../<?php echo $banner; ?>')"></div>
                            </div>
                            <div class="meta-categories"><a href="#"><?php echo $course['category_name']; ?></a></div>
                            <div class="content-item">
                                <div class="image-author">
                                    <?php 
                                        if (!empty($course['picture'])) {
                                            $picture = $course['picture'];
                                        } else {
                                            $picture = "avatar.png";
                                        }
                                    ?>
                                    <img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">
                                </div>
                                <!--<h4><a href="#"><?php echo $course['title']; ?></a></h4>-->
								<h4><?php echo $course['title']; ?></h4>
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
                                    <?php 
                                        if (!empty($array_member)) {
                                            for ($j=0; $j<count($array_member); $j++) {
                                                if ($array_member[$j]['course_id'] == $course['id']) {
                                                    if (!empty($array_member[$j]['course_member'])) {
                                                        echo $array_member[$j]['course_member'];
                                                    } else {
                                                        echo 0;
                                                    }
                                                }
                                            }
                                        } else {
                                            echo 0;
                                        }
                                    ?>
                                </div>
                                <div class="price">
                                    <?php 
                                    if ($course['is_free']) {
                                        echo 'Free';
                                    } else {
                                        echo 'Rp. '.number_format($course['price']);
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="edit-view">
                                <a href="<?php echo base_url();?>course/cBasicInfo?c=<?php echo $course['id']; ?>" class="edit">Edit</a>
                                <a href="<?php echo base_url();?>course/detail/<?php echo $course['id']; ?>/<?php echo str_replace(' ', '_', $course['title']); ?>" class="view">View</a>
                                <?php 
                                if ($course['status'] == '1') {
                                    echo '<span class="label label-default">Draft</span>';
                                } elseif ($course['status'] == '2') {
                                    echo '<span class="label label-warning">Waiting Approval</span>';
                                } elseif ($course['status'] == '3') {
                                    echo '<span class="label label-success">Published</span>';
                                } elseif ($course['status'] == '4') {
                                    echo '<span class="label label-success">Rejected</span>';
                                }
                                ?>
                            </div>
                        </div>
                        <!-- END / MC ITEM -->
                    </div>
                    <?php
                }
                ?>
                
            </div>
        </div>
    </section>
    <!-- END / COURSE CONCERN -->
<?php echo $footer;?>