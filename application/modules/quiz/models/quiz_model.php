<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quiz_model extends CI_Model {
	function __construct() {
        parent::__construct();
    }

    public function getQuizById($quiz_id) {
        $query = $this->db->query("SELECT cq.*, cd.curriculum_id FROM digi_course_curriculum_quiz cq, digi_course_curriculum_detail cd WHERE cq.id = '".$quiz_id."' AND cq.curriculum_detail_id = cd.id");
        return $query;
    }

    public function getAllQuestion($quiz_id) {
        $query = $this->db->query("SELECT * FROM digi_quiz_question WHERE quiz_id = '".$quiz_id."'");
        return $query;
    }

    public function getQuestionById($question_id) {
        $query = $this->db->query("SELECT * FROM digi_quiz_question WHERE id = '".$question_id."'");
        return $query;
    }

    public function getAnswers($question_id) {
        $query = $this->db->query("SELECT * FROM digi_quiz_answer WHERE question_id = '".$question_id."'");
        return $query;
    }

    public function checkAnswer($user_id, $quiz_id, $question_id) {
        $query = $this->db->query("SELECT * FROM digi_user_quiz_answer WHERE user_id = '".$user_id."' AND quiz_id = '".$quiz_id."' AND question_id = '".$question_id."'");
        return $query;
    }

    public function saveAnswer($user_id, $quiz_id, $question_id, $user_answer) {
        $query = $this->db->query("INSERT INTO digi_user_quiz_answer (user_id, quiz_id, question_id, user_answer) VALUES ('".$user_id."', '".$quiz_id."', '".$question_id."', '".$user_answer."')");
        return $query;
    }

    public function setUserAnswer($user_id, $quiz_id, $question_id) {
        $query = $this->db->query("INSERT INTO digi_user_quiz_answer (user_id, quiz_id, question_id) VALUES ('".$user_id."', '".$quiz_id."', '".$question_id."')");
        return $query;   
    }

    public function updateAnswer($user_id, $quiz_id, $question_id, $user_answer) {
        $query = $this->db->query("UPDATE digi_user_quiz_answer SET user_answer = '".$user_answer."' WHERE user_id = '".$user_id."' AND quiz_id = '".$quiz_id."' AND question_id = '".$question_id."'");
        return $query;
    }

    public function getQuestionAnswer($question_id) {
        //$query = $this->db->query("SELECT qq.id AS question_id, qq.question, qq.score, qa.id AS right_answer FROM digi_quiz_question qq, digi_quiz_answer qa WHERE qa.is_true = 1 AND qq.id = qa.question_id AND qq.quiz_id = '".$quiz_id."'");
        $query = $this->db->query("SELECT id FROM digi_quiz_answer WHERE question_id = '".$question_id."' AND is_true = 1");
        return $query;
    }

    public function getQuestion($quiz_id) {
        $query = $this->db->query("SELECT * FROM digi_quiz_question qq WHERE  qq.quiz_id = '".$quiz_id."'");
        return $query;
    }

    public function getUserAnswer($quiz_id, $user_id) {
        $query = $this->db->query("SELECT qq.id AS question_id, uqa.user_answer FROM digi_quiz_question qq, digi_user_quiz_answer uqa WHERE qq.quiz_id = '".$quiz_id."' AND qq.id = uqa.question_id AND uqa.user_id = '".$user_id."'");
        return $query;
    }

    public function getDataUserAnswer($user_id, $quiz_id) {
        $query = $this->db->query("SELECT * FROM digi_user_quiz_answer WHERE user_id = '".$user_id."' AND quiz_id = '".$quiz_id."'");
        return $query;
    }

    // public function saveFinishAnswer($user_quiz_answer_id, $user_id, $quiz_id, $question_id, $user_answer, $datetime) {
    //     $query = $this->db->query("INSERT INTO digi_user_quiz_finish (user_quiz_answer_id, user_id, quiz_id, question_id, user_answer, datetime) VALUES ('".$user_quiz_answer_id."', '".$user_id."', '".$quiz_id."', '".$question_id."', '".$user_answer."', '".$datetime."')");
    //     $query2 = $this->db->query("DELETE FROM digi_user_quiz_answer WHERE user_id = '".$user_id."' AND quiz_id = '".$quiz_id."'");
    // }

    public function saveRecordQuiz($user_id, $quiz_id, $total_score, $datetime) {
        $query = $this->db->query("INSERT INTO digi_user_quiz_finish (user_id, quiz_id, total_score, datetime) VALUES ('".$user_id."', '".$quiz_id."', '".$total_score."', '".$datetime."')");
        return $query;
    }

    public function deleteUserAnswer($user_id, $quiz_id) {
        $query = $this->db->query("DELETE FROM digi_user_quiz_answer WHERE user_id = '".$user_id."' AND quiz_id = '".$quiz_id."'");
        return $query;
    }

    public function getUserScore($user_id, $quiz_id) {
        $query = $this->db->query("SELECT * FROM digi_user_quiz_finish WHERE user_id = '".$user_id."' AND quiz_id = '".$quiz_id."'");
        return $query;
    }

    public function markQuiz($user_id, $unit_id) {
        $query = $this->db->query("UPDATE digi_users_course SET learned_mark = 1 WHERE user_id = '".$user_id."' AND unit_id = '".$unit_id."'");
        return $query;
    }

    public function getEasyQuestion($quiz_id, $limit) {
        $query = $this->db->query("SELECT * FROM digi_quiz_question WHERE quiz_id = '".$quiz_id."' AND question_weight = 1 ORDER BY RAND() LIMIT $limit");
        return $query;
    }

    public function getMediumQuestion($quiz_id, $limit) {
        $query = $this->db->query("SELECT * FROM digi_quiz_question WHERE quiz_id = '".$quiz_id."' AND question_weight = 2 ORDER BY RAND() LIMIT $limit");
        return $query;
    }

    public function getHardQuestion($quiz_id, $limit) {
        $query = $this->db->query("SELECT * FROM digi_quiz_question WHERE quiz_id = '".$quiz_id."' AND question_weight = 3 ORDER BY RAND() LIMIT $limit");
        return $query;
    }

    public function removeCurrentAnswer($user_id, $quiz_id) {
        $query = $this->db->query("DELETE FROM digi_user_quiz_answer WHERE user_id = '".$user_id."' AND quiz_id = '".$quiz_id."'");
        return $query;
    }
}