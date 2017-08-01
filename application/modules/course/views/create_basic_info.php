<?php echo $header; ?>
<div id="spinner"></div>

<!-- BANNER CREATE COURSE -->
<section class="sub-banner sub-banner-create-course">
    <div class="awe-color bg-color-1"></div>
    <div class="container">
        <div id="titleCourse">
            <h2 class="md ilbl"><span contenteditable="true" id="form-course-title"><?php echo $detail['name'];?></span></h2>
            <i class="icon md-pencil btnTitleEdit" style="cursor: pointer; cursor: hand;"></i>
        </div>
    </div>
</section>
<script>
    function saveCourseTitle() {
        var postData = {
            'title' : $('#form-course-title')[0].innerText,
            'id' : <?php echo $_GET['c']; ?>
        };
        $("#spinner").show();

        $.post('/course/editCourseTitle', postData, function(data){
            //This should be JSON preferably. but can't get it to work on jsfiddle
            //Depending on what your controller returns you can change the action
            if (data != '') {
                $("#spinner").hide(); 
                console.log('update title success');
            } else {
                //alert('Failed edit title');
                swal("Sorry...", "Update title fail", "error");
            }
        });
    }

    $('#titleCourse').keypress(function(e) {
        if (e.which == 13 || e.which == 9) {
            saveCourseTitle();
            e.preventDefault();
        }
    });

    $('#titleCourse').on('click', '.btnTitleEdit', function() {
        saveCourseTitle();
    });
</script>
<!-- END / BANNER CREATE COURSE -->

