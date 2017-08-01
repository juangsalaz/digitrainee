<?php echo $header; ?>
<div id="spinner"></div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/js/library/uploadify/uploadify.css" />

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
                <div class="create-course-content">
                    <!-- COURSE BANNER -->
                    <ul class="design-course-tabs" role="tablist">
                        <li class="active">
                            <a href="#design-outline" role="tab" data-toggle="tab"><i class="icon md-list"></i>Outline</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- DESIGN OUTLINE -->
                        <div class="tab-pane fade in active" id="design-outline">
                            <!-- SECTIONS -->
                            <div class="dc-sections" id="dc-sections-area">
                                <!-- DC SECTION INFO -->
                                <?php 
                                foreach($sections as $section) {
                                    ?>
                                    <div class="dc-section-info" id="dc-section-info-<?php echo $section['id'];?>">
                                        <div class="title-section">
                                            <h4 class="xsm"><span contenteditable="true" id="section-title-<?php echo $section['id'];?>" onBlur="editSectionTitle(<?php echo $section['id'];?>)"><?php echo $section['name'];?></span></h4>
                                            <script>
                                                 $("#section-title-<?php echo $section['id'];?>").keypress(function(e) {
                                                    if (e.which == 13 || e.which == 9) {
                                                        editSectionTitle(<?php echo $section['id'];?>);
                                                        e.preventDefault();
                                                    }
                                                });
                                            </script>
                                            <div class="course-region-tool">
                                                <a style="cursor: pointer; cursor: hand;" class="save" title="save" onClick="editSectionTitle(<?php echo $section['id'];?>)"><i class="fa fa-save"></i></a>
                                                <a style="cursor: pointer; cursor: hand;" class="delete" title="delete" onClick="deleteSection(<?php echo $section['id'];?>)"><i class="icon md-recycle"></i></a>
                                                <a style="cursor: pointer; cursor: hand;" id="toggle-section-<?php echo $section['id'];?>" class="toggle-section active"  onClick="showHideSection(<?php echo $section['id'];?>)"><i class="fa fa-caret-right"></i></a>
                                            </div>
                                        </div>

                                        <div class="dc-section-body" id="dc-section-body-<?php echo $section['id'];?>">
                                            <?php 
                                            foreach($section['units'] as $unit) {
                                                if ($unit['type'] == '4') {
                                                    ?>
                                                    <div class="dc-unit-info dc-course-item" id="dc-unit-info-<?php echo $unit['id'];?>">
                                                        <div class="dc-content-title">
                                                            <h5 class="xsm black"><span contenteditable="true" id="unit-title-<?php echo $unit['id'];?>" onBlur="editUnitTitle(<?php echo $unit['id'] ?>)"><?php echo $unit['topic'];?></span></h5>
                                                            <script>
                                                                 $("#unit-title-<?php echo $unit['id']; ?>").keypress(function(e) {
                                                                    if (e.which == 13 || e.which == 9) {
                                                                        editUnitTitle(<?php echo $unit['id']; ?>);
                                                                        e.preventDefault();
                                                                    }
                                                                });
                                                            </script>
                                                            <div class="course-region-tool">
                                                                <span>(Live Course)</span>
                                                                <a style="cursor: pointer; cursor: hand;" class="save" title="save" onClick="editUnitTitle(<?php echo $unit['id'] ?>)"><i class="fa fa-save"></i></a>
                                                                <a style="cursor: pointer; cursor: hand;" class="delete" title="delete"><i class="icon md-recycle" onClick="deleteUnit(<?php echo $unit['id']; ?>)"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } else if ($unit['type'] == '2') {
                                                    ?>
                                                    <!-- DC QUIZZ -->
                                                    <div class="dc-quizz-info dc-course-item" id="dc-quizz-info-<?php echo $unit['quiz_id']; ?>">
                                                        <div class="dc-content-title">
                                                            <h5 class="xsm black"><span contenteditable="true" id="quiz-title-<?php echo $unit['quiz_id']; ?>" onBlur="editQuiz(<?php echo $unit['quiz_id']; ?>)"><?php echo $unit['quiz_title']; ?></span></h5>
                                                            <script>
                                                                 $("#quiz-title-<?php echo $unit['quiz_id']; ?>").keypress(function(e) {
                                                                    if (e.which == 13 || e.which == 9) {
                                                                        editQuiz(<?php echo $unit['quiz_id']; ?>);
                                                                        e.preventDefault();
                                                                    }
                                                                });
                                                            </script>
                                                            <div class="course-region-tool">
                                                                <a style="cursor: pointer; cursor: hand;" class="save" title="save" onClick="editQuiz(<?php echo $unit['quiz_id']; ?>)"><i class="fa fa-save"></i></a>
                                                                <a style="cursor: pointer; cursor: hand;" class="delete" title="delete" onClick="deleteQuiz(<?php echo $unit['quiz_id']; ?>)"><i class="icon md-recycle"></i></a>
                                                            </div>
                                                        </div>
                                                        <div class="quizz-body dc-item-body" id="quizz-body-<?php echo $unit['quiz_id']; ?>">
                                                            <div class="btn-add">
                                                                <a href="#addquestion-<?php echo $unit['quiz_id']; ?>" id="button-add-question-<?php echo $unit['quiz_id']; ?>" class="popup-with-zoom-anim">
                                                                    <i class="icon md-plus"></i> Add Question
                                                                </a>
                                                            </div>
                                                            <div class="form-item form-checkbox checkbox-style">
                                                                <input type="checkbox" id="quiz-timelimit-<?php echo $unit['quiz_id']; ?>" name="quiz-timelimit-<?php echo $unit['quiz_id']; ?>" <?php echo $unit['quiz_timelimit'] ? 'checked' : '' ;?> onChange="editQuiz(<?php echo $unit['quiz_id']; ?>)">
                                                                <label for="quiz-timelimit-<?php echo $unit['quiz_id']; ?>"><i class="icon-checkbox icon md-check-1"></i> Limit time</label>
                                                            </div>
                                                            <div class="time">
                                                                <div class="form-item">
                                                                    <input type="text" name="quiz-lifetime-<?php echo $unit['quiz_id']; ?>" id="quiz-lifetime-<?php echo $unit['quiz_id']; ?>" value="<?php echo $unit['quiz_lifetime']; ?>" onChange="editQuiz(<?php echo $unit['quiz_id']; ?>)">
                                                                    <label for="">mins</label>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="col-md-1" style="margin-top:7px;">Easy</label>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" id="total_easy_question_<?php echo $unit['quiz_id']; ?>" name="total_easy_question_<?php echo $unit['quiz_id']; ?>" value="<?php echo $unit['total_easy_question']; ?>" placeholder="Total easy question" onChange="editQuiz(<?php echo $unit['quiz_id']; ?>)">
                                                                </div>
                                                                <label class="col-md-1" style="margin-top:7px;">Medium</label>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" id="total_medium_question_<?php echo $unit['quiz_id']; ?>" name="total_medium_question_<?php echo $unit['quiz_id']; ?>" value="<?php echo $unit['total_medium_question']; ?>" placeholder="Total medium question" onChange="editQuiz(<?php echo $unit['quiz_id']; ?>)">
                                                                </div>
                                                                <label class="col-md-1" style="margin-top:7px;">Hard</label>
                                                                <div class="col-md-3">
                                                                    <input type="text" class="form-control" id="total_hard_question_<?php echo $unit['quiz_id']; ?>" name="total_hard_question_<?php echo $unit['quiz_id']; ?>" value="<?php echo $unit['total_hard_question']; ?>" placeholder="Total hard question" onChange="editQuiz(<?php echo $unit['quiz_id']; ?>)">
                                                                </div>
                                                            </div>
                                                            <br />
                                                            <div class="form-item">
                                                                <input type="text" name="quiz-intro-<?php echo $unit['quiz_id']; ?>" id="quiz-intro-<?php echo $unit['quiz_id']; ?>" placeholder="Short introduction ( optional)" class="fullwidth" value="<?php echo $unit['quiz_intro']; ?>">
                                                            </div>

                                                            <div class="form-item-wrap" id="quiz-answer-<?php echo $unit['quiz_id']; ?>">
                                                                <?php 
                                                                foreach ($unit['questions'] as $question) {
                                                                    ?>
                                                                    <div class="form-items" id="area-question-<?php echo $question['id']; ?>">
                                                                        <div class="quest" style="width:70%">
                                                                            <span id="question_question_<?php echo $question['id']; ?>"><?php echo $question['question']; ?></span>
                                                                        </div>
                                                                        <div class="form-item">
                                                                            <input type="text" placeholder="score" value="<?php echo $question['score']; ?>" id="question_score_<?php echo $question['id']; ?>" onChange="updateQuestionScore(<?php echo $question['id']; ?>)">
                                                                        </div>
                                                                        <div>
                                                                            <button class="btn btn-primary btn-sm" onClick="editQuestion(<?php echo $question['id']; ?>, <?php echo $unit['quiz_id']; ?>)"><i class="fa fa-edit"></i></button>
                                                                            <button class="btn btn-danger btn-sm" onClick="deleteQuestion(<?php echo $question['id']; ?>)"><i class="fa fa-trash-o"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    }
                                                                ?>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <!-- END / DC QUIZZ -->
                                                    <!-- ADD QUESTION POPUP -->
                                                    <div id="addquestion-<?php echo $unit['quiz_id']; ?>" class="design-course-popup zoom-anim-dialog mfp-hide">
                                                        <table class="pp-table">
                                                            <tbody>
                                                                <tr class="tr-title">
                                                                    <td class="label-info"><!-- <label for="">Title</label> --></td>
                                                                    <td class="td-form-item">
                                                                        <div class="form-item">
                                                                            <input type="hidden" name="question_id_<?php echo $unit['quiz_id']; ?>" id="question_id_<?php echo $unit['quiz_id']; ?>" value="">
                                                                            <!-- <input type="text" name="question_title_<?php echo $unit['quiz_id']; ?>" id="question_title_<?php echo $unit['quiz_id']; ?>" placeholder="Get your job done"> -->
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="tr-type">
                                                                    <td class="label-info"><label for="">Type of question</label></td>
                                                                    <td class="td-form-item">
                                                                        <div class="mc-select">
                                                                            <select class="select" name="question_type_<?php echo $unit['quiz_id']; ?>" id="question_type_<?php echo $unit['quiz_id']; ?>">
                                                                                <option value="1" selected>Multiple Choice</option>
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="tr-type">
                                                                    <td class="label-info"><label for="">Level of question</label></td>
                                                                    <td class="td-form-item">
                                                                        <div class="mc-select">
                                                                            <select class="select" name="question_level_<?php echo $unit['quiz_id']; ?>" id="question_level_<?php echo $unit['quiz_id']; ?>">
                                                                                <option value="0">Choose question level</option>
                                                                                <option value="1">Easy</option>
                                                                                <option value="2">Medium</option>
                                                                                <option value="3">Hard</option>  
                                                                            </select>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="tr-desc">
                                                                    <td class="label-info"><label for="">Question</label></td>
                                                                    <td class="td-form-item">
                                                                        <div class="form-textarea-wrapper">
                                                                            <textarea name="question_content_<?php echo $unit['quiz_id']; ?>" id="question_content_<?php echo $unit['quiz_id']; ?>" placeholder="Description here"></textarea>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="label-info"><label for="">Answer 1</label></td>
                                                                    <td class="td-form-item">
                                                                        <div class="form-item-wrap">
                                                                            <div class="form-item">
                                                                                <input type="text" name="question_answer_1_<?php echo $unit['quiz_id']; ?>" id="question_answer_1_<?php echo $unit['quiz_id']; ?>" placeholder="#1 Write answer here">
                                                                            </div>
                                                                            <div class="form-item form-checkbox checkbox-style">
                                                                                <input type="radio" id="istrue_answer_1_<?php echo $unit['quiz_id']; ?>" name="istrue_answer">
                                                                                <label for="istrue_answer_1_<?php echo $unit['quiz_id']; ?>"><i class="icon-checkbox icon md-check-1"></i>is answer</label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="label-info"><label for="">Answer 2</label></td>
                                                                    <td class="td-form-item">
                                                                        <div class="form-item-wrap">
                                                                            <div class="form-item"> 
                                                                                <input type="text" name="question_answer_2_<?php echo $unit['quiz_id']; ?>" id="question_answer_2_<?php echo $unit['quiz_id']; ?>" placeholder="#2 Write answer here">
                                                                            </div>
                                                                            <div class="form-item form-checkbox checkbox-style">                                                                                
                                                                                <input type="radio" id="istrue_answer_2_<?php echo $unit['quiz_id']; ?>" name="istrue_answer">
                                                                                <label for="istrue_answer_2_<?php echo $unit['quiz_id']; ?>"><i class="icon-checkbox icon md-check-1"></i>is answer</label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="label-info"><label for="">Answer 3</label></td>
                                                                    <td class="td-form-item">
                                                                        <div class="form-item-wrap">
                                                                            <div class="form-item">
                                                                                <input type="text" name="question_answer_3_<?php echo $unit['quiz_id']; ?>" id="question_answer_3_<?php echo $unit['quiz_id']; ?>" placeholder="#3 Write answer here">
                                                                            </div>
                                                                            <div class="form-item form-checkbox checkbox-style">
                                                                                <input type="radio" id="istrue_answer_3_<?php echo $unit['quiz_id']; ?>" name="istrue_answer">
                                                                                <label for="istrue_answer_3_<?php echo $unit['quiz_id']; ?>"><i class="icon-checkbox icon md-check-1"></i>is answer</label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="label-info"><label for="">Answer 4</label></td>
                                                                    <td class="td-form-item">
                                                                        <div class="form-item-wrap">
                                                                            <div class="form-item">
                                                                                <input type="text" name="question_answer_4_<?php echo $unit['quiz_id']; ?>" id="question_answer_4_<?php echo $unit['quiz_id']; ?>" placeholder="#4 Write answer here">
                                                                            </div>
                                                                            <div class="form-item form-checkbox checkbox-style">
                                                                                <input type="radio" id="istrue_answer_4_<?php echo $unit['quiz_id']; ?>" name="istrue_answer">
                                                                                <label for="istrue_answer_4_<?php echo $unit['quiz_id']; ?>"><i class="icon-checkbox icon md-check-1"></i>is answer</label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="label-info"><label for="">Answer 5</label></td>
                                                                    <td class="td-form-item">
                                                                        <div class="form-item-wrap">
                                                                            <div class="form-item">
                                                                                <input type="text" name="question_answer_5_<?php echo $unit['quiz_id']; ?>" id="question_answer_5_<?php echo $unit['quiz_id']; ?>" placeholder="#5 Write answer here">
                                                                            </div>
                                                                            <div class="form-item form-checkbox checkbox-style">
                                                                                <input type="radio" id="istrue_answer_5_<?php echo $unit['quiz_id']; ?>" name="istrue_answer">
                                                                                <label for="istrue_answer_5_<?php echo $unit['quiz_id']; ?>"><i class="icon-checkbox icon md-check-1"></i>is answer</label>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="tr-footer">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="submit" class="mc-btn-3 btn-style-1" onClick="saveQuestion(<?php echo $unit['quiz_id']; ?>)" value="Save question">
                                                                        <a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- END / ADD QUESTION POPUP -->
                                                    <?php
                                                } else {
                                                    ?>  
                                                    <div class="dc-unit-info dc-course-item" id="dc-unit-info-<?php echo $unit['id'];?>">
                                                        <div class="dc-content-title">
                                                            <h5 class="xsm black"><span contenteditable="true" id="unit-title-<?php echo $unit['id'];?>" onBlur="editUnitTitle(<?php echo $unit['id'] ?>)"><?php echo $unit['topic'];?></span></h5>
                                                            <script>
                                                                 $("#unit-title-<?php echo $unit['id']; ?>").keypress(function(e) {
                                                                    if (e.which == 13 || e.which == 9) {
                                                                        editUnitTitle(<?php echo $unit['id']; ?>);
                                                                        e.preventDefault();
                                                                    }
                                                                });
                                                            </script>
                                                            <div class="course-region-tool">
                                                                <a style="cursor: pointer; cursor: hand;" class="save" title="save" onClick="editUnitTitle(<?php echo $unit['id'] ?>)"><i class="fa fa-save"></i></a>
                                                                <a style="cursor: pointer; cursor: hand;" class="delete" title="delete"><i class="icon md-recycle" onClick="deleteUnit(<?php echo $unit['id']; ?>)"></i></a>
                                                            </div>
                                                        </div>

                                                        <div class="unit-body dc-item-body">
                                                            <table class="tb-course">
                                                                <tbody>
                                                                    <tr class="tr-file">
                                                                        <td class="label-info"><label for="">Reference file</label></td>
                                                                        <td class="td-form-item">
                                                                            <div class="form-item">
                                                                                <!--<input type="file" class="upload-file">-->
                                                                                <input type="file" name="ref_content_<?php echo $unit['id'] ?>" id="ref_content_<?php echo $unit['id'] ?>">
                                                                                <script>
                                                                                $(function() {
                                                                                    <?php $timestamp = time(); ?>
                                                                                    $('#ref_content_<?php echo $unit["id"] ?>').uploadify({
                                                                                        'swf'      : '<?php echo base_url(); ?>assets/theme/js/library/uploadify/uploadify.swf',
                                                                                        'uploader' : 'uploadCourseContent',
                                                                                        'method'   : 'post',
                                                                                        'formData' : { 
                                                                                                        'cid' : <?php echo $_GET['c']; ?>,
                                                                                                        'cur_id': <?php echo $section['id']; ?>,
                                                                                                        'id' : <?php echo $unit['id'] ?> 
                                                                                                        }, 
                                                                                        'onUploadSuccess' : function(file, data, response) {
                                                                                            if (data == '1') {
                                                                                                $('#name-file-<?php echo $unit["id"]; ?>').html(file.name);    
                                                                                                $('#size-file-<?php echo $unit["id"]; ?>').html(file.size);
                                                                                            } else {
                                                                                                //alert('The file ' + file.name + ' could not be uploaded: ' + data );
                                                                                                swal("Sorry...", "The file " + file.name + " could not be uploaded: " + data, "error");
                                                                                            }                
                                                                                        },
                                                                                        'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                                                                                            //alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
                                                                                            swal("Sorry...", "The file " + file.name + " could not be uploaded: " + errorString, "error");
                                                                                         },
                                                                                        // Put your options here
                                                                                    });
                                                                                });
                                                                                </script>
                                                                            </div>
                                                                            <a href="#" class="trigger-file">
                                                                                <?php 
                                                                                if ($unit['content_filename']) {
                                                                                    ?>
                                                                                    <span class="name-file" id="name-file-<?php echo $unit['id'] ?>"><?php echo $unit['content_filename']; ?></span>
                                                                                    <span class="size-file" id="size-file-<?php echo $unit['id'] ?>">( <?php echo round($unit['content_filesize']/1024, 2); ?> )</span>
                                                                                    <a href="#" class="close-file">
                                                                                        <i class="icon md-close-2"></i>
                                                                                    </a>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <span class="name-file" id="name-file-<?php echo $unit['id'] ?>"></span>
                                                                                    <span class="size-file" id="size-file-<?php echo $unit['id'] ?>"></span>
                                                                                    <?php      
                                                                                }
                                                                                ?>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td></td>
                                                                        <td>
                                                                            <div class="form-item form-checkbox checkbox-style">
                                                                                <input type="checkbox" id="content_is_free_<?php echo $unit['id']; ?>" class="click-preview" onClick="editUnitTitle(<?php echo $unit['id']?>)" <?php echo $unit['is_free'] ? 'checked' : '' ?>>
                                                                                <label for="content_is_free_<?php echo $unit['id']; ?>">
                                                                                    <i class="icon-checkbox icon md-check-1"></i>
                                                                                    Preview Available
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>

                                        <ul class="dc-btn">
                                            <li>
                                                <div class="add-unit">
                                                    <a href="#addunit-<?php echo $section['id'];?>" class="mc-btn-3 btn-style-7 popup-with-zoom-anim"><i class="icon md-plus"></i>Add Unit</a>
                                                    <div id="addunit-<?php echo $section['id'];?>" class="design-course-popup pp-add-section zoom-anim-dialog mfp-hide">
                                                        <label for="">Unit title</label>
                                                        <div class="form-item">
                                                            <input type="text" name="unit-title-section-<?php echo $section['id'];?>" id="unit-title-section-<?php echo $section['id'];?>">
                                                        </div>
                                                        <div class="pp-footer">
                                                            <input type="submit" class="mc-btn-3 btn-style-1" onClick="saveUnit(<?php echo $section['id'];?>, 0)" value="Save Unit">
                                                            <a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="add-quiz">
                                                    <a href="#addquiz-<?php echo $section['id'];?>" class="mc-btn-3 btn-style-7 popup-with-zoom-anim"><i class="icon md-plus"></i>Add Quiz</a>
                                                    <div id="addquiz-<?php echo $section['id'];?>" class="design-course-popup pp-add-section zoom-anim-dialog mfp-hide">
                                                        <label for="">Quiz title</label>
                                                        <div class="form-item">
                                                            <input type="text" name="quiz-title-section-<?php echo $section['id'];?>" id="quiz-title-section-<?php echo $section['id'];?>">
                                                        </div>
                                                        <div class="pp-footer">
                                                            <input type="submit" class="mc-btn-3 btn-style-1" onClick="saveQuiz(<?php echo $section['id'];?>)" value="Save Quiz">
                                                            <a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="add-livecourse">
                                                    <a href="#addlivecourse-<?php echo $section['id'];?>" class="mc-btn-3 btn-style-7 popup-with-zoom-anim"><i class="icon md-plus"></i>Add Live Course</a>
                                                    <div id="addlivecourse-<?php echo $section['id'];?>" class="design-course-popup pp-add-section zoom-anim-dialog mfp-hide">
                                                        <label for="">Live Course Title</label>
                                                        <div class="form-item">
                                                            <input type="text" name="unit-title-section-<?php echo $section['id'];?>" id="unit-title-section-<?php echo $section['id'];?>">
                                                        </div>
                                                        <div class="pp-footer">
                                                            <input type="submit" class="mc-btn-3 btn-style-1" onClick="saveUnit(<?php echo $section['id'];?>, 1)" value="Save">
                                                            <a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php
                                }
                                ?>
                                <!-- END / DC SECTION INFO -->

                            </div>
                            <!-- END / SECTIONS -->           

                            <!-- BUTTON ADD AND POPUP SECTION -->
                            <div class="add-section">
                                <a href="#addsection" class="mc-btn-3 btn-style-1 popup-with-zoom-anim"><i class="icon md-plus"></i>Add Section</a>
                                <div id="addsection" class="design-course-popup pp-add-section zoom-anim-dialog mfp-hide">
                                    <label for="">Section title</label>
                                    <div class="form-item">
                                        <input type="text" name="section-title" id="section-title">
                                    </div>
                                    <div class="pp-footer">
                                        <input type="submit" class="mc-btn-3 btn-style-1 save" value="Save Section">
                                        <a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END / BUTTON ADD AND POPUP SECTION -->                 
                            
                            <div style="text-align: center; border-top: 2px solid #eee; padding: 20px 0px;">
                                <a href="<?php echo base_url();?>course/cPublishCourse?c=<?php echo $_GET['c'] ?>" class="mc-btn-3 btn-style-1"> Next </a>
                            </div>

                        </div>
                        <!-- END / DESIGN OUTLINE -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END / CREATE COURSE CONTENT -->

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/theme/vendor/sweetalert/lib/sweet-alert.css" />

<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/vendor/sweetalert/lib/sweet-alert.min.js"></script>
<script type="text/javascript">

    function saveUnit(id, livecourse) {
        var title = $('#unit-title-section-'+id).val(); 

        var postData = {
          'title' : title,
          'livecourse' : livecourse, 
          'id' : id
        };

        $("#spinner").show();

        $.post('/course/saveCourseSectionUnit', postData, function(data){
            //This should be JSON preferably. but can't get it to work on jsfiddle
            //Depending on what your controller returns you can change the action
            if (data != '') {
                $("#spinner").hide(); 
                appendUnitSection(data, title, id, livecourse);
                $('.mfp-close').trigger('click');
            } else {
                //alert('Failed save unit');
                swal("Sorry...", "Save unit fail", "error");
            }
        });
    }

    function saveQuiz(id) {
        var title = $('#quiz-title-section-'+id).val(); 

        var postData = {
          'title' : title,
          'id' : id
        };

        $("#spinner").show();

        $.post('/course/saveCourseSectionQuiz', postData, function(data){
            //This should be JSON preferably. but can't get it to work on jsfiddle
            //Depending on what your controller returns you can change the action            
            if (data != '') {
                $("#spinner").hide(); 
                appendQuizSection(data, title, id);
                $('.mfp-close').trigger('click');
            } else {
                //alert('Failed save quiz');
                swal("Sorry...", "Save quiz fail", "error");
            }
            $("#spinner").hide();
        });
    }

    function appendUnitSection(id, title, idSection, livecourse) {
        var unitTemplate = '<div class="dc-unit-info dc-course-item" id="dc-unit-info-'+id+'">'+
                                '<div class="dc-content-title">'+
                                    '<h5 class="xsm black"><span contenteditable="true" id="unit-title-'+id+'" onBlur="editUnitTitle('+id+')">'+title+'</span></h5>'+
                                    '<script>'+
                                         '$("#unit-title-'+id+'").keypress(function(e) {'+
                                            'if (e.which == 13 || e.which == 9) {'+
                                                'editUnitTitle('+id+');'+
                                                'e.preventDefault();'+
                                            '}'+
                                        '});'+
                                    '</scr'+'ipt>'+
                                    '<div class="course-region-tool">'+
                                        '<a style="cursor: pointer; cursor: hand;" class="save" title="save"><i class="fa fa-save" onClick="editUnitTitle('+id+')"></i></a>'+
                                        '<a style="cursor: pointer; cursor: hand;" class="delete" title="delete"><i class="icon md-recycle" onClick="deleteUnit('+id+')"></i></a>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="unit-body dc-item-body">'+
                                    '<table class="tb-course">'+
                                        '<tbody>'+
                                            '<tr class="tr-file">'+
                                                '<td class="label-info"><label for="">Reference file</label></td>'+
                                                '<td class="td-form-item">'+
                                                    '<div class="form-item">'+
                                                        '<input type="file" name="ref_content_'+id+'" id="ref_content_'+id+'">'+
                                                        '<div id="file_ref_content_'+id+'"></div>'+
                                                        '<script>'+
                                                            '$(function() {'+
                                                                '$("#ref_content_'+id+'").uploadify({'+
                                                                    '"swf"      : "<?php echo base_url(); ?>assets/theme/js/library/uploadify/uploadify.swf",'+
                                                                    '"uploader" : "uploadCourseContent",'+
                                                                    '"method"   : "post",'+
                                                                    '"formData" : { '+
                                                                                    '"cid" : "<?php echo $_GET["c"]; ?>",'+
                                                                                    '"cur_id": "'+idSection+'", '+
                                                                                    '"id" : "'+id+'"'+
                                                                                    '}, '+
                                                                    '"onUploadSuccess" : function(file, data, response) {'+
                                                                        'if (data == 1) {'+
                                                                            '$("#name-file-'+id+'").html(file.name); '+   
                                                                            '$("#size-file-'+id+'").html(file.size); '+
                                                                        '} else {'+
                                                                            'swal("Sorry...", "The file " + file.name + " could not be uploaded: " + data, "error"); '+
                                                                        '}'+
                                                                    '},'+
                                                                    '"onUploadError" : function(file, errorCode, errorMsg, errorString) { '+
                                                                        'swal("Sorry...", "The file " + file.name + " could not be uploaded: " + errorString, "error"); '+
                                                                    '}, '+
                                                                '});'+
                                                            '});'+
                                                        '</scr'+'ipt>'+
                                                    '</div>'+
                                                    '<a href="#" class="trigger-file">'+
                                                        '<span class="name-file" id="name-file-'+id+'"></span>'+
                                                        '<span class="size-file" id="size-file-'+id+'"></span>'+
                                                    '</a>'+
                                                '</td>'+
                                            '</tr>'+
                                            '<tr>'+
                                            '<td></td>'+
                                            '<td>'+
                                                '<div class="form-item form-checkbox checkbox-style">'+
                                                    '<input type="checkbox" id="content_is_free_'+id+'" onClick="editUnitTitle('+id+')">'+
                                                    '<label for="content_is_free_'+id+'">'+
                                                        '<i class="icon-checkbox icon md-check-1"></i> Preview Available'+
                                                    '</label>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>'+
                                    '</tbody>'+
                                '</table>'+                                
                            '</div>'+
                        '</div>';
        var unitTemplateLive = '<div class="dc-unit-info dc-course-item" id="dc-unit-info-'+id+'">'+
                                    '<div class="dc-content-title">'+
                                        '<h5 class="xsm black"><span contenteditable="true" id="unit-title-'+id+'" onBlur="editUnitTitle('+id+')">'+title+'</span></h5>'+
                                        '<script>'+
                                             '$("#unit-title-'+id+'").keypress(function(e) {'+
                                                'if (e.which == 13 || e.which == 9) {'+
                                                    'editUnitTitle('+id+');'+
                                                    'e.preventDefault();'+
                                                '}'+
                                            '});'+
                                        '</scr'+'ipt>'+
                                        '<div class="course-region-tool">'+
                                            '<span>(Live Course)</span>'+
                                            '<a style="cursor: pointer; cursor: hand;" class="save" title="save"><i class="fa fa-save" onClick="editUnitTitle('+id+')"></i></a>'+
                                            '<a style="cursor: pointer; cursor: hand;" class="delete" title="delete"><i class="icon md-recycle" onClick="deleteUnit('+id+')"></i></a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
        if (livecourse == 1) {
            $('#dc-section-body-'+idSection).append(unitTemplateLive);
        } else {
            $('#dc-section-body-'+idSection).append(unitTemplate);
        }
        
    }

    function appendQuizSection(id, title, idSection) {
        var quizTemplate = '<!-- DC QUIZZ -->'+
                            '<div class="dc-quizz-info dc-course-item" id="dc-quizz-info-'+id+'">'+
                                '<div class="dc-content-title">'+
                                    '<h5 class="xsm black"><span contenteditable="true" id="quiz-title-'+id+'" onBlur="editQuiz('+id+')">'+title+'</span></h5>'+
                                    '<script>'+
                                         '$("#quiz-title-'+id+'").keypress(function(e) {'+
                                            'if (e.which == 13 || e.which == 9) {'+
                                                'editQuiz('+id+');'+
                                                'e.preventDefault();'+
                                            '}'+
                                        '});'+
                                    '</scr'+'ipt>'+
                                    '<div class="course-region-tool">'+
                                        '<a style="cursor: pointer; cursor: hand;" class="save" title="save" onClick="editQuiz('+id+')"><i class="fa fa-save"></i></a>'+
                                        '<a style="cursor: pointer; cursor: hand;" class="delete" title="delete" onClick="deleteQuiz('+id+')"><i class="icon md-recycle"></i></a>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="quizz-body dc-item-body" id="quizz-body-'+id+'">'+
                                    '<div class="btn-add">'+
                                        '<a href="#addquestion-'+id+'" class="popup-with-zoom-anim">'+
                                            '<i class="icon md-plus"></i> Add Question'+
                                        '</a>'+
                                    '</div>'+
                                    '<div class="form-item form-checkbox checkbox-style">'+
                                        '<input type="checkbox" id="quiz-timelimit-'+id+'" onChange="editQuiz('+id+')">'+
                                        '<label for="quiz-timelimit-'+id+'"><i class="icon-checkbox icon md-check-1"></i> Limit time</label>'+
                                    '</div>'+
                                    '<div class="time">'+
                                        '<div class="form-item">'+
                                            '<input type="text" id="quiz-lifetime-'+id+'" onChange="editQuiz('+id+')">'+
                                            '<label for="">mins</label>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row">'+
                                        '<label class="col-md-1" style="margin-top:7px;">Easy</label>'+
                                        '<div class="col-md-3">'+
                                            '<input type="text" class="form-control" id="total_easy_question_'+id+'" name="total_easy_question_'+id+'" placeholder="Total easy question" onChange="editQuiz('+id+')">'+
                                        '</div>'+
                                        '<label class="col-md-1" style="margin-top:7px;">Medium</label>'+
                                        '<div class="col-md-3">'+
                                            '<input type="text" class="form-control" id="total_medium_question_'+id+'" name="total_medium_question_'+id+'" placeholder="Total medium question" onChange="editQuiz('+id+')">'+
                                        '</div>'+
                                        '<label class="col-md-1" style="margin-top:7px;">Hard</label>'+
                                        '<div class="col-md-3">'+
                                            '<input type="text" class="form-control" id="total_hard_question_'+id+'" name="total_hard_question_'+id+'" placeholder="Total hard question" onChange="editQuiz('+id+')">'+
                                        '</div>'+
                                    '</div>'+
                                    '<br>'+
                                    '<div class="form-item">'+
                                        '<input type="text" id="quiz-intro-'+id+'" placeholder="Short introduction ( optional)" class="fullwidth" onChange="editQuiz('+id+')">'+
                                    '</div>'+
                                    '<div class="form-item-wrap" id="quiz-answer-'+id+'">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<!-- END / DC QUIZZ -->'+
                            '<!-- ADD QUESTION POPUP -->'+
                            '<div id="addquestion-'+id+'" class="design-course-popup zoom-anim-dialog mfp-hide">'+
                                '<table class="pp-table">'+
                                    '<tbody>'+
                                        '<tr class="tr-title">'+
                                            // '<td class="label-info"><label for="">Title</label></td>'+
                                            '<td class="td-form-item">'+
                                                '<div class="form-item">'+
                                                    '<input type="hidden" name="question_id_'+id+'" id="question_id_'+id+'">'+
                                                    // '<input type="text" name="question_title_'+id+'" id="question_title_'+id+'" placeholder="Get your job done">'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>'+   
                                        '<tr class="tr-type">'+
                                            '<td class="label-info"><label for="">Type of question</label></td>'+
                                            '<td class="td-form-item">'+
                                                '<div class="mc-select">'+
                                                    '<select class="select" name="question_type_'+id+'" id="question_type_'+id+'">'+
                                                        '<option value="1" selected>Multiple Choice</option>'+
                                                    '</select>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr class="tr-type">'+
                                            '<td class="label-info"><label for="">Level of question</label></td>'+
                                            '<td class="td-form-item">'+
                                                '<div class="mc-select">'+
                                                    '<select class="select" name="question_level_'+id+'" id="question_level_'+id+'">'+
                                                        '<option value="0">Choose question Level</option>'+
                                                        '<option value="1">Easy</option>'+
                                                        '<option value="2">Medium</option>'+
                                                        '<option value="3">Hard</option>'+
                                                    '</select>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr class="tr-desc">'+
                                            '<td class="label-info"><label for="">Question</label></td>'+
                                            '<td class="td-form-item">'+
                                                '<div class="form-textarea-wrapper">'+
                                                    '<textarea name="question_content_'+id+'" id="question_content_'+id+'" placeholder="Description here"></textarea>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td class="label-info"><label for="">Answer 1</label></td>'+
                                            '<td class="td-form-item">'+
                                                '<div class="form-item-wrap">'+
                                                    '<div class="form-item">'+
                                                        '<input type="text" name="question_answer_1_'+id+'" id="question_answer_1_'+id+'" placeholder="#1 Write answer here">'+
                                                    '</div>'+
                                                    '<div class="form-item form-checkbox checkbox-style">'+
                                                        '<input type="radio" id="istrue_answer_1_'+id+'" class="click-preview" name="istrue_answer">'+
                                                        '<label for="istrue_answer_1_'+id+'"><i class="icon-checkbox icon md-check-1"></i>is answer</label>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td class="label-info"><label for="">Answer 2</label></td>'+
                                            '<td class="td-form-item">'+
                                                '<div class="form-item-wrap">'+
                                                    '<div class="form-item">'+
                                                        '<input type="text" name="question_answer_2_'+id+'" id="question_answer_2_'+id+'" placeholder="#2 Write answer here">'+
                                                    '</div>'+
                                                    '<div class="form-item form-checkbox checkbox-style">'+
                                                        '<input type="radio" id="istrue_answer_2_'+id+'" class="click-preview" name="istrue_answer">'+
                                                        '<label for="istrue_answer_2_'+id+'"><i class="icon-checkbox icon md-check-1"></i>is answer</label>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td class="label-info"><label for="">Answer 3</label></td>'+
                                            '<td class="td-form-item">'+
                                                '<div class="form-item-wrap">'+
                                                    '<div class="form-item">'+
                                                        '<input type="text" name="question_answer_3_'+id+'" id="question_answer_3_'+id+'" placeholder="#3 Write answer here">'+
                                                    '</div>'+
                                                    '<div class="form-item form-checkbox checkbox-style">'+
                                                        '<input type="radio" id="istrue_answer_3_'+id+'" class="click-preview" name="istrue_answer">'+
                                                        '<label for="istrue_answer_3_'+id+'"><i class="icon-checkbox icon md-check-1"></i>is answer</label>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td class="label-info"><label for="">Answer 4</label></td>'+
                                            '<td class="td-form-item">'+
                                                '<div class="form-item-wrap">'+
                                                    '<div class="form-item">'+
                                                        '<input type="text" name="question_answer_4_'+id+'" id="question_answer_4_'+id+'" placeholder="#4 Write answer here">'+
                                                    '</div>'+
                                                    '<div class="form-item form-checkbox checkbox-style">'+
                                                        '<input type="radio" id="istrue_answer_4_'+id+'" class="click-preview" name="istrue_answer">'+
                                                        '<label for="istrue_answer_4_'+id+'"><i class="icon-checkbox icon md-check-1"></i>is answer</label>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr>'+
                                            '<td class="label-info"><label for="">Answer 5</label></td>'+
                                            '<td class="td-form-item">'+
                                                '<div class="form-item-wrap">'+
                                                    '<div class="form-item">'+
                                                        '<input type="text" name="question_answer_5_'+id+'" id="question_answer_5_'+id+'" placeholder="#5 Write answer here">'+
                                                    '</div>'+
                                                    '<div class="form-item form-checkbox checkbox-style">'+
                                                        '<input type="radio" id="istrue_answer_5_'+id+'" class="click-preview" name="istrue_answer">'+
                                                        '<label for="istrue_answer_5_'+id+'"><i class="icon-checkbox icon md-check-1"></i>is answer</label>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>'+
                                        '<tr class="tr-footer">'+
                                            '<td></td>'+
                                            '<td>'+
                                                '<input type="submit" class="mc-btn-3 btn-style-1" onClick="saveQuestion('+id+')" value="Save question">'+
                                                '<a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>'+
                                            '</td>'+
                                        '</tr>'+
                                    '</tbody>'+
                                '</table>'+
                            '</div>'+
                            '<!-- END / ADD QUESTION POPUP -->';
        $('#dc-section-body-'+idSection).append(quizTemplate);

        if ($('.popup-with-zoom-anim').length) {
            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',

                fixedContentPos: false,
                fixedBgPos: true,

                overflowY: 'auto',

                closeBtnInside: true,
                preloader: false,

                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });
            $('.design-course-popup').delegate('.cancel', 'click', function(evt) {
                evt.preventDefault();
                $('.mfp-close').trigger('click');
            });
        }
    }

    function appendSection(id, title) {
        var sectionTemplate = '<div class="dc-section-info" id="dc-section-info-'+id+'">'+
                                    '<div class="title-section">'+
                                        '<h4 class="xsm"><span contenteditable="true" id="section-title-'+id+'" onBlur="editSectionTitle('+id+')">'+title+'</span></h4>'+
                                        '<script>'+
                                             '$("#section-title-<?php echo $section['id'];?>").keypress(function(e) {'+
                                                'if (e.which == 13 || e.which == 9) {'+
                                                    'editSectionTitle('+id+');'+
                                                    'e.preventDefault();'+
                                                '}'+
                                            '});'+
                                        '</scr'+'ipt>'+
                                        '<div class="course-region-tool">'+
                                            '<a style="cursor: pointer; cursor: hand;" class="save" title="save" onClick="editSectionTitle('+id+')"><i class="fa fa-save"></i></a>'+
                                            '<a style="cursor: pointer; cursor: hand;" class="delete" title="delete" onClick="deleteSection('+id+')"><i class="icon md-recycle"></i></a>'+
                                            '<a style="cursor: pointer; cursor: hand;"id="toggle-section-'+id+'" class="toggle-section active"  onClick="showHideSection('+id+')"><i class="fa fa-caret-right"></i></a>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="dc-section-body" id="dc-section-body-'+id+'">'+
                                    '</div>'+
                                    '<ul class="dc-btn">'+
                                        '<li>'+
                                            '<div class="add-unit">'+
                                                '<a href="#addunit-'+id+'" class="mc-btn-3 btn-style-7 popup-with-zoom-anim"><i class="icon md-plus"></i>Add Unit</a>'+
                                                '<div id="addunit-'+id+'" class="design-course-popup pp-add-section zoom-anim-dialog mfp-hide">'+
                                                    '<label for="">Unit title</label>'+
                                                    '<div class="form-item">'+
                                                        '<input type="text" name="unit-title-section-'+id+'" id="unit-title-section-'+id+'">'+
                                                    '</div>'+
                                                    '<div class="pp-footer">'+
                                                        '<input type="submit" class="mc-btn-3 btn-style-1" onClick="saveUnit('+id+', 0)" value="Save Unit">'+
                                                        '<a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</li>'+
                                        '<li>'+
                                            '<div class="add-quiz">'+
                                                '<a href="#addquiz-'+id+'" class="mc-btn-3 btn-style-7 popup-with-zoom-anim"><i class="icon md-plus"></i>Add Quiz</a>'+
                                                '<div id="addquiz-'+id+'" class="design-course-popup pp-add-section zoom-anim-dialog mfp-hide">'+
                                                    '<label for="">Quiz title</label>'+
                                                    '<div class="form-item">'+
                                                        '<input type="text" name="quiz-title-section-'+id+'" id="quiz-title-section-'+id+'">'+
                                                    '</div>'+
                                                    '<div class="pp-footer">'+
                                                        '<input type="submit" class="mc-btn-3 btn-style-1" onClick="saveQuiz('+id+')" value="Save Quiz">'+
                                                        '<a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</li>'+
                                        '<li>'+
                                            '<div class="add-livecourse">'+
                                                '<a href="#addlivecourse-'+id+'" class="mc-btn-3 btn-style-7 popup-with-zoom-anim"><i class="icon md-plus"></i>Add Live Course</a>'+
                                                '<div id="addlivecourse-'+id+'" class="design-course-popup pp-add-section zoom-anim-dialog mfp-hide">'+
                                                    '<label for="">Live Course Title</label>'+
                                                    '<div class="form-item">'+
                                                        '<input type="text" name="unit-title-section-'+id+'" id="unit-title-section-'+id+'">'+
                                                    '</div>'+
                                                    '<div class="pp-footer">'+
                                                        '<input type="submit" class="mc-btn-3 btn-style-1" onClick="saveUnit('+id+', 1)" value="Save">'+
                                                        '<a href="#" class="cancel mc-btn-3 btn-style-5">Cancel</a>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</li>'+
                                    '</ul>'+
                                '</div>';

        $('#dc-sections-area').append(sectionTemplate);

        if ($('.popup-with-zoom-anim').length) {
            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',

                fixedContentPos: false,
                fixedBgPos: true,

                overflowY: 'auto',

                closeBtnInside: true,
                preloader: false,

                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });
            $('.design-course-popup').delegate('.cancel', 'click', function(evt) {
                evt.preventDefault();
                $('.mfp-close').trigger('click');
            });
        }        
    }

    function editSectionTitle(id) {
        var title = $('#section-title-'+id)[0].innerText;
        var id = id;

        var postData = {
          'title' : title,
          'id' : id
        };
        $("#spinner").show();

        $.post('/course/editCourseSection', postData, function(data){
            //This should be JSON preferably. but can't get it to work on jsfiddle
            //Depending on what your controller returns you can change the action
            $("#spinner").hide();
            if (data == 'fail') { 
                //alert('Failed update section');
                swal("Sorry...", "Update section fail", "error");
            }
        });
    }

    function editUnitTitle(id) {

        var postData = {
          'title' : $('#unit-title-'+id)[0].innerText,
          'content_is_free' : $('#content_is_free_'+id).is(':checked') ? '1' : '0',
          'id' : id
        };

        $("#spinner").show();

        $.post('/course/editCourseSectionUnit', postData, function(data){
            //This should be JSON preferably. but can't get it to work on jsfiddle
            //Depending on what your controller returns you can change the action
            $("#spinner").hide();
            if (data == 'fail') { 
                //alert('Failed update unit');
                swal("Sorry...", "Update unit fail", "error");
            }
        });
    }    

    if ($('.popup-with-zoom-anim').length) {
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',

            fixedContentPos: false,
            fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: true,
            preloader: false,

            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });
        $('.design-course-popup').delegate('.cancel', 'click', function(evt) {
            evt.preventDefault();
            $('.mfp-close').trigger('click');
        });

        $('.design-course-popup').delegate('.save', 'click', function(evt) {
            evt.preventDefault();
            if ($("#section-title").val() != "") {
                var title = $("#section-title").val(); 
                var cid =  <?php echo $_GET['c'];?>;

                var postData = {
                  'title' : title,
                  'cid' : cid
                };

                $("#spinner").show();

                $.post('/course/saveCourseSection', postData, function(data){
                    //This should be JSON preferably. but can't get it to work on jsfiddle
                    //Depending on what your controller returns you can change the action
                    if (data != '') {
                        $("#spinner").hide(); 
                        appendSection(data, title);
                        $('.mfp-close').trigger('click');
                    } else {
                        //alert('Failed save section');
                        swal("Sorry...", "Save section fail", "error");
                    }
                });
            } else {
                $("#section-title").attr("class", "error");
                $("#section-title").attr("placeholder", "Please enter section title");
            }
        });
    }

    function deleteSection(id) {
        swal({
                title: "Are you sure?",
                text: "You cannot rollback this process!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                cancelButtonText: "No"
            },
            function () {
                var postData = {
                  'id' : id
                };

                $("#spinner").show();

                $.post('/course/deleteCourseSection', postData, function(res){
                    //This should be JSON preferably. but can't get it to work on jsfiddle
                    //Depending on what your controller returns you can change the action
                    if (res) { 
                        $("#spinner").hide();
                        $('#dc-section-info-'+id).remove();
                    } else {
                        //alert('Failed delete section');
                        swal("Sorry...", "Delete section fail", "error");
                    }
                });
            });
    }

    function deleteUnit(id) {
        swal({
                title: "Are you sure?",
                text: "You cannot rollback this process!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                cancelButtonText: "No"
            },
            function () {
                var postData = {
                  'id' : id
                };

                $("#spinner").show();

                $.post('/course/deleteCourseSectionUnit', postData, function(res){
                    //This should be JSON preferably. but can't get it to work on jsfiddle
                    //Depending on what your controller returns you can change the action
                    if (res) { 
                        $("#spinner").hide();
                        $('#dc-unit-info-'+id).remove();
                    } else {
                        //alert('Failed delete unit');
                        swal("Sorry...", "Failed delete unit", "error");
                    }
                });
            });
    }

    function uploadContent(id) {
        <?php $timestamp = time(); ?>
        $('#ref_content_'+id).uploadify({
            'swf'      : '<?php echo base_url(); ?>assets/theme/js/library/uploadify/uploadify.swf',
            'uploader' : 'uploadCourseContent',
            'method'   : 'post',
            'formData' : { 
                            'timestamp' : '<?php echo $timestamp; ?>', 
                            'token' : '<?php echo md5("unique_hash".$timestamp); ?>',
                            'id' : id 
                            }, 
            'onUploadSuccess' : function(file, data, response) {
                if (data == '1') {
                    $('#file_ref_content_').html(file.name);    
                } else {
                    //alert('The file ' + file.name + ' could not be uploaded: ' + data );
                    swal("Sorry...", "The file " + file.name + " could not be uploaded: " + data, "error");
                }                
            },
            'onUploadError' : function(file, errorCode, errorMsg, errorString) {
                //alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
                swal("Sorry...", "The file " + file.name + " could not be uploaded: " + errorString, "error");
             },
            // Put your options here
        });
    }

    function contentPreview(id, th) {
        console.log(th);
    }

    function showHideSection(id) {
        if ($('#toggle-section-'+id).hasClass('active')) {
            $('#toggle-section-'+id).removeClass('active');
            $('#dc-section-body-'+id).hide();
        } else {
            $('#toggle-section-'+id).addClass('active');
            $('#dc-section-body-'+id).show();
        }
    }

    function editQuiz(id) {
        var postData = {
            'title' : $('#quiz-title-'+id)[0].innerText, 
            'timelimit' : $('#quiz-timelimit-'+id).is(':checked') ? 1 : 0, 
            'lifetime' : $('#quiz-lifetime-'+id).val(), 
            'total_easy_question' : $('#total_easy_question_'+id).val(), 
            'total_medium_question' : $('#total_medium_question_'+id).val(), 
            'total_hard_question' : $('#total_hard_question_'+id).val(), 
            'intro' : $('#quiz-intro-'+id).val(), 
            'id' : id
        };

        $("#spinner").show();
        
        $.post('/course/editCourseSectionQuiz', postData, function(data){
            //This should be JSON preferably. but can't get it to work on jsfiddle
            //Depending on what your controller returns you can change the action
            if (data == 'fail') { 
                $("#spinner").hide();
                //alert('Failed update quiz');
                swal("Sorry...", "Update quiz fail", "error");
            } else {
                //alert('Success update quiz');
                $("#spinner").hide();
                swal("Congratulations", "Update quiz success", "info");
            }
            $("#spinner").hide();
        });
        
    }

    function updateQuestionScore(id) {
        var postData = {
            'score' : $('#question_score_'+id).val(),
            'id' : id
        };

        $("#spinner").show();

        $.post('/course/updateQuestionScore', postData, function(data){
            //This should be JSON preferably. but can't get it to work on jsfiddle
            //Depending on what your controller returns you can change the action
            if (data != '') {
                $("#spinner").hide(); 
                console.log('update score success');
            } else {
                //alert('Failed save question');
                swal("Sorry...", "Update quiz fail", "error");
            }
        });
    }

    function appendQuestion(quizId, question, id) {
        var questionTemplate = '<div class="form-items" id="area-question-'+id+'">'+
                                    '<div class="quest" style="width:70%">'+
                                        '<span id="question_question_'+id+'">'+question+'</span>'+
                                    '</div>'+
                                    '<div class="form-item">'+
                                        '<input type="text" placeholder="score" id="question_score_'+id+'" onChange="updateQuestionScore('+id+')">'+
                                    '</div>'+
                                    '<div>'+
                                        '<button class="btn btn-primary btn-sm" onClick="editQuestion('+id+', '+quizId+')"><i class="fa fa-edit"></i></button>'+
                                        '<button class="btn btn-danger btn-sm" onClick="deleteQuestion('+id+')"><i class="fa fa-trash-o"></i></button>'+
                                    '</div>'
                                '</div>';

        $('#quiz-answer-'+quizId).append(questionTemplate);
    }

    function saveQuestion(id) {
        var quizId = id,
            question = $('#question_content_'+id).val(), 
            questionId = $('#question_id_'+id).val(), 
            title = '',
            type = $('#question_type_'+id).val(), 
            level = $('#question_level_'+id).val(), 
            ans1 = $('#question_answer_1_'+id).val(), 
            ans1_istrue = $('#istrue_answer_1_'+id).is(':checked') ? 1 : 0, 
            ans2 = $('#question_answer_2_'+id).val(), 
            ans2_istrue = $('#istrue_answer_2_'+id).is(':checked') ? 1 : 0, 
            ans3 = $('#question_answer_3_'+id).val(), 
            ans3_istrue = $('#istrue_answer_3_'+id).is(':checked') ? 1 : 0, 
            ans4 = $('#question_answer_4_'+id).val(), 
            ans4_istrue = $('#istrue_answer_4_'+id).is(':checked') ? 1 : 0, 
            ans5 = $('#question_answer_5_'+id).val(), 
            ans5_istrue = $('#istrue_answer_5_'+id).is(':checked') ? 1 : 0;


        var postData = {
            'title' : title,
            'type' : type, 
            'level' : level, 
            'content' : question,
            'ans1' : ans1, 
            'ans1_istrue' : ans1_istrue, 
            'ans2' : ans2, 
            'ans2_istrue' : ans2_istrue,
            'ans3' : ans3, 
            'ans3_istrue' : ans3_istrue, 
            'ans4' : ans4, 
            'ans4_istrue' : ans4_istrue, 
            'ans5' : ans5, 
            'ans5_istrue' : ans5_istrue, 
            'quizId' : quizId, 
            'questionId' : questionId, 
        };

        $("#spinner").show();

        $.post('/course/saveQuizQuestion', postData, function(data){
            //This should be JSON preferably. but can't get it to work on jsfiddle
            //Depending on what your controller returns you can change the action            
            data = $.parseJSON(data);

            if (data.questionId != '') {
                $("#spinner").hide();
                if (questionId == '') {
                    appendQuestion(data.quizId, data.question, data.questionId);
                } else {
                    $('#question_question_'+data.questionId).html(data.question);
                }

                $('#question_content_'+id).val('');
                $('#question_id_'+id).val('');
                $('#question_title_'+id).val('');
                $('#question_answer_1_'+id).val('');
                $('#istrue_answer_1_'+id).attr("checked", false);
                $('#question_answer_2_'+id).val('');
                $('#istrue_answer_2_'+id).attr("checked", false);
                $('#question_answer_3_'+id).val('');
                $('#istrue_answer_3_'+id).attr("checked", false);
                $('#question_answer_4_'+id).val('');
                $('#istrue_answer_4_'+id).attr("checked", false);
                $('#question_answer_5_'+id).val('');
                $('#istrue_answer_5_'+id).attr("checked", false);

                $('.mfp-close').trigger('click');
            } else {
                //alert('Failed save question');
                swal("Sorry...", "Save quiz fail", "error");
            }
        });
    }

    function deleteQuiz(id) {
        swal({
                title: "Are you sure?",
                text: "You cannot rollback this process!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                cancelButtonText: "No"
            },
            function () {
                var postData = {
                  'id' : id
                };

                $("#spinner").show();

                $.post('/course/deleteCourseSectionQuiz', postData, function(res){
                    //This should be JSON preferably. but can't get it to work on jsfiddle
                    //Depending on what your controller returns you can change the action
                    if (res) { 
                        $("#spinner").hide();
                        $('#dc-quizz-info-'+id).remove();
                    } else {
                        //alert('Failed delete unit');
                        swal("Sorry...", "Delete unit fail", "error");
                    }
                });
            });
    }

    function editQuestion(questionId, quizId) {
        $('#button-add-question-'+quizId).trigger('click');
        $.get('/course/detailQuizQuestion?id='+questionId, function( data ) {
            data = $.parseJSON(data);
            $('#question_content_'+quizId).val(data.question);
            $('#question_title_'+quizId).val(data.title);
            $('#question_type_'+quizId).val(data.type);
            $('#question_level_'+quizId).val(data.question_weight);
            $('#question_id_'+quizId).val(data.id);

            i = 1;
            $.each (data.answers, function(key, ans) {
                $('#question_answer_'+i+'_'+quizId).val(ans.answer);
                if (ans.is_true == 1) {                    
                    $('#istrue_answer_'+i+'_'+quizId).attr("checked", true);
                }
                i++;
            });
        });
    }

    function deleteQuestion(id) {
        swal({
                title: "Are you sure?",
                text: "You cannot rollback this process!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Delete!",
                cancelButtonText: "No"
            },
            function () {
                var postData = {
                  'id' : id
                };

                $("#spinner").show();

                $.post('/course/deleteQuestion', postData, function(res){
                    //This should be JSON preferably. but can't get it to work on jsfiddle
                    //Depending on what your controller returns you can change the action
                    if (res) { 
                        $("#spinner").hide();
                        $('#area-question-'+id).remove();
                    } else {
                        //alert('Failed delete question');
                        swal("Sorry...", "Delete question fail", "error");
                    }
                });
            });
    }
    
</script> 

<?php echo $footer; ?>