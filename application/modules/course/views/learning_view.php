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

    <script src="<?php echo base_url(); ?>assets/jwplayer/jwplayer.js"></script>
    <script>jwplayer.key="9nFi1lhVH3rUgSPqZwNj6+pt6ckfItly9eYS+Q==";</script>
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
        <input type="text" name="unit_id" id="unit_id" value="<?php echo $unit_id; ?>" style="display: none;">
        <ul class="top-nav-list">
            <li class="prev-course">
                <a href="#">
                    <!-- <i class="icon md-angle-left"></i>
                    <span class="tooltip">Prev</span> -->
                </a>
            </li>
            <li class="next-course">
                <a href="#">
                    <!-- <i class="icon md-angle-right"></i>
                    <span class="tooltip">Next</span> -->
                </a>
            </li>
            



            <!-- DISCUSSION -->
            <?php 
                if (isset($discussion_id)) {
            ?>
                    <li class="discussion-learn active">
                        <a href="#">
                            <!-- <i class="icon md-comments"></i> -->
                        </a>
                        <div class="list-item-body discussion-learn-body">
                            <div class="inner">
                                <input type="text" id="course_id" value="<?php echo $data_course[0]['course_id']; ?>" style="display: none;">
                                <input type="text" id="user_name" value="<?php echo $user_name; ?>" style="display: none;">
                               <!--  <div class="alert alert-success" role="alert">
                                    <strong>Great!</strong> Your discussion topic has been added.
                                </div>

                                <div class="alert alert-warning" role="alert">
                                    <strong>Ops!</strong> Topic title and content can't empty.
                                </div>
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
                                    <h5><?php echo count($data_discussion);?> Topics</h5>
                                </div> -->
                        
                                <ul class="list-discussion">
                                    <div id="list-discussion-view"></div>
                                    <!-- LIST ITEM -->
                                    <li>
                                        <div class="list-body">
                                            <div class="list-content">
                                                <cite class="name-author"><a href="#"><?php echo $data_discussion_by_id[0]['username'];?></a></cite>
                                                <p style="font-weight: bold;"><?php echo $data_discussion_by_id[0]['topic'];?></p>
                                                <div style="text-align: justify;"><?php echo $data_discussion_by_id[0]['content'];?></div>
                                                <div class="comment-meta">
                                                   <a href="#">5 days ago</a>
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
                                                    <div class="list-content">
                                                        <cite class="name-author"><a href="#"><?php echo $comment_discussion['username'];?></a></cite>
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
                                    <form method="post" action="<?php echo base_url();?>course/saveCommentDiscussionLearning">
                                        <input type="text" name="course_id" value="<?php echo $data_course[0]['course_id']; ?>" style="display: none;">
                                        <input type="text" name="discussion_id" value="<?php echo $data_discussion_by_id[0]['id'];?>" style="display: none;">
                                        <input type="text" name="course_title" value="<?php echo $data_course[0]['course_title']; ?>" style="display: none;">
                                        <div class="post-editor text-form-editor">
                                            <textarea id="discussion-content" name="discussion-content" placeholder="Comment content"></textarea>
                                        </div>
                                        <div class="form-submit">
                                            <a href="<?php echo base_url();?>course/learning/<?php echo $data_course[0]['course_id']; ?>/<?php echo $data_course[0]['course_title']; ?>" class="btn btn-xs btn-warning">Back</a>
                                            <input type="submit" id="submit-comment" value="Post" class="mc-btn-2 btn-style-2">
                                        </div>
                                    </form>
                                </div>
                                <br>
                            </div>
                        </div>
                    </li>
            <?php
                } else {
            ?>
                    <li class="discussion-learn">
                    <a href="#">
                        <!-- <i class="icon md-comments"></i> -->
                    </a>
                    <div class="list-item-body discussion-learn-body">
                        <div class="inner">
                            <input type="text" id="course_id" value="<?php echo $data_course[0]['course_id']; ?>" style="display: none;">
                            <input type="text" id="user_name" value="<?php echo $user_name; ?>" style="display: none;">
                            <div class="alert alert-success" role="alert">
                                <strong>Great!</strong> Your discussion topic has been added.
                            </div>

                            <div class="alert alert-warning" role="alert">
                                <strong>Ops!</strong> Topic title and content can't empty.
                            </div>
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
                                <h5><?php echo count($data_discussion);?> Topics</h5>
                            </div>
                    
                            <ul class="list-discussion">
                                <div id="list-discussion-view"></div>
                                <!-- LIST ITEM -->
                                <?php 
                                    foreach ($data_discussion as $discussion) {
                                ?>
                                        <li>
                                            <div class="list-body">
                                                <div class="list-content">
                                                    <cite class="name-author"><a href="#"><?php echo $discussion['username'];?></a></cite>
                                                    <p><?php echo $discussion['topic'];?></p>
                                                    <div class="comment-meta">
                                                       <a href="#">5 days ago</a>
                                                       <?php 
                                                            if (isset($array_comment)) {
                                                                foreach ($array_comment as $comment) {
                                                                    if ($comment['discussion_id'] == $discussion['id']) {
                                                        ?>
                                                                    <a href="<?php echo base_url();?>course/learning/<?php echo $data_course[0]['course_id']; ?>/<?php echo $discussion['id'];?>/<?php echo $data_course[0]['course_title']; ?>"><i class="icon md-back"></i><?php echo $comment['total_comment'];?> replies</a>
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
                        </div>
                    </div>
                </li>
            <?php
                }
            ?>
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
                <a href="#">
                    <i class="icon md-list"></i>
                </a>
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
                                                        <!--
                                                        <div class="download">
                                                            <a href="#"><i class="icon md-download-1"></i></a>
                                                        </div>
                                                        -->
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


    <section id="learning-section" class="learning-section learn-section">
        <div class="container">
            <div class="title-ct">
                <h3><?php echo $data_unit[0]['topic']; ?></h3>
                <div class="tt-right">
                    <input type="checkbox" id="markaslearned">
                    <label for="markaslearned">
                        Mark as learned
                        <i class="icon md-check-2"></i>
                    </label>
                </div>
            </div>
            <div class="abc">
            <div class="video embed-responsive embed-responsive-16by9">
                <?php 
                    if ($data_unit[0]['content_type'] == 'document') {
                ?>
                        <iframe src="<?php echo base_url();?>upload/documents/<?php echo $data_course[0]['course_id'];?>_<?php echo $data_unit[0]['curriculum_id']; ?>_<?php echo $data_unit[0]['id']; ?>_<?php echo $data_unit[0]['content_filename']; ?>" class="embed-responsive-item"></iframe>
                <?php
                    } else {
                ?>
                        <div id="myElement">Loading the player...</div>
                        <script type="text/javascript">
                            var playerInstance = jwplayer("myElement");
                            playerInstance.setup({
                                file: "<?php echo base_url();?>upload/videos/<?php echo $data_course[0]['course_id'];?>_<?php echo $data_unit[0]['curriculum_id']; ?>_<?php echo $data_unit[0]['id']; ?>_<?php echo $data_unit[0]['content_filename']; ?>",
                                // image: "http://example.com/uploads/myPoster.jpg",
                                width: 840,
                                height: 460,
                                title: '<?php echo $data_unit[0]['topic']; ?>',
                                // description: 'A video with a basic title and description!'
                            });
                        </script>
                <?php
                   }
                ?>
            </div>
            </div>
        </div>
    </section>

</div>
<!-- END / PAGE WRAP -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/vendor/sweetalert/lib/sweet-alert.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/vendor/sweetalert/lib/sweet-alert.min.js"></script>

<!-- Load jQuery -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery.owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery.appear.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
</body>
</html>
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
$("#markaslearned").change(function() {
    if(this.checked) {
        $.post("<?php echo base_url();?>course/markaslearned",
            {
                unit_id : $("#unit_id").val()
            },
            function(data) {
                var result = $.parseJSON(data);
                if (result.data == "success") {
                    //alert("You are mark this unit as learned");
                    swal("You are mark this unit as learned", "Success", "success");
                }
            }
        );
    } else {
        $.post("<?php echo base_url();?>course/markasnotlearned",
            {
                unit_id : $("#unit_id").val()
            },
            function(data) {
                var result = $.parseJSON(data);
                if (result.data == "success") {
                    //alert("You are mark this unit as not learned");
                    swal("You are mark this unit as not learned", "Success", "success");
                }
            }
        );
    }
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
                
                $('#topic-title').val("");
                CKEDITOR.instances['discussion-content'].setData("");
            }
        );

        setInterval(function () {
            $('.alert-success').hide();
        }, 6000);
    }
});

$(document).ready(function(){
    $.post("<?php echo base_url();?>course/isLearned",
        {
            unit_id : $("#unit_id").val()
        },
        function(data) {
            var result = $.parseJSON(data);
            if (result.data == "success") {
                $('#markaslearned').prop('checked', true);
            } else {
                $('#markaslearned').prop('checked', false);
            }
        }
    );
});
</script>