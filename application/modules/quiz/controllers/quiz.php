<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://digitrainee.dev/index.php/home
	 *	- or -
	 * 		http://digitrainee.dev/index.php/home/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://digitrainee.dev/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->module('user');
		$this->load->module('course');
		$this->load->module('header');
		$this->load->module('footer');
		$this->load->model('course_model');
		$this->load->model('user_model');
		$this->load->model('quiz_model');
	}

	public function intro() {
		$header = $this->quiz_header();
		$data['header'] = $header;

		$quiz_id = $this->uri->segment(3);

		$get_quiz = $this->quiz_model->getQuizById($quiz_id)->result_array();
		$data['data_quiz'] = $get_quiz;
		$data['quiz_id'] = $get_quiz[0]['id'];
		$data['unit_id'] = $get_quiz[0]['curriculum_detail_id'];
		$curriculum_id = $get_quiz[0]['curriculum_id'];

		$get_easy_question = $this->quiz_model->getEasyQuestion($quiz_id, $get_quiz[0]['total_easy_question'])->result_array();
				
		$get_medium_question = $this->quiz_model->getMediumQuestion($quiz_id, $get_quiz[0]['total_medium_question'])->result_array();
		
		$get_hard_question = $this->quiz_model->getHardQuestion($quiz_id, $get_quiz[0]['total_hard_question'])->result_array();

		$merge_question = array_merge($get_easy_question, $get_medium_question, $get_hard_question);
		shuffle($merge_question);
		$array_question = array('kumpulan_pertanyaan' => $merge_question);
		$this->session->set_userdata($array_question);

		$pertanyaan = $this->session->userdata('kumpulan_pertanyaan');
		//print_r($pertanyaan);
		
		$data['data_all_question'] = $pertanyaan;

		$this->load->view('quiz_intro_view', $data);
	}

	public function start() {
		$header = $this->quiz_header();
		$data['header'] = $header;

		$quiz_id = $this->uri->segment(3);
		$user_id = $this->session->userdata('user_id');

		$question_id = $this->uri->segment(4);
		$data['question_id'] = $question_id;

		$get_question = $this->quiz_model->getQuestionById($question_id)->result_array();

		//next check
		//$get_all_question = $this->quiz_model->getAllQuestion($quiz_id)->result_array();

		$get_all_question = $this->session->userdata('kumpulan_pertanyaan');
		
		$data['data_all_question'] = $get_all_question;

		for ($i=0; $i < count($get_all_question); $i++) { 
			if ($get_all_question[$i]['id'] == $question_id) {
				if (isset($get_all_question[$i+1]['id'])) {
					$next = $get_all_question[$i+1]['id'];
				} else {
					$next = "";
				}
			}
		}
		$data['next'] = $next;

		// //prev check
		for ($i=0; $i<count($get_all_question); $i++) {
			if ($get_all_question[$i]['id'] == $question_id) {
				if (isset($get_all_question[$i-1]['id'])) {
					$prev = $get_all_question[$i-1]['id'];
				} else {
					$prev = "";
				}
			}
		}
		$data['prev'] = $prev;

		$data['data_question'] = $get_question;

		$get_answers = $this->quiz_model->getAnswers($question_id)->result_array();
		$data['data_answer'] = $get_answers;

		$this->load->view('quiz_start_view', $data);
	}

	public function saveAnswer() {
		$user_id = $this->session->userdata('user_id');
		$user_answer = $this->input->post('user_answer');
		$question_id = $this->input->post('question_id');
		$quiz_id = $this->input->post('quiz_id');

		$check_answer = $this->quiz_model->checkAnswer($user_id, $quiz_id, $question_id)->result_array();
	
		if (empty($check_answer)) {
			$save_answer = $this->quiz_model->saveAnswer($user_id, $quiz_id, $question_id, $user_answer);
		} else {
			$update_answer = $this->quiz_model->updateAnswer($user_id, $quiz_id, $question_id, $user_answer);
		}

		$success = 1;

		echo json_encode($success);
	}

	public function submitAnswer() {
		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');


		if ($this->user->isUser($name, $email)) {
			$user_id = $this->session->userdata('user_id');
			$user_answer = $this->input->post('user_answer');
			$question_id = $this->input->post('question_id');
			$quiz_id = $this->input->post('quiz_id');
			$datetime = new DateTime();

			$check_answer = $this->quiz_model->checkAnswer($user_id, $quiz_id, $question_id)->result_array();
			
			if (empty($check_answer)) {
				$save_answer = $this->quiz_model->saveAnswer($user_id, $quiz_id, $question_id, $user_answer);
			} else {
				$update_answer = $this->quiz_model->updateAnswer($user_id, $quiz_id, $question_id, $user_answer);
			}

			$questions = $this->session->userdata('kumpulan_pertanyaan');

			foreach ($questions as $question) {
				$get_question_answer = $this->quiz_model->getQuestionAnswer($question['id'])->result_array();
				$arrayAnswer[] = array('question_id' => $question['id'], 'question' => $question['question'], 'score' => $question['score'], 'right_answer' => $get_question_answer[0]['id']);	
			}
			
			$data['question_answer'] = $arrayAnswer;

			$get_user_answer = $this->quiz_model->getUserAnswer($quiz_id, $user_id)->result_array();
			$data['user_answer'] = $get_user_answer;

	        $score = 0;
	        foreach ($arrayAnswer as $question) {
	            foreach ($get_user_answer as $answer) {
	                if ($answer['question_id'] == $question['question_id']) {
	                    if ($answer['user_answer'] != 0) {
	                        if ($answer['user_answer'] == $question['right_answer']) {
	                            $score = $score + $question['score'];
	                        }
	                    }
	                }
	            }
	        }

	        $save_record_quiz = $this->quiz_model->saveRecordQuiz($user_id, $quiz_id, $score, $datetime->format('Y-m-d H:i:s'));

	        if ($save_record_quiz) {
	        		$success = 1;
	        		echo json_encode($success);
	        } else {
	        	$success = 0;
	        	echo json_encode($success);
	        }
	    } else {
	    	header('location:'.base_url().'login');
	    }
	}

	public function quizTimeout() {
		$quiz_id = $this->input->post('quiz_id');
		$user_id = $this->session->userdata('user_id');
		$get_all_question = $this->quiz_model->getAllQuestion($quiz_id)->result_array();
		$datetime = new DateTime();

		foreach ($get_all_question as $all_question) {
			$check_answer = $this->quiz_model->checkAnswer($user_id, $quiz_id, $all_question['id'])->result_array();

			if (empty($check_answer)) {
				$save_answer = $this->quiz_model->setUserAnswer($user_id, $quiz_id, $all_question['id']);
			}
		}

		$questions = $this->session->userdata('kumpulan_pertanyaan');
			
		foreach ($questions as $question) {
			$get_question_answer = $this->quiz_model->getQuestionAnswer($question['id'])->result_array();
			$arrayAnswer[] = array('question_id' => $question['id'], 'question' => $question['question'], 'score' => $question['score'], 'right_answer' => $get_question_answer[0]['id']);	
		}

		$data['question_answer'] = $arrayAnswer;

		$get_user_answer = $this->quiz_model->getUserAnswer($quiz_id, $user_id)->result_array();
		$data['user_answer'] = $get_user_answer;

        $score = 0;
        foreach ($arrayAnswer as $question) {
            foreach ($get_user_answer as $answer) {
                if ($answer['question_id'] == $question['question_id']) {
                    if ($answer['user_answer'] != 0) {
                        if ($answer['user_answer'] == $question['right_answer']) {
                            $score = $score + $question['score'];
                        }
                    }
                }
            }
        }

        $save_record_quiz = $this->quiz_model->saveRecordQuiz($user_id, $quiz_id, $score, $datetime->format('Y-m-d H:i:s'));

		$get_quiz = $this->quiz_model->getQuizById($quiz_id)->result_array();

		header('location:'.base_url().'quiz/finish/'.$quiz_id.'/'.$get_quiz[0]['title']);
	}

	public function redoQuiz() {
		$quiz_id = $this->input->post('quiz_id');
		$user_id = $this->session->userdata('user_id');
		
		$delete_user_answer = $this->quiz_model->deleteUserAnswer($user_id, $quiz_id);

		if ($delete_user_answer) {
			$success = 1;
			echo json_encode($success);
		}
	}

	public function quiz_header() {
		$quiz_id = $this->uri->segment(3);

		$user_id = $this->session->userdata('user_id');
		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');


		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;

			$get_quiz = $this->quiz_model->getQuizById($quiz_id)->result_array();
			$data['data_quiz'] = $get_quiz;
			$data['quiz_id'] = $get_quiz[0]['id'];
			$data['unit_id'] = $get_quiz[0]['curriculum_detail_id'];
			$curriculum_id = $get_quiz[0]['curriculum_id'];

			$get_course_id = $this->course_model->getCourseId($curriculum_id)->result_array();
			$course_id = $get_course_id[0]['course_id'];

			$get_course = $this->course_model->getCourseById($course_id)->result_array();
			$data['data_course'] = $get_course;

			$get_curriculum = $this->course_model->getCurriculum($course_id)->result_array();
			$data['data_curriculum'] = $get_curriculum;

			$get_curriculum_quiz = $this->course_model->getCurriculumUnitQuiz($course_id, $user_id)->result_array();
			$data['data_curriculum_quiz'] = $get_curriculum_quiz;

			$get_curriculum_unit = $this->course_model->getCurriculumUnitLearned($course_id, $user_id)->result_array();
			
			for ($i=0; $i < count($get_curriculum_unit); $i++) {
				for ($j=0; $j < count($get_curriculum_quiz); $j++) { 
				 	if ($get_curriculum_unit[$i]['unit_id'] == $get_curriculum_quiz[$j]['unit_id']) {
				 		$get_curriculum_unit[$i]['quiz_id'] = $get_curriculum_quiz[$j]['quiz_id'];
					}
				} 
			}
			$data['data_curriculum_unit'] = $get_curriculum_unit;

			$get_curriculum_quiz = $this->course_model->getCurriculumQuiz($course_id)->result_array();
			
			if (!empty($get_curriculum_quiz)) {
				$data['data_curriculum_quiz'] = $get_curriculum_quiz;

				foreach ($get_curriculum_quiz as $curriculum_quiz) {
					$get_questions = $this->course_model->getQuestion($curriculum_quiz['quiz_id'])->result_array();
					$arrayQuestion[] = array('quiz_id' => $curriculum_quiz['quiz_id'], 'total_question' => $get_questions[0]['total_question']);
				}
				$data['data_total_questions'] = $arrayQuestion;
			}
			return $this->load->view('quiz_template_view', $data, true);
		} else {
			header('location:'.base_url().'login');
		}
	}

	public function isChecked() {
		$user_id = $this->session->userdata('user_id');
		$question_id = $this->input->post('question_id');
		$quiz_id = $this->input->post('quiz_id');

		$check_answer = $this->quiz_model->checkAnswer($user_id, $quiz_id, $question_id)->result();

		echo json_encode($check_answer);
	}

	public function finish() {
		$header = $this->quiz_header();
		$data['header'] = $header;

		$user_id = $this->session->userdata('user_id');
		$quiz_id = $this->uri->segment(3);

		$questions = $this->session->userdata('kumpulan_pertanyaan');

		foreach ($questions as $question) {
			$get_question_answer = $this->quiz_model->getQuestionAnswer($question['id'])->result_array();
			if (!empty($get_question_answer)) {
				$arrayAnswer[] = array('question_id' => $question['id'], 'question' => $question['question'], 'score' => $question['score'], 'right_answer' => $get_question_answer[0]['id']);	
			}
		}

		$data['question_answer'] = $arrayAnswer;

		$get_question = $this->session->userdata('kumpulan_pertanyaan');//$this->quiz_model->getQuestion($quiz_id)->result_array();
		$data['data_question'] = $get_question;

		$get_user_answer = $this->quiz_model->getUserAnswer($quiz_id, $user_id)->result_array();
		$data['user_answer'] = $get_user_answer;

		$this->checkMarkQuiz($user_id, $quiz_id);

		$this->load->view('quiz_finish_view', $data);
	}

	public function checkMarkQuiz($user_id, $quiz_id) {
		$get_user_score = $this->quiz_model->getUserScore($user_id, $quiz_id)->result_array();

		$count = 0;
		foreach ($get_user_score as $user_score) {
			if ($user_score['total_score'] >= 70) {
				$count++;
			}
		}

		if ($count != 0) {
			$get_quiz = $this->quiz_model->getQuizById($quiz_id)->result_array();
			$mark_quiz = $this->quiz_model->markQuiz($user_id, $get_quiz[0]['curriculum_detail_id']);
			return true;
		}
	}

	public function removeCurrentAnswer() {
		$quiz_id = $this->input->post('quiz_id');
		$user_id = $this->session->userdata('user_id');

		$remove = $this->quiz_model->removeCurrentAnswer($user_id, $quiz_id);

		if ($remove) {

		}
	}
}