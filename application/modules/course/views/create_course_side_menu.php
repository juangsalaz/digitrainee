<div class="col-md-3">
    <div class="create-course-sidebar">
        <ul class="list-bar">
            <li class="<?php echo $active1; ?>"><a href="<?php echo base_url();?>course/cBasicInfo?c=<?php echo $id ?>"><span class="count">1</span>Basic Information</a></li>
            <li class="<?php echo $active2; ?>"><a href="<?php echo base_url();?>course/cDesignCourse?c=<?php echo $id ?>"><span class="count">2</span>Design Course</a></li>
            <li class="<?php echo $active3; ?>"><a href="<?php echo base_url();?>course/cPublishCourse?c=<?php echo $id ?>"><span class="count">3</span>Publish Course</a></li>
        </ul>
        <!--
        <div class="support">
            <a href="#"><i class="icon md-camera"></i>See how it work short tutorial</a>
            <a href="#"><i class="icon md-flash"></i>Instant Support</a>
        </div>
    -->
    </div>
</div>