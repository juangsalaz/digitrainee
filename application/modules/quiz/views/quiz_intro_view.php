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
                            <h4 class="md">Introduction</h4>
                            <p><?php echo $data_quiz[0]['intro']; ?></p>
                            <div class="form-action">
                                <input type="hidden" id="quiz_id" value="<?php echo $quiz_id;?>">
                                <a href="<?php echo base_url();?>quiz/start/<?php echo $quiz_id;?>/<?php echo $data_all_question[0]['id'];?>/<?php echo $data_quiz[0]['title']; ?>" class="mc-btn btn-style-1" id="start-quiz">Start Quizz</a>
                                <span class="total-time">Total time : <?php echo $data_quiz[0]['lifetime']; ?> minutes</span>
                            </div>
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
                                    ?>
                                            <li><i class="icon"></i>Question <?php echo $l; ?><span><?php echo $question['score']; ?></span></li>
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
    $("#start-quiz").click(function(){
        $.post("<?php echo base_url();?>quiz/removeCurrentAnswer",
            {
                quiz_id : $("#quiz_id").val()
            },
            function(data) {
                var result = $.parseJSON(data);
                
            }
        );
    });
</script>