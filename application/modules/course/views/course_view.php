<?php echo $header;?>
<!-- SUB BANNER -->
    <!--  -->
    <!-- END / SUB BANNER -->


    <!-- PAGE CONTROL -->
    <section class="page-control">
        <div class="container">
            <div class="page-info">
                <a href="<?php echo base_url();?>"><i class="icon md-arrow-left"></i>Back to home</a>
            </div>
            <div class="page-view">
                View
                <span class="page-view-info view-grid active" title="View grid"><i class="icon md-ico-2"></i></span>
                <span class="page-view-info view-list" title="View list"><i class="icon md-ico-1"></i></span>
            </div>
        </div>
    </section>
    <!-- END / PAGE CONTROL -->
    
    <!-- CATEGORIES CONTENT -->
    <section id="categories-content" class="categories-content">
        <div class="container">
            <div class="row">
    
                <div class="col-md-9 col-md-push-3">
                    <div class="content grid">
                        <div class="row">
                            <?php 
                                if (!empty($courses)) {
                                    for ($i=0; $i<count($courses); $i++) {
                            ?>
                            <!-- ITEM -->
                                        <div class="col-sm-6 col-md-4">
                                            <div class="mc-item mc-item-2">
                                                <div class="image-heading">
                                                    <?php 
                                                        if (!empty($courses[$i]->banner)) {
                                                            $banner = 'upload/images/'.$courses[$i]->banner;
                                                        } else {
                                                            $banner = "assets/theme/images/feature/img-1.jpg";
                                                        }
                                                    ?>
                                                    <div style="width: 270px; height: 160px; background-position: center center; background-size: cover; -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3); display: inline-block; background-image: url('../<?php echo $banner; ?>')"></div>
                                                </div>
                                                <div class="meta-categories"><a href="#"><?php echo $courses[$i]->category; ?></a></div>
                                                <div class="content-item">
                                                    <div class="image-author">
                                                        <?php 
                                                            if (!empty($courses[$i]->picture)) {
                                                                $picture = $courses[$i]->picture;
                                                            } else {
                                                                $picture = 'avatar.png';
                                                            }
                                                        ?>
                                                        <img src="<?php echo base_url();?>upload/images/<?php echo $picture; ?>" alt="">
                                                    </div>
                                                    <h4><a href="<?php echo base_url();?>course/detail/<?php echo $courses[$i]->course_id; ?>/<?php echo $courses[$i]->course_title; ?>"><?php echo $courses[$i]->course_title; ?></a></h4>
                                                    <div class="name-author">
                                                        By <a href="<?php echo base_url();?>profile/user/<?php echo $courses[$i]->user_id; ?>/<?php echo $courses[$i]->user_name; ?>"><?php echo $courses[$i]->user_name; ?></a>
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
                                                        <?php 
                                                            if (!empty($array_member)) {
                                                                for ($j=0; $j<count($array_member); $j++) {
                                                                    if ($array_member[$j]['course_id'] == $courses[$i]->course_id) {
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
                                                        if ($courses[$i]->is_free == 0) {
                                                            echo 'IDR '.$courses[$i]->course_price;
                                                        } else {
                                                            echo 'FREE';
                                                        }
                                                    ?>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                        }
                                    ?>
                            <!-- END / ITEM -->
                            <?php 
                                } else {
                                    echo "Course not available";
                                }
                            ?>                    
                        </div>
                    </div>
                </div>

                <!-- SIDEBAR CATEGORIES -->
                <div class="col-md-3 col-md-pull-9">
                    <aside class="sidebar-categories">
                        <div class="inner">
    
                            <!-- WIDGET TOP -->
                            <!-- <div class="widget">
                                <ul class="list-style-block">
                                    <li class="current"><a href="#">Featured</a></li>
                                    <li><a href="#">Staff pick</a></li>
                                    <li><a href="#">Free</a></li>
                                    <li><a href="#">Top paid</a></li>
                                </ul>
                            </div> -->
                            <!-- END / WIDGET TOP -->
    
                            <!-- WIDGET CATEGORIES -->
                            <div class="widget widget_categories">
                                <ul class="list-style-block">
                                    <li><a href="<?php echo base_url();?>course">All</a></li>
                                    <?php 
                                        for ($i=0; $i<count($categories); $i++) {
                                            if (!empty($categories)) {
                                    ?>
                                                <li><a href="<?php echo base_url();?>course/filter/<?php echo $categories[$i]->id; ?>/<?php echo $categories[$i]->name; ?>"><?php echo $categories[$i]->name; ?></a></li>
                                    <?php
                                            }
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
                <!-- END / SIDEBAR CATEGORIES -->
    
            </div>
        </div>
    </section>
    <!-- END / CATEGORIES CONTENT -->
<?php echo $footer;?>