<!-- CREATE COURSE CONTENT -->
<section id="create-course-section" class="create-course-section">
    <div class="container">
        <div class="row">
            <?php echo $sideMenu; ?>

            <div class="col-md-9">
                <?php echo form_open_multipart('course/saveBasicInfo'); ?>
                    <input type="hidden" name="c" value="<?php echo $detail['id'];?>"> 
                    <div class="create-course-content">

                        <!-- COURSE BANNER -->
                        <div class="course-banner create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Course Banner</h4>
                                </div>
                                <div class="col-md-9">
                                    <div class="image-info">
                                        <?php $bgPreview = $detail['banner'] ? 'upload/images/'.$detail['banner'] : 'assets/theme/images/img-upload.jpg' ?>
                                        <div id="course_banner_preview" style="width: 270px; height: 160px; background-position: center center; background-size: cover; -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3); display: inline-block; background-image: url('../<?php echo $bgPreview; ?>')"></div>
                                        <!--<img src="<?php //echo base_url(); ?>assets/theme/images/img-upload.jpg" alt="">-->
                                    </div>
                                    
                                    <div class="upload-recrop">
                                        <div class="upload-image up-file">
                                            <a href="#"><i class="icon md-upload"></i>Upload image</a>
                                            <input type="file" name="banner" id="course_banner">
                                        </div>
                                        <!--
                                        <div class="recrop">
                                            <a href="#"><i class="icon md-crop"></i>Recrop</a>
                                        </div>
                                        -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END / COURSE BANNER -->

                        <!-- PROMO VIDEO -->
                        <div class="promo-video create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Promo Video</h4>
                                </div>
                                <div class="col-md-9">
                                    <!--<div class="form-item">
                                        <input type="text" placeholder="Paste URL">
                                    </div>-->
                                    <div class="upload-video up-file">
                                        <!--or-->
                                        <!--<a href="#"><i class="icon md-upload"></i>Upload video</a>-->
                                        <input type="file" name="promo_video" id="promo_video">
                                        <div id="file_video_promo"><?php echo $detail['video_promo']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END / PROMO VIDEO -->

                        <!-- DESCRIPTION -->
                        <div class="description create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Description</h4>
                                </div>
                                <div class="col-md-9">
                                    <div class="description-editor text-form-editor">
                                        <textarea placeholder="Discussion content" name="description"><?php echo $detail['description'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END / DESCRIPTION -->

                        <!-- INSTRUCTORS -->
                        <div class="instructors create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Instructors</h4>
                                </div>
                                <div class="col-md-9">
                                    <div class="author">
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
                                        <cite><?php echo $author; ?> ( Author )</cite>
                                    </div>
                                    <!--<a href="#" class="add-instructor"><i class="icon md-plus"></i>Add Instructor</a>-->
                                </div>
                            </div>
                        </div>
                        <!-- END / INSTRUCTORS -->

                        <!-- OPEN DATE -->
                        <!--
                        <div class="open-date create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Open date</h4>
                                </div>
                                <div class="col-md-9">
                                    <div class='input-group date' id='datetimepicker'>
                                        <div class="form-item">
                                            <input type="text" name="started_date" id="datepicker" placeholder="Select date">
                                        </div>
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        -->
                        <!-- END / OPEN DATE -->

                        <!-- DURATION -->
                        <!--
                        <div class="duration create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Duration</h4>
                                </div>
                                <div class="col-md-9">
                                   <div class="duration-ct">
                                        <div class="form-item">
                                            <input type="text">
                                        </div>
                                        <span class="day">days</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        -->
                        <!-- END / DURATION -->

                        <!-- TUITION FREE -->
                        <div class="tuition-fee create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Tuition fee</h4>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-item form-radio radio-style">
                                        <input type="radio" id="free" name="tuition" value="1" <?php echo $detail['is_free']==1 ? 'checked' : ''; ?>>
                                        <label for="free">
                                            <i class="icon-radio"></i>
                                            Free
                                        </label>
                                    </div>
                                    <div class="form-item form-radio radio-style">
                                        <input type="radio" id="paid" name="tuition" value="0" <?php echo $detail['is_free']==0 ? 'checked' : ''; ?>>
                                        <label for="paid">
                                            <i class="icon-radio"></i>
                                            Paid
                                        </label>
                                    </div>
                                    <div class="form-item">
                                        <input type="text" placeholder="amount" id="course-price" name="price" value="<?php echo $detail['price'];?>" <?php echo $detail['is_free']==1 ? 'readonly' : '' ;?>>
                                        <span class="dl">Rp</span>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <!-- END / TUITION FREE -->

                        <!-- FOR LEVEL FROM -->
                        <div class="for-level-from create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>For level from</h4>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-item form-radio radio-style">
                                        <input type="radio" id="beginer" name="for-level-from" value="1" <?php echo $detail['level'] == "1" ? "checked" : ""; ?>>
                                        <label for="beginer">
                                            <i class="icon-radio"></i>
                                            Beginner
                                        </label>
                                    </div>

                                    <div class="form-item form-radio radio-style">

                                        <input type="radio" id="intermediate"  name="for-level-from"  value="2" <?php echo $detail['level'] == "2" ? "checked" : ""; ?>>
                                        <label for="intermediate">
                                            <i class="icon-radio"></i>
                                            Intermediate
                                        </label>
                                    </div>

                                    <div class="form-item form-radio radio-style">

                                        <input type="radio" id="professional"  name="for-level-from"  value="3" <?php echo $detail['level'] == "3" ? "checked" : ""; ?>>
                                        <label for="professional">
                                            <i class="icon-radio"></i>
                                            Professional
                                        </label>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <!-- END / FOR LEVEL FROM -->

                        <!-- CATEGORIES -->
                        <div class="categories-item create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Categories</h4>
                                    <span class="text-err">choose at least one</span>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <?php
                                        foreach ($categories as $cat) {
                                            ?>
                                            <div class="form-item form-checkbox checkbox-style col-md-4">
                                                <input type="checkbox" id="cat_<?php echo $cat['id']; ?>" name="cat_<?php echo $cat['id']; ?>" <?php echo $cat['id'] == $detail['category_id'] ? "checked" : ""; ?>>
                                                <label for="cat_<?php echo $cat['id']; ?>">
                                                    <i class="icon-checkbox icon md-check-1"></i>
                                                    <?php echo $cat['name']; ?>
                                                </label>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                        <!-- END / CATEGORIES -->

                        <!-- TOOL REQUIREMENT -->
                        <div class="tool-requirement create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Tool requirement</h4>
                                    <!--<span class="text-err">not filled yet</span>-->
                                </div>
                                <div class="col-md-9">
                                    <div class="form-item">
                                        <input type="text" name="tool_requirement" value="<?php echo $detail['tool_requirement']; ?>">
                                        <span>type your tool, separated by comma or space</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END / TOOL REQUIREMENT -->

                        <!-- TAG -->
                        <div class="tag-item create-item">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4>Tag</h4>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-item">
                                        <input type="text" name="tag" value="<?php echo $detail['tag']; ?>">
                                        <span>type your tool, separated by comma or space</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END / TAG -->

                        <div class="form-action">
                            <input type="submit" value="Save and Next" class="submit mc-btn-3 btn-style-1" onClick="submit();">
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- END / CREATE COURSE CONTENT -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/uploadify/jquery.uploadify.min.js"></script>
<script>
    $('input:radio[name="tuition"]').change(
    function() {
        if ($(this).is(':checked') && $(this).val() == '1') {
            $('#course-price').attr("readonly", true);
        } else if ($(this).is(':checked') && $(this).val() == '0') {
            $('#course-price').attr("readonly", false);
        }
    });

    $(function() {
        <?php $timestamp = time(); ?>
        $('#promo_video').uploadify({
            'swf'      : '<?php echo base_url(); ?>assets/theme/js/library/uploadify/uploadify.swf',
            'uploader' : 'uploadVideoDemo',
            'method'   : 'post',
            'formData' : { 
                            'timestamp' : '<?php echo $timestamp; ?>', 
                            'token' : '<?php echo md5("unique_hash".$timestamp); ?>',
                            'id' : <?php echo $detail['id'] ?> 
                            }, 
            'onUploadSuccess' : function(file, data, response) {
                if (data == '1') {
                    $('#file_video_promo').html(file.name);    
                } else {
                    alert('The file ' + file.name + ' could not be uploaded: ' + data );
                }                
            },
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
             },
            // Put your options here
        });

        $("#course_banner").on("change", function() {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

     
            if (/^image/.test( files[0].type)){ // only image file
                console.log(files);
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
     
                reader.onloadend = function(){ // set image data as background of div
                    $("#course_banner_preview").css("background-image", "url("+this.result+")");
                }
            }
        });
    });
</script>

<?php echo $footer; ?>