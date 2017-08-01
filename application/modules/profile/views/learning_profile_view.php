<?php echo $header;?>
<?php echo $profile_header;?>
    <section class="content-bar">
        <div class="container">
            <ul>
                <li class="current">
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
            <div class="row">
                <?php 
                    if (!empty($learning_course)) {
                        for ($i=0; $i<count($learning_course); $i++) {
                        ?>
                            <div class="col-xs-6 col-sm-4 col-md-3">
                                <!-- MC ITEM -->
                                <div class="mc-learning-item mc-item mc-item-2">
                                    <div class="image-heading">
                                        <?php 
                                            if (!empty($learning_course[$i]->banner)) {
                                                $banner = "upload/images/".$learning_course[$i]->banner;
                                            } else {
                                                $banner = "assets/theme/images/feature/img-1.jpg";
                                            }
                                        ?>
                                        <div style="width: 270px; height: 160px; background-position: center center; background-size: cover; -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3); display: inline-block; background-image: url('../<?php echo $banner; ?>')"></div>
                                    </div>
                                    <div class="meta-categories"><a href="#"><?php echo $learning_course[$i]->category_name; ?></a></div>
                                    <div class="content-item">
                                        <div class="image-author">
                                            <?php 
                                                for ($j=0; $j<count($data_added_users); $j++) {
                                                    if ($data_added_users[$j]['course_id'] == $learning_course[$i]->course_id) {
                                                        if (!empty($data_added_users[$j]['user_added_picture'])) {
                                                            $picture = $data_added_users[$j]['user_added_picture'];
                                                        } else {
                                                            $picture = "avatar.png";
                                                        }
                                            ?>
                                                        <img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div>
										<!--
                                        <h4><a href="course-intro.html"><?php echo $learning_course[$i]->course_name; ?></a></h4>
										-->
										<h4><?php echo $learning_course[$i]->course_name; ?></h4>
                                        <div class="name-author">
                                            <?php 
                                                for ($j=0; $j<count($data_added_users); $j++) {
                                                    if ($data_added_users[$j]['course_id'] == $learning_course[$i]->course_id) {
                                            ?>
                                                        By <a href="#"><?php echo $data_added_users[$j]['user_added_name']; ?></a>
                                            <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <?php 
                                        foreach ($learn_progress as $progress) {
                                            if ($progress['course_id'] == $learning_course[$i]->course_id) {
                                    ?>
                                                <div class="ft-item">
                                                    <div class="percent-learn-bar">
                                                        <div class="percent-learn-run"></div>
                                                    </div>
                                                    <input type="text" id="progress" value="<?php echo $progress['progress']; ?>" style="display: none;">
                                                    <div class="percent-learn"><?php echo $progress['progress']; ?>%<i class="fa fa-trophy"></i></div>
                                                    <a href="<?php echo base_url();?>course/learn/<?php echo $learning_course[$i]->course_id;?>/<?php echo $learning_course[$i]->course_name;?>" class="learnnow">Learn Now<i class="fa fa-play-circle-o"></i></a>
                                                </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                                <!-- END / MC ITEM -->
                            </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- END / COURSE CONCERN -->
<?php echo $footer;?>
<script>
$(document).ready(function(){
    var progress = $("#progress").val();
    $("#percent-learn-run").css("width", progress+'%');
});
</script>