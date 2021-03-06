<?php echo $header; ?>

<!-- FEATURED REQUEST TEACHER -->
<section id="featured-request-teacher" class="featured-request-teacher section">
    <div class="awe-parallax bg-featured-request-teacher"></div>
    <div class="awe-overlay overlay-color-1"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="request-form">
                    <h2>Start Creating Your Course</h2>
                    <?php echo form_open('course/createCourse'); ?>
                        <div class="form-item">
                            <input type="text" placeholder="Course Title ( 60 characers limit )" name="title">
                        </div>
                        <div class="form-question mc-select">
                            <select class="select" name="category">
                                <?php 
                                foreach ($categories as $category) {
                                    echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-submit-1">
                            <input type="submit" value="Create Course" class="mc-btn btn-style-1">
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-7">
                <div class="request-featured">
                    <h1 class="big">Create Course on Digitrainee is<br> SUPER EASY</h1>
                    <div class="create-course-info-wrap">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="create-course-info">
                                    <span class="count">1</span>
                                    <p>Fill Basic Information</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="create-course-info">
                                    <span class="count">2</span>
                                    <p>Design course and Asset</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="create-course-info">
                                    <span class="count">3</span>
                                    <p>Public and Share</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="second-featured">
                        <div class="mc-count-item">
                            <h4>Courses</h4>
                            <p><span class="countup">2536,556</span></p>
                        </div>
                         <div class="mc-count-item">
                            <h4>Trainers</h4>
                            <p><span class="countup">10,389</span></p>
                        </div>
                        <div class="mc-count-item">
                            <h4>Trainees</h4>
                            <p><span class="countup">34,177</span></p>
                        </div>
                        <!-- <div class="mc-count-item">
                            <h4>Tuition Paid</h4>
                            <p>$ <span class="countup">793,361,890</span></p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END / FEATURED REQUEST TEACHER -->

<?php echo $footer; ?>