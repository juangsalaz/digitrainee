<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <!-- Google font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- Css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/css/library/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/css/library/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/css/library/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/css/md-font.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/css/style.css">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <title>Digitrainee - Hand In Hand We Learn</title>
</head>
<body id="page-top">

<!-- PAGE WRAP -->
<div id="page-wrap">
    
    <div class="top-nav">

        <h4 class="sm black bold"><?php echo $data_course[0]['course_title'];?></h4>
        <input type="text" name="quiz_id" id="quiz_id" value="<?php echo $quiz_id; ?>" style="display: none;">
        <ul class="top-nav-list">
            <li class="prev-course">
                <a href="#">
                    <!-- <i class="icon md-angle-left"></i><span class="tooltip">Prev</span> -->
                </a>
            </li>
            <li class="next-course"><a href="#">
                <!-- <i class="icon md-angle-right"></i><span class="tooltip">Next</span> -->
            </a></li>
            
            <!-- DISCUSSION -->
            <li class="discussion-learn">
                <a href="#">
                    <!-- <i class="icon md-comments"></i> -->
                </a>
                <div class="list-item-body discussion-learn-body">
                    <div class="inner">
                       <!--  <div class="form-discussion">
                            <form>
                                <div class="text-title">
                                    <input type="text" placeholder="Topic title here">
                                </div>
                                <div class="post-editor text-form-editor">
                                    <img src="images/editor-demo-1.jpg" alt="">
                                    <textarea placeholder="Discussion content"></textarea>
                                </div>
                                <div class="form-submit">
                                    <input type="submit" value="Post" class="mc-btn-2 btn-style-2">
                                </div>
                                <h5>3 Topics</h5>
                            </form>
                        </div> -->
                
                        <ul class="list-discussion">
                
                            <!-- LIST ITEM -->
                            <li>
                                <div class="list-body">
                                    <div class="list-content">
                                        <cite class="name-author"><a href="#">Anna Molly</a></cite>
                                        <p>Morbi nec nisi ante. Quisque lacus ligula, iaculis in elit et, interdum semper quam. Fusce in interdum tortor. Ut sollicitudin lectus dolor eget imperdiet libero pulvinar sit amet</p>
                                        <div class="comment-meta">
                                           <a href="#">5 days ago</a>
                                           <a href="#"><i class="icon md-arrow-up"></i>13</a>
                                           <a href="#"><i class="icon md-arrow-down"></i>25</a>
                                           <a href=""><i class="icon md-back"></i>384 replies</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- END / LIST ITEM -->
                
                            <!-- LIST ITEM -->
                            <li>
                                <div class="list-body">
                                    <div class="list-content">
                                        <cite class="name-author"><a href="#">Anna Molly</a></cite>
                                        <p>Title of topic shown only. When user click on topic it show full content and discussion below</p>
                                        <div class="comment-meta">
                                           <a href="#">5 days ago</a>
                                           <a href="#"><i class="icon md-arrow-up"></i>13</a>
                                           <a href="#"><i class="icon md-arrow-down"></i>25</a>
                                           <a href=""><i class="icon md-back"></i>384 replies</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- END / LIST ITEM -->
                
                            <!-- LIST ITEM -->
                            <li>
                                <div class="list-body">
                                    <div class="list-content">
                                        <cite class="name-author"><a href="#">Anna Molly</a></cite>
                                        <p>Title of topic shown only. When user click on topic it show full content and discussion below</p>
                                        <div class="comment-meta">
                                           <a href="#">5 days ago</a>
                                           <a href="#"><i class="icon md-arrow-up"></i>13</a>
                                           <a href="#"><i class="icon md-arrow-down"></i>25</a>
                                           <a href=""><i class="icon md-back"></i>384 replies</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- END / LIST ITEM -->
                        </ul>
                    </div>
                </div>
            </li>

            <!-- NOTE LEARN -->
            <li class="note-learn">
                <a href="#">
                    <!-- <i class="icon md-file"></i> -->
                </a>
                <div class="list-item-body note-learn-body">
                    <div class="note-title">
                        <h5>Note</h5>
                        <a href="#"><i class="icon md-share"></i></a>
                    </div>
                    <div contenteditable="true" class="note-body">
                        Start writing here
                    </div>
                </div>
            </li>
            <li class="outline-learn">
                <a href="#"><i class="icon md-list"></i></a>
                <div class="list-item-body outline-learn-body">
                    <?php 
                        $u = 1;
                        $q = 1;
                        $i = 1;
                        foreach ($data_curriculum as $curriculum) {
                    ?>
                            <div class="section-learn-outline">
                                <h5 class="section-title">Sect <?php echo $i;?> : <?php echo $curriculum['name']; ?></h5>
                                <ul class="section-list">
                                    <?php 
                                        foreach ($data_curriculum_unit as $curriculum_unit) {
                                            if ($curriculum_unit['curriculum_id'] == $curriculum['id']) {
                                                if ($unit_id == $curriculum_unit['unit_id']) {
                                    ?>
                                                    <li class="o-view">
                                    <?php
                                                } else {
                                    ?>
                                                    <li>
                                    <?php
                                                }
                                    ?>
                                                        <div class="list-body">
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
                                                                <?php 
                                                                    if ($curriculum_unit['type'] == 2) {
                                                                ?>
                                                                        <h6>Quizz <?php echo $q;?></h6>
                                                                <?php
                                                                        $q++;
                                                                    } elseif ($curriculum_unit['type'] == 1) {
                                                                ?>
                                                                        <h6>Unit <?php echo $u;?></h6>
                                                                <?php
                                                                        $u++;
                                                                    }
                                                                ?>
                                                                
                                                                <p><?php echo $curriculum_unit['topic']; ?></p>
                                                            </a>
                                                        </div>
                                                        <div class="download">
                                                            <a href="#"><i class="icon md-download-1"></i></a>
                                                        </div>
                                                        <div class="div-x"><i class="icon md-check-2"></i></div>
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
            </li>
            <li class="backpage">
                <a href="<?php echo base_url(); ?>course/learn/<?php echo $data_course[0]['course_id'];?>/<?php echo $data_course[0]['course_title'];?>"><i class="icon md-close-1"></i></a>
            </li>
        </ul>
        
    </div>