<?php echo $header;?>
    <section id="quizz-intro-section" class="quizz-intro-section learn-section">
        <div class="container">

            <div class="title-ct">
                <h3><?php echo $data_quiz[0]['title']; ?></h3>
                <div class="tt-right">
                    <a href="#" class="skip"><i class="icon md-arrow-right"></i>Skip quizz</a>
                </div>
            </div>

            <div class="question-content-wrap">
                <div class="row">
                    <div class="col-md-8">
                        <div class="question-content">
                            <?php 
                                $right_answer = 0;
                                $score = 0;
                                foreach ($question_answer as $question) {
                            ?>
                                    <tr>
                                        <?php 
                                            foreach ($user_answer as $answer) {
                                                if ($answer['question_id'] == $question['question_id']) {
                                                    if ($answer['user_answer'] != 0) {
                                                        if ($answer['user_answer'] == $question['right_answer']) {
                                                            $right_answer++;
                                                            $score = $score + $question['score'];
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                            <?php
                                }
                            ?>
                            <h4 class="sm">You got <?php echo $right_answer; ?>/<?php echo count($data_question);?> Questions right</h4>
                            
                            <table class="table-question">
                                <thead>
                                    <tr>
                                        <th colspan="2">Correction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $i=1;
                                        foreach ($question_answer as $question) {
                                    ?>
                                            <tr>
                                                <?php 
                                                    foreach ($user_answer as $answer) {
                                                        if ($answer['question_id'] == $question['question_id']) {
                                                            if ($answer['user_answer'] != 0) {
                                                                if ($answer['user_answer'] == $question['right_answer']) {
                                                ?>
                                                                    <td><i class="icon icon-val md-check-2"></td>
                                                <?php
                                                                } else {
                                                ?>
                                                                    <td><i class="icon icon-err md-close-2"></i></td>
                                                <?php
                                                                }
                                                            } else {
                                                ?>
                                                                <td></td>
                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <td class="td-quest"><?php echo $i.'. '.$question['question'];?></td>
                                            </tr>
                                    <?php
                                            $i++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                                
                            <div class="form-action">
                                <a href="#" class="mc-btn btn-style-6 redo-quiz">Redo quizz</a>
                                <input type="submit" value="Next Unit" class="mc-btn btn-style-6">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <aside class="question-sidebar">
                            <div class="score-sb">
                                <h4 class="title-sb sm bold">Total score<span><?php echo $score; ?></span></h4>
                                <input type="text" id="total_score" value="<?php echo $score;?>" style="display: none;">
                                <ul>
                                    <?php 
                                        $l = 1;
                                        foreach ($question_answer as $question) {
                                    ?>
                                            
                                                <?php 
                                                    foreach ($user_answer as $answer) {
                                                        if ($answer['question_id'] == $question['question_id']) {
                                                            if ($answer['user_answer'] != 0) {
                                                                if ($answer['user_answer'] == $question['right_answer']) {
                                                ?>
                                                                    <li class="right_answer">
                                                <?php
                                                                } else {
                                                ?>
                                                                    <li class="err">
                                                <?php
                                                                }
                                                            } else {
                                                ?>
                                                                <li>
                                                <?php
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <i class="icon"></i>
                                                Question <?php echo $l; ?> <span><?php echo $question['score']; ?></span>
                                            </li>
                                    <?php
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
localStorage.setItem("timer_save", "");
$(".redo-quiz").click(function(){
    var quiz_id = $("#quiz_id").val();
    $.post("<?php echo base_url();?>quiz/redoQuiz",
        {
            quiz_id : quiz_id
        },
        function(data) {
            var result = $.parseJSON(data);
            window.location.href = "<?php echo base_url();?>quiz/intro/<?php echo $quiz_id;?>/<?php echo $data_quiz[0]['title'];?>";
        }
    );
});
</script>