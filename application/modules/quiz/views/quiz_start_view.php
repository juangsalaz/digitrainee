<?php echo $header;?>
<section id="quizz-intro-section" class="quizz-intro-section learn-section">
        <div class="container">
            <div class="title-ct">
                <h3><?php echo $data_quiz[0]['title']; ?></h3>
                <input id="timelimit" value="<?php echo $data_quiz[0]['lifetime'];?>" style="display: none;">
                <div class="tt-right">
                    <a href="#" class="skip"><i class="icon md-arrow-right"></i>Skip quizz</a>
                </div>
            </div>
            <div class="question-content-wrap">
                <div class="row">
                    <div class="col-md-8">
                        <div class="question-content">
                            <?php 
                                $a = 1;
                                foreach ($data_all_question as $all_question) {
                                   if ($all_question['id'] == $data_question[0]['id']) {
                            ?>
                                        <p>Time remaining <span id="time">--:--</span> minutes</p>
                                        <h4 class="sm">Question <?php echo $a;?> - Multiple choice</h4>
                                        <p><?php echo $data_question[0]['question'];?></p>
                                        <input type="text" value="<?php echo $data_question[0]['id'];?>" id="question_id" style="display: none;">
                            <?php  
                                   }
                                   $a++;
                                }
                            ?>
                            <div class="answer">
                                <h4 class="sm">Answer</h4>
                                <ul class="answer-list">
                                    <?php 
                                        $i = 1;
                                        foreach ($data_answer as $answer) {
                                    ?>
                                            <li>
                                                <input type="radio" name="radio_answer" id="radio-<?php echo $answer['id'];?>" value="<?php echo $answer['id'];?>">
                                                <label for="radio-<?php echo $answer['id'];?>">
                                                    <i class="icon icon_radio"></i>
                                                    <?php 
                                                        echo $answer['answer'];
                                                    ?>
                                                </label>
                                            </li>
                                    <?php
                                            $i++;
                                        }
                                    ?>
                                </ul>

                            </div>
                            <?php
                                if (!empty($prev)) {
                            ?>
                                    <a href="#" class="mc-btn btn-style-6" id="prev">Previous question</a>
                            <?php
                                } if (!empty($next)) {
                            ?>
                                    <a href="#" class="mc-btn btn-style-6" id="next">Next question</a>
                            <?php
                                } else {
                            ?>
                                    <a href="#" class="mc-btn btn-style-6 submit-quiz">Submit and Finish</a>
                            <?php
                                }
                            ?>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <aside class="question-sidebar">
                            <div class="score-sb">
                                <h4 class="title-sb sm bold">Total score<span><?php echo $data_quiz[0]['total_score']; ?></span></h4>
                                <ul>
                                    <?php 
                                        $l = 1;
                                        foreach ($data_all_question as $question) {
                                            if (!isset($data_all_question[$l]['status'])) {

                                                if ($question['id'] == $question_id) {
                                                    $data_all_question[$l]['status'] = "past";
                                    ?>
                                                    <li class="active">
                                                        <i class="icon"></i>Question <?php echo $l; ?><span><?php echo $question['score']; ?></span>
                                                    </li>
                                    <?php          
                                                } else {
                                                
                                    ?>
                                                    <li>
                                                        <i class="icon"></i>Question <?php echo $l; ?><span><?php echo $question['score']; ?></span>
                                                    </li>
                                    <?php
                                                }
                                            } else {
                                    ?>
                                                <li class="val">
                                                    <i class="icon"></i>Question <?php echo $l; ?><span><?php echo $question['score']; ?></span>
                                                </li>
                                    <?php
                                            }
                                            $l++;
                                        }
                                    ?>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade bs-example-modal-sm" id="myModal_c" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" style="margin: 250px auto 0 auto;">
        <div class="modal-content">
            <form crole="form" method="post" action="<?php echo base_url();?>index.php/quiz/quizTimeout">
                <div class="modal-body">
                    <input type="text" name="quiz_id" value="<?php echo $quiz_id; ?>" style="display: none;">
                    <p>Sorry, your time is up</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="save_modal_anggota_c">Ok</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END / PAGE WRAP -->

<!-- Load jQuery -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery.owl.carousel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery.appear.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/library/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/theme/js/scripts.js"></script>
</body>
</html>
<script>
$(document).ready(function(){
    var question_id = $("#question_id").val();
    var quiz_id = $("#quiz_id").val();

    $.post("<?php echo base_url();?>quiz/isChecked",
        {
            question_id : question_id,
            quiz_id : quiz_id
        },
        function(data) {
            var result = $.parseJSON(data);
            $("#radio-"+result[0].user_answer).prop("checked", true);
        }
    );

    $("#next").click(function(){
        var user_answer = $("input:radio[name=radio_answer]:checked").val();
        var question_id = $("#question_id").val();
        var quiz_id = $("#quiz_id").val();
        $.post("<?php echo base_url();?>quiz/saveAnswer",
            {
                user_answer : user_answer,
                question_id : question_id,
                quiz_id : quiz_id
            },
            function(data) {
                var result = $.parseJSON(data);
                window.location.href = "<?php echo base_url();?>quiz/start/<?php echo $quiz_id;?>/<?php echo $next;?>/<?php echo $data_quiz[0]['title']; ?>";
            }
        );
    });

    $("#prev").click(function(){
        var user_answer = $("input:radio[name=radio_answer]:checked").val();
        var question_id = $("#question_id").val();
        var quiz_id = $("#quiz_id").val();
        $.post("<?php echo base_url();?>quiz/saveAnswer",
            {
                user_answer : user_answer,
                question_id : question_id,
                quiz_id : quiz_id
            },
            function(data) {
                var result = $.parseJSON(data);
                window.location.href = "<?php echo base_url();?>quiz/start/<?php echo $quiz_id;?>/<?php echo $prev;?>/<?php echo $data_quiz[0]['title']; ?>";
            }
        );
    });

    $(".submit-quiz").click(function(){
        localStorage.setItem("timer_save", "");
        var user_answer = $("input:radio[name=radio_answer]:checked").val();
        var question_id = $("#question_id").val();
        var quiz_id = $("#quiz_id").val();
        $.post("<?php echo base_url();?>quiz/submitAnswer",
            {
                user_answer : user_answer,
                question_id : question_id,
                quiz_id : quiz_id
            },
            function(data) {
                var result = $.parseJSON(data);

                if (result == 1) {
                    window.location.href = "<?php echo base_url();?>quiz/finish/<?php echo $quiz_id;?>/<?php echo $data_quiz[0]['title'];?>";
                } else {
                    alert("Submit quiz failed");
                }
            }
        );
    });

    function startTimer(duration, display) {
        if (localStorage.getItem("timer_save") == "") {
                var timer = duration, minutes, seconds;
        } else {
                var timer = localStorage.getItem("timer_save");
        }
        
       var set_interval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.text(minutes + ":" + seconds);
            

            if (--timer < 0) {
                //alert("sorry, your time is up");
                clearInterval(set_interval);
                $("#myModal_c").modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
            localStorage.setItem("timer_save", timer);

        }, 1000);
    }

    jQuery(function ($) {
        var fiveMinutes = 60 * $("#timelimit").val(),
            display = $('#time');
        startTimer(fiveMinutes, display);
    });
});
</script>