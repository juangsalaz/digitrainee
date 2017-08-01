<?php echo $header; ?>

<!-- CREATE COURSE CONTENT -->
<section id="create-course-section" class="create-course-section">
    <div class="container">
        <div class="row">
            <?php echo $sideMenu; ?>

            <div class="col-md-9">
                <div class="create-course-content">

                    <!-- PUBLISH COURSE -->
                    <div class="publish-course">
                        <h3 class="md black">Course Summary</h3>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mc-item mc-item-1">
                                    <div class="image-heading">
                                        <?php 
                                        if (!empty($detail['banner'])) {
                                            $banner = 'upload/images/'.$detail['banner'];
                                        } else {
                                            $banner = "assets/theme/images/feature/img-1.jpg";
                                        }
                                        ?>
                                        <div style="width: 320px; height: 191px; background-position: center center; background-size: cover; -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3); display: inline-block; background-image: url('../<?php echo $banner; ?>')">
                                            <!--<div style="height: 170px;text-align:center;margin:75px 25px;color:#fff">JUDULNYA DISINI</div>-->
                                        </div>
                                        
                                    </div>
                                    <div class="meta-categories"><a href="#"><?php echo $detail['category_name']; ?></a></div>
                                    <div class="content-item">
                                        <div class="image-author">
                                            <?php 
                                                if (!empty($data_user_login[0]['picture'])) {
                                                    $picture = $data_user_login[0]['picture'];
                                                } else {
                                                    $picture = 'avatar.png';
                                                }
                                            ?>
                                            <img src="<?php echo base_url();?>upload/images/<?php echo $picture;?>" alt="">
                                        </div>
                                        <h4><a href="course-intro.html"><?php echo $detail['description']; ?></a></h4>
                                        <div class="name-author">
                                            By <a href="#"><?php echo $detail['instructor']; ?></a>
                                        </div>
                                    </div>
                                    <div class="ft-item">
                                        <div class="rating">
                                            <!--
                                            <a href="#" class="active"></a>
                                            <a href="#" class="active"></a>
                                            <a href="#" class="active"></a>
                                            <a href="#"></a>
                                            <a href="#"></a>
                                            -->
                                        </div>
                                        <div class="view-info">
                                            <!--
                                            <i class="icon md-users"></i>
                                            2568
                                            -->
                                        </div>
                                        <div class="comment-info">
                                            <!--<i class="icon md-comment"></i>
                                            25-->
                                        </div>
                                        <div class="price">
                                            <?php echo ($detail['is_free'] == '1') ? 'Free' : 'Rp. '.number_format($detail['price']); ?>
                                            <!--
                                            $190
                                            <span class="price-old">$145</span>
                                            -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <h2 class="big black"><?php echo $detail['name']; ?></h2>
                                <!--
                                <div class="new-course">
                                    <div class="item course-code">
                                        <i class="icon md-barcode"></i>
                                        <h4><a href="#">Course Code</a></h4>
                                        <p class="detail-course"># A 15273</p>
                                    </div>
                                    <div class="item course-code">
                                        <i class="icon md-time"></i>
                                        <h4><a href="#">Duration</a></h4>
                                        <p class="detail-course">3 weeks</p>
                                    </div>
                                    <div class="item course-code">
                                        <i class="icon md-img-check"></i>
                                        <h4><a href="#">Open Date</a></h4>
                                        <p class="detail-course">25 May 2014</p>
                                    </div>
                                </div>
                                -->

                                <hr class="line">
                                <div class="about-instructor">
                                    <h4 class="xsm black">About Instructor</h4>
                                    <ul>
                                        <li>
                                            <div class="image-instructor text-center">
                                                <?php 
                                                    if (!empty($data_user_login[0]['picture'])) {
                                                        $picture = $data_user_login[0]['picture'];
                                                    } else {
                                                        $picture = 'avatar.png';
                                                    }
                                                ?>
                                                <img src="<?php echo base_url();?>upload/images/<?php echo $picture;?>" alt="">
                                            </div>
                                            <div class="info-instructor">
                                                <cite class="sm black"><a href="#"><?php echo $detail['instructor']; ?></a></cite>
                                                <p><?php echo $detail['instructor_about']; ?></p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <hr class="line">
                                <div class="widget widget_equipment">
                                    <i class="icon md-config"></i>
                                    <h4 class="xsm black">Equipment</h4>
                                    <div class="equipment-body">
                                        <!--<a href="#">Photoshop CC</a>,
                                        <a href="#">Illustrator CC</a>-->
                                        <?php echo $detail['tool_requirement'] ? $detail['tool_requirement'] : '-';?>
                                    </div>
                                </div>

                                <div class="widget widget_tags">
                                    <i class="icon md-download-2"></i>
                                    <h4 class="xsm black">Tag</h4>
                                    <div class="tagCould">
                                        <!--<a href="#">Design</a>, 
                                        <a href="#">Photoshop</a>, 
                                        <a href="#">Illustrator</a>, 
                                        <a href="">Art</a>, 
                                        <a href="">Graphic Design</a>-->
                                        <?php echo $detail['tag'] ? $detail['tag'] : '-';?>
                                    </div>
                                </div>

                                <hr class="line">

                                <div class="current-wrapper">
                                    <h4 class="xsm black">Current outline</h4>
                                    <ul class="current-outline">
                                        <li><span><?php echo $cntSection; ?></span>section</li>
                                        <!--<li><span>1</span>quizzes</li>-->
                                        <li><span><?php echo $cntSectionUnit; ?></span>units</li>
                                        <!--<li><span>5</span>assignments</li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END / PUBLISH COURSE -->

                    <div class="form-action confirm-save">
                        <a href="<?php echo base_url();?>course/cConfirmCourse?c=<?php echo $_GET['c'] ?>" class="mc-btn-3 btn-style-1">Confirm and Send Request</a>
                        <a href="<?php echo base_url();?>course/cSaveDraft?c=<?php echo $_GET['c'] ?>" class="mc-btn-3 btn-style-6">Save Draft</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END / CREATE COURSE CONTENT -->

<?php echo $footer; ?> 