<?php echo $header;?>
    <div class="overlay"></div>
    <div id="spinner"></div>
	<!-- SUB BANNER -->
    <section class="sub-banner sub-banner-course">
        <div class="awe-static bg-sub-banner-course"></div>
        <div class="container">
            <div class="sub-banner-content">
                <h2 class="text-center"><?php echo $data_course[0]['course_title']; ?></h2>
                <input type="text" id="course_id" value="<?php echo $data_course[0]['course_id']; ?>" style="display: none;">
                <input type="text" id="user_name" value="<?php echo $user_name; ?>" style="display: none;">
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
                        <!-- CURRENT PROGRESS -->
                        <div class="current-progress">
                            <h4 class="sm black">Current Progress</h4>
                            <input id="progress" value="<?php echo $learn_progress; ?>" style="display: none;">
                            <div class="percent">Complete <span class="count"><?php echo $learn_progress; ?>%</span></div>
                            <div class="progressbar">
                                <div class="progress-run"></div>
                            </div>
                            <ul class="current-outline">
                                <li><span><?php echo count($data_curriculum);?></span>section</li>
                                <li><span><?php echo $total_unit;?></span>units</li>
                                <?php 
                                    if ($total_quiz != 0) {
                                ?>
                                        <li><span><?php echo $total_quiz;?></span>quizzes</li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                        <!-- END / CURRENT PROGRESS -->
    
                        <div class="video-course-intro">
                            <h4 class="xsm black bold">Live Course Schedule</h4>

                            <?php if (count($livecourseSchedules) > 0)  {
                                ?>
                                <table class="schedule-table">
                                    <tbody>
                                        <?php foreach ($livecourseSchedules as $schedule) {
                                            echo '<tr>';
                                                $seatAvailable = 30 - $schedule['user_booking_cnt'];
                                                $available = $seatAvailable > 0 ? $seatAvailable.' seat available' : 'Full';
                                                echo '<td>'.$schedule['unit_name'].' <br /><small>('.$available.')</small></td>';
                                                echo '<td>'.$schedule['course_date_str'].'</td>';
                                                $disabled = ($schedule['unit_cnt'] == $schedule['unit_learned_cnt']) ? '' : 'disabled';

                                                echo '<td>';
                                                    if ($schedule['booking_id'] == '') {
                                                        echo '<a href="'.base_url().'course/bookingSchedule?bid='.$schedule['course_id'].';'.$data_course[0]['course_title'].';'.$schedule['id'].'" class="btn btn-sm btn-primary" '.$disabled.'>Book</a>';
                                                    } else {
                                                        echo '<button class="btn btn-sm btn-success" '.$disabled.'><i class="fa fa-check"></i></button>';
                                                    }
                                                echo '</td>';
                                            echo '</tr>';
                                        }?>
                                    </tbody>
                                </table>
                                <?php
                            }?>

                            <!--
                            <form method="post" action="<?php echo base_url();?>course/setScheduleLiveCourse">
                            <?php 
                                foreach ($data_schedule_title as $schedule_title) {
                                    $current = $schedule_title['title'];
                            ?>
                                    <div class="form-group">
                                        <div class="form-inline">
                                                <input type="text" name="course_id" value="<?php echo $data_course[0]['course_id']; ?>" style="display: none;">
                                                <input type="text" name="course_title" value="<?php echo $data_course[0]['course_title']; ?>" style="display: none;">
                                                <label for=""><?php echo $schedule_title['title'];?></label>
                                                <select class="form-control" name="<?php echo $schedule_title['title'];?>">
                                                    <option>Choose Schedule</option>
                                                    <?php 
                                                        foreach ($data_schedule as $schedule) {
                                                            if ($schedule['title'] == $current) {
                                                                if (!empty($data_user_schedule)) {
                                                                    foreach ($data_user_schedule as $user_schedule) {
                                                                        if ($user_schedule['schedule_id'] == $schedule['id']) {
                                                    ?>
                                                                            <option value="<?php echo $schedule['id'];?>" selected="selected"><?php echo $schedule['course_date'];?>, <?php echo $schedule['course_time'];?> (Open)</option>                            
                                                    <?php
                                                                        }
                                                                    }
                                                                } else {
                                                    ?>
                                                                    <option value="<?php echo $schedule['id'];?>"><?php echo $schedule['course_date'];?>, <?php echo $schedule['course_time'];?> (Open)</option>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                                <input type="submit" value="Submit">
                            </form>
                            -->
                        </div>
                        <hr class="line">
                        <div class="about-instructor">
                            <h4 class="xsm black bold">About Trainer</h4>
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
                            <?php 
                                if (isset($discussion_id)) {
                            ?>
                                    <li><a href="#outline" role="tab" data-toggle="tab">Outline</a></li>
                                    <!-- <li class="itemnew"><a href="#announcement" role="tab" data-toggle="tab">Announcement</a></li> -->
                                    <li class="active"><a href="#discussion" role="tab" data-toggle="tab">Discussion</a></li>
                                    <!-- <li><a href="#review" role="tab" data-toggle="tab">Review</a></li> -->
                                    <li><a href="#student" role="tab" data-toggle="tab">Trainee</a></li>
                                    <!-- <li><a href="#updatelog" role="tab" data-toggle="tab">Update Log</a></li> -->
                            <?php
                                } else {
                            ?>
                                    <li class="active"><a href="#outline" role="tab" data-toggle="tab">Outline</a></li>
                                    <!-- <li class="itemnew"><a href="#announcement" role="tab" data-toggle="tab">Announcement</a></li> -->
                                    <li><a href="#discussion" role="tab" data-toggle="tab">Discussion</a></li>
                                    <!-- <li><a href="#review" role="tab" data-toggle="tab">Review</a></li> -->
                                    <li><a href="#student" role="tab" data-toggle="tab">Trainee</a></li>
                                    <!-- <li><a href="#updatelog" role="tab" data-toggle="tab">Update Log</a></li> -->
                            <?php
                                }
                            ?>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <?php 
                                if (isset($discussion_id)) {
                            ?>
                                    <div class="tab-pane fade" id="outline">
                            <?php
                                } else {
                            ?>
                                    <div class="tab-pane fade in active" id="outline">
                            <?php
                                }
                            ?>
                            <!-- OUTLINE -->
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
                                                			<?php 
                                                                if ($curriculum_unit['learned_mark'] == 1) {
                                                            ?>
                                                                    <li class="o-view">
                                                            <?php        
                                                                } else {
                                                            ?>
                                                                    <li>
                                                            <?php
                                                                }
                                                            ?>
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
        					                                                <p>
                                                                                <?php 
                                                                                    if ($curriculum_unit['type'] == 1) {
                                                                                ?>
                                                                                        <a href="<?php echo base_url();?>course/learning/<?php echo $curriculum_unit['unit_id'];?>/<?php echo $curriculum_unit['topic'];?>">
                                                                                <?php
                                                                                    } elseif ($curriculum_unit['type'] == 2) {
                                                                                ?>
                                                                                        <a href="<?php echo base_url();?>quiz/intro/<?php echo $curriculum_unit['quiz_id'];?>/<?php echo $curriculum_unit['topic'];?>">
                                                                                <?php
                                                                                    }
                                                                                ?>
                                                                                
                                                                                    <?php echo $curriculum_unit['topic'];?>
                                                                                </a>
                                                                            </p>
        					                                                <div class="div-x"><i class="icon md-check-2"></i></div>
        					                                                <div class="line"></div>
        					                                            </div>
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
                            </div>
                            <!-- END / OUTLINE -->
    
                            <!-- ANNOUNCEMENT -->
                            <div class="tab-pane fade" id="announcement">
                                <ul class="list-announcement">
    
                                    <!-- LIST ITEM -->
                                    <li>
                                        <div class="list-body">
                                            <i class="icon md-flag"></i>
                                            <div class="list-content">
                                                <h4 class="sm black bold">
                                                    <a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a>
                                                </h4>
                                                <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                                <div class="author">By <a href="#">Name of Mr or Mrs</a></div>
                                                <em>5 days ago</em>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END / LIST ITEM -->
    
                                    <!-- LIST ITEM -->
                                    <li>
                                        <div class="list-body">
                                            <i class="icon md-flag"></i>
                                            <div class="list-content">
                                                <h4 class="sm black bold">
                                                    <a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a>
                                                </h4>
                                                <div class="video embed-responsive embed-responsive-16by9">
                                                    <iframe src="//player.vimeo.com/video/90884823" class="embed-responsive-item">
                                                    </iframe>
                                                </div>
                                                <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                                <div class="author">By <a href="#">Name of Mr or Mrs</a></div>
                                                <em>5 days ago</em>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END / LIST ITEM -->
    
                                    <!-- LIST ITEM -->
                                    <li>
                                        <div class="list-body">
                                            <i class="icon md-flag"></i>
                                            <div class="list-content">
                                                <h4 class="sm black bold">
                                                    <a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a>
                                                </h4>
                                                <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                                <div class="author">By <a href="#">Name of Mr or Mrs</a></div>
                                                <em>5 days ago</em>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END / LIST ITEM -->
                                </ul>
                            </div>
                            <!-- END / ANNOUNCEMENT -->
                            
                            <?php 
                                if (isset($discussion_id)) {
                            ?>
                                    <!-- DISCUSSION -->
                                    <div class="tab-pane fade in active" id="discussion">
                                        <ul class="list-discussion">
                                            <li>
                                                <div class="list-body" style="padding-bottom: 10px;">
                                                    <div class="image">
                                                        <?php 
                                                            if (!empty($data_discussion_by_id[0]['picture'])) {
                                                                $picture = $data_discussion_by_id[0]['picture'];
                                                            } else {
                                                                $picture = "avatar.png";
                                                            }
                                                        ?>
                                                        <img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">
                                                    </div>
                                                    <div class="list-content">
                                                        <cite class="xsm black bold"><a href="#"><?php echo $data_discussion_by_id[0]['username'];?></a></cite>
                                                        <h4 class="md black"><?php echo $data_discussion_by_id[0]['topic'];?></h4>
                                                        <div style="text-align: justify;">
                                                            <?php echo $data_discussion_by_id[0]['content'];?>
                                                        </div>
                                                        <div class="comment-meta" style="margin-top: 5px;">
                                                           <a href="#">5 days ago</a>
                                                           <!-- <a href="<?php echo base_url();?>course/learn/<?php echo $data_course[0]['course_id']; ?>/<?php echo $discussion['id'];?>/<?php echo $data_course[0]['course_title']; ?>"><i class="icon md-back"></i>0 replies</a> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <?php 
                                            foreach ($data_comment_discussion as $comment_discussion) {
                                        ?>
                                                 <ul class="list-discussion">
                                                    <li>
                                                        <div class="list-body" style="padding:10px 0 10px 40px;">
                                                            <div class="image">
                                                                <?php 
                                                                    if (!empty($comment_discussion['picture'])) {
                                                                        $picture = $comment_discussion['picture'];
                                                                    } else {
                                                                        $picture = "avatar.png";
                                                                    }
                                                                ?>
                                                                <img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">
                                                            </div>
                                                            <div class="list-content">
                                                                <cite class="xsm black bold"><a href="#"><?php echo $comment_discussion['username'];?></a></cite>
                                                                <div style="text-align: justify;">
                                                                    <?php echo $comment_discussion['comment'];?>
                                                                </div>
                                                                <div class="comment-meta" style="margin-top: 5px;">
                                                                   <a href="#">1 minutes ago</a>
                                                                   <!-- <a href="<?php echo base_url();?>course/learn/<?php echo $data_course[0]['course_id']; ?>/<?php echo $discussion['id'];?>/<?php echo $data_course[0]['course_title']; ?>"><i class="icon md-back"></i>0 replies</a> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                        <?php
                                            }
                                        ?>
                                        <div class="form-discussion">
                                            <form method="post" action="<?php echo base_url();?>course/saveCommentDiscussion">
                                                <input type="text" name="course_id" value="<?php echo $data_course[0]['course_id']; ?>" style="display: none;">
                                                <input type="text" name="discussion_id" value="<?php echo $data_discussion_by_id[0]['id'];?>" style="display: none;">
                                                <input type="text" name="course_title" value="<?php echo $data_course[0]['course_title']; ?>" style="display: none;">
                                                <div class="post-editor text-form-editor">
                                                    <textarea id="discussion-content" name="discussion-content" placeholder="Comment content"></textarea>
                                                </div>
                                                <div class="form-submit">
                                                    <a href="<?php echo base_url();?>course/learn/<?php echo $data_course[0]['course_id']; ?>/<?php echo $data_course[0]['course_title']; ?>" class="btn btn-xs btn-warning">Back</a>
                                                    <input type="submit" id="submit-comment" value="Post" class="mc-btn-2 btn-style-2">
                                                </div>
                                            </form>
                                        </div>

                                        <!-- <ul class="list-discussion">
                                            <div id="list-discussion-view"></div>
                                            
                                        <div class="load-more">
                                            <a href="">
                                            <i class="icon md-time"></i>
                                            Load more previous update</a>
                                        </div> -->
                                    </div>
                            <?php
                                } else {
                            ?>
                                    <!-- DISCUSSION -->
                                    <div class="tab-pane fade" id="discussion">
                                    
                                        <div class="alert alert-success" role="alert">
                                            <strong>Great!</strong> Your discussion topic has been added.
                                        </div>

                                        <div class="alert alert-warning" role="alert">
                                            <strong>Ops!</strong> Topic title and content can't empty.
                                        </div>
                                        <h3 class="md black"><span id="topics_count"><?php echo count($data_discussion);?></span> Topics</h3>
                                        <div class="form-discussion">
                                            <div class="text-title">
                                                <input type="text" name="topic-title" id="topic-title" placeholder="Topic title here">
                                            </div>
                                            <div class="post-editor text-form-editor">
                                                <textarea id="discussion-content" name="discussion-content" placeholder="Discussion content"></textarea>
                                            </div>
                                            <div class="form-submit">
                                                <input type="button" id="submit-discussion" value="Post" class="mc-btn-2 btn-style-2">
                                            </div>
                                        </div>

                                        <ul class="list-discussion">
                                            <div id="list-discussion-view"></div>
                                            <!-- LIST ITEM -->
                                            <?php 
                                                foreach ($data_discussion as $discussion) {
                                            ?>
                                                    <li>
                                                        <div class="list-body">
                                                            <div class="image">
                                                                <?php 
                                                                    if (!empty($discussion['picture'])) {
                                                                        $picture = $discussion['picture'];
                                                                    } else {
                                                                        $picture = "avatar.png";
                                                                    }
                                                                ?>
                                                                <img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">
                                                            </div>
                                                            <div class="list-content">
                                                                <cite class="xsm black bold"><a href="#"><?php echo $discussion['username'];?></a></cite>
                                                                <h4 class="md black"><?php echo $discussion['topic'];?></h4>
                                                                <div class="comment-meta">
                                                                   <a href="#">One munites ago</a>
                                                                   <?php
                                                                        if (isset($array_comment)) {
                                                                            foreach ($array_comment as $comment) {
                                                                                if ($comment['discussion_id'] == $discussion['id']) {
                                                                    ?>
                                                                                <a href="<?php echo base_url();?>course/learn/<?php echo $data_course[0]['course_id']; ?>/<?php echo $discussion['id'];?>/<?php echo $data_course[0]['course_title']; ?>"><i class="icon md-back"></i><?php echo $comment['total_comment'];?> replies</a>
                                                                    <?php
                                                                                }
                                                                            }
                                                                        }
                                                                   ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                            <?php
                                                }
                                            ?>
                                        </ul>
                                            <!-- END / LIST ITEM -->
            
                                        <div class="load-more">
                                            <a href="">
                                            <i class="icon md-time"></i>
                                            Load more previous update</a>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                            <!-- END / DISCUSSION -->
    
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
                                <div class="form-review">
                                    <form>
                                        <div class="review-editor text-form-editor">
                                            <img src="<?php echo base_url();?>assets/images/editor-demo-1.jpg" alt="">
                                            <textarea placeholder="Discussion content"></textarea>
                                        </div>
                                        <div class="form-submit">
                                            <input type="submit" value="Post" class="mc-btn-2 btn-style-2">
                                        </div>
                                    </form>
                                    <div class="your-rate">
                                        <span>Your rate</span>
                                        <div class="rating">
                                            <a href="#" class="active"></a>
                                            <a href="#" class="active"></a>
                                            <a href="#" class="active"></a>
                                            <a href="#"></a>
                                            <a href="#"></a>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-review">
                                    <li class="review">
                                        <div class="body-review">
                                            <div class="review-author">
                                                <a href="#">
                                                    <img src="<?php echo base_url();?>assets/images/team-13.jpg" alt="">
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
                                                    <img src="<?php echo base_url();?>assets/images/team-13.jpg" alt="">
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
                                                    <img src="<?php echo base_url();?>assets/images/team-13.jpg" alt="">
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
                                                    <img src="<?php echo base_url();?>assets/images/team-13.jpg" alt="">
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
    
                            <!-- UPDATE LOG -->
                            <div class="tab-pane fade" id="updatelog">
                                <ul class="list-update">
                                    <li>
                                        <div class="time-update">
                                            <span>5 days ago</span>
                                        </div>
                                        <div class="content-update">
                                           <p>
                                                <a href="#">Morbi nec nisi ante. </a>
                                                Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor
                                           </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="time-update">
                                            <span>5, May 2014</span>
                                        </div>
                                        <div class="content-update">
                                           <p>
                                                <a href="#">Morbi nec nisi ante. </a>
                                                Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor
                                           </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="time-update">
                                            <span>5, May 2014</span>
                                        </div>
                                        <div class="content-update">
                                           <p>
                                                <a href="#">Morbi nec nisi ante. </a>
                                                Quisque lacus ligula,
                                                <a href="#">iaculis in elit et</a>
                                            </p>
                                            <ul class="list-content-update">
                                                <li>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, </li>
                                                <li>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, </li>
                                                <li>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="time-update">
                                            <span>5, May 2014</span>
                                        </div>
                                        <div class="content-update">
                                           <p>
                                                <a href="#">Morbi nec nisi ante. </a>
                                                Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor
                                           </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="time-update">
                                            <span>5, May 2014</span>
                                        </div>
                                        <div class="content-update">
                                           <p>
                                                <a href="#">Morbi nec nisi ante. </a>
                                                Quisque lacus ligula,
                                                <a href="#">iaculis in elit et</a>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="load-more">
                                    <a href="">
                                    <i class="icon md-time"></i>
                                    Load more previous update</a>
                                </div>
                            </div>
                            <!-- END / UPDATE LOG -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END / COURSE TOP -->

	<!--
    COURSE CONCERN
    <section id="course-concern" class="course-concern">
        <div class="container">
            <h3 class="md black">Courses you may concern</h3>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    MC ITEM
                    <div class="mc-item mc-item-2">
                        <div class="image-heading">
                            <img src="<?php echo base_url();?>assets/theme/images/feature/img-1.jpg" alt="">
                        </div>
                        <div class="meta-categories"><a href="#">Web design</a></div>
                        <div class="content-item">
                            <div class="image-author">
                                <img src="<?php echo base_url();?>assets/images/avatar-1.jpg" alt="">
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
                    END / MC ITEM
                </div>
    
                <div class="col-sm-6 col-md-3">
                    MC ITEM
                    <div class="mc-item mc-item-2">
                        <div class="image-heading">
                            <img src="<?php echo base_url();?>assets/theme/images/feature/img-1.jpg" alt="">
                        </div>
                        <div class="meta-categories"><a href="#">Web design</a></div>
                        <div class="content-item">
                            <div class="image-author">
                                <img src="<?php echo base_url();?>assets/images/avatar-1.jpg" alt="">
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
                    END / MC ITEM
                </div>
    
                <div class="col-sm-6 col-md-3">
                    MC ITEM
                    <div class="mc-item mc-item-2">
                        <div class="image-heading">
                            <img src="<?php echo base_url();?>assets/theme/images/feature/img-1.jpg" alt="">
                        </div>
                        <div class="meta-categories"><a href="#">Web design</a></div>
                        <div class="content-item">
                            <div class="image-author">
                                <img src="<?php echo base_url();?>assets/images/avatar-1.jpg" alt="">
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
                    END / MC ITEM
                </div>
    
                <div class="col-sm-6 col-md-3">
                    MC ITEM
                    <div class="mc-item mc-item-2">
                        <div class="image-heading">
                            <img src="<?php echo base_url();?>assets/theme/images/feature/img-1.jpg" alt="">
                        </div>
                        <div class="meta-categories"><a href="#">Web design</a></div>
                        <div class="content-item">
                            <div class="image-author">
                                <img src="<?php echo base_url();?>assets/images/avatar-1.jpg" alt="">
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
                    END / MC ITEM
                </div>
            </div>
        </div>
    </section>
    END / COURSE CONCERN
	-->
<?php echo $footer;?>
<script type="text/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
<script>
CKEDITOR.env.isCompatible = true;
CKEDITOR.replace('discussion-content', {
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
localStorage.setItem("timer_save", "");
$(document).ready(function(){
    var progress = $("#progress").val();
    $("#progress-run").css("width", progress+'%');
});

function validation_form() {
    if ($('#topic-title').val() == "") {
        $('.alert-warning').show();
        $("html, body").animate({ scrollTop: 0 }, 500);
        setInterval(function () {
            $('.alert-warning').hide();
        }, 7000);
        return false;
    }
    if (CKEDITOR.instances['discussion-content'].getData() == "") {
        $('.alert-warning').show();
        $("html, body").animate({ scrollTop: 0 }, 500);
        setInterval(function () {
            $('.alert-warning').hide();
        }, 7000);
        return false;
    }
    return true;
}
$("#submit-comment").click(function(){
    $(".overlay").show();
    $("#spinner").show();
});

$("#submit-discussion").click(function(){
   if (validation_form() == true) {
        var user_name = $('#user_name').val();
        var topic_title = $('#topic-title').val();

        var discussion_content = CKEDITOR.instances['discussion-content'].getData();
        var list_discussion_content = '<li>'+
                                        '<div class="list-body">'+
                                            '<div class="image">'+
                                                <?php 
                                                    if (!empty($data_user_login[0]['picture'])) {
                                                        $picture = $data_user_login[0]['picture'];
                                                    } else {
                                                        $picture = "avatar.png";
                                                    }
                                                ?>
                                                '<img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">'+
                                            '</div>'+
                                            '<div class="list-content">'+
                                                '<cite class="xsm black bold"><a href="#">'+user_name+'</cite>'+
                                                '<h4 class="md black">'+topic_title+'</h4>'+
                                                '<div class="comment-meta">'+
                                                   '<a href="#">5 days ago</a>'+
                                                   '<a id="url_discussion" href="#"><i class="icon md-back"></i>0 replies</a>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</li>';
        
        $(".overlay").show();
        $("#spinner").show();

        $.post("<?php echo base_url();?>course/addCourseDiscussion", 
            {
                topic_title : $('#topic-title').val(),
                course_id : $('#course_id').val(),
                discussion_content : discussion_content
            }, 
            function(data) {
                var dataArray = $.parseJSON(data);
                //console.log(dataArray[0].);
                $('.alert-warning').hide();
                $('.alert-success').show();
                $(list_discussion_content).insertAfter("#list-discussion-view");
                $("#url_discussion").attr("href", "<?php echo base_url();?>course/learn/<?php echo $data_course[0]['course_id']; ?>/"+dataArray[0].id+"/<?php echo $data_course[0]['course_title']; ?>");
                $(".overlay").hide();
                $("#spinner").hide();
                $("html, body").animate({ scrollTop: 0 }, 500);

                var count = $("#topics_count").text();
                $("#topics_count").text(parseInt(count) + 1);
                
                $('#topic-title').val("");
                CKEDITOR.instances['discussion-content'].setData("");
            }
        );

        setInterval(function () {
            $('.alert-success').hide();
        }, 6000);
    }
});
</script>