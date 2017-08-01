<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends MX_Controller {

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
		$this->load->module('header');
		$this->load->module('footer');
		$this->load->model('course_model');
		$this->load->model('user_model');
	}

	public function index() {
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;

		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');

		$get_categories = $this->course_model->getCategories()->result();
		$data['categories'] = $get_categories;

		$get_courses = $this->course_model->getCourses()->result();
		$data['courses'] = $get_courses;

		if (!empty($get_courses)) {
			for ($i=0; $i<count($get_courses); $i++) {
				$count_course_member = $this->course_model->getUsersCourse($get_courses[$i]->course_id)->result();
				$array_member[] = array("course_id"=>$get_courses[$i]->course_id, "course_member"=>count($count_course_member));
			}
			$data['array_member'] = $array_member;
		}
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;

			$this->load->view('course_view', $data);
		} else {
			$this->load->view('course_view', $data);
		}
	}

	public function detail() {
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;

		$course_id = $this->uri->segment(3);
		$get_course = $this->course_model->getCourseById($course_id)->result_array();

		$data['data_course'] = $get_course;

		$get_curriculum = $this->course_model->getCurriculum($course_id)->result_array();
		$data['data_curriculum'] = $get_curriculum;

		$get_curriculum_unit = $this->course_model->getCurriculumUnit($course_id)->result_array();
		$data['data_curriculum_unit'] = $get_curriculum_unit;

		$get_users_course = $this->course_model->getUsersCourse($course_id)->result_array();
		$data['data_users'] = $get_users_course;
		$data['course_members'] = count($get_users_course);

		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;
			$user_id = $this->session->userdata('user_id');

			if ($this->isTakedCourse($user_id, $course_id)) {
				$data['is_taked_course'] = 1;
			} else {
				$data['is_taked_course'] = 0;
			}

			$this->load->view('course_detail_view', $data);
		} else {
			$this->load->view('course_detail_view', $data);
		}
	}

	public function isTakedCourse($user_id, $course_id) {
		$check = $this->course_model->isTakedCourse($user_id, $course_id);
		
		if ($check->num_rows != 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function bTeacher() {
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;

		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');

		if ($this->user->isUser($name, $email)) {
			$data['author'] = $name;

			$this->load->helper('form');

			$categories = $this->course_model->categoryList();
			$data['categories'] = $categories->result_array();

			$this->load->view('become_teacher', $data);
		} else {
			header('location:'.base_url().'login');
		}
	}	

	public function createCourse() {
		$title = $this->input->post('title');
		$category = $this->input->post('category');

		$userEmail = $this->session->userdata('email');
		$userId = $this->user_model->getIdByEmail($userEmail);

		$id = $this->course_model->createCourse($title, $category, $userId);

		redirect('course/cBasicInfo?c='.$id);

	}

	public function cBasicInfo() {
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;
		$id = $this->input->get('c');
		$user_id = $this->session->userdata('user_id');

		$data['sideMenu'] = $this->createCourseSideMenu('1', $id);

		if (!$this->session->userdata('name')) {
			redirect('login');
		}

		$get_data_user_login = $this->course_model->getUserLogin($user_id)->result_array();
		$data['data_user_login'] = $get_data_user_login;

		$name = $this->session->userdata('name');
		$data['author'] = $name;

		$this->load->helper('form');

		$categories = $this->course_model->categoryList();
		$data['categories'] = $categories->result_array();

		$detail = $this->course_model->detailBasicInfo($id)->result_array();
		$data['detail'] = $detail[0];

		$this->load->view('create_basic_info', $data);
	}	

	public function editCourseTitle() {
		$title = $this->input->post('title');
		$id = $this->input->post('id');

		$ret = $this->course_model->updateCourseTitle($title, $id);

		echo json_encode(array('data' => 'success'));
	}

	public function saveBasicInfo() {

		//die(print_r($_POST['banner']));

		$title = $this->input->post('title');
		$description = $this->input->post('description');
		$level = $this->input->post('for-level-from') ? $this->input->post('for-level-from') : '1';
		$tools = $this->input->post('tool_requirement');
		$tags = $this->input->post('tag');
		$isFree = $this->input->post('tuition');
		$price = $this->input->post('price');
		$id = $this->input->post('c');

		$this->course_model->saveBasicInfo($description, $level, $isFree, $price, $tools, $tags, $id);

		$categories = $this->course_model->categoryList();

		$this->course_model->deleteCourseCategory($id);

		foreach ($categories->result_array() as $cat) {
			if ($this->input->post('cat_'.$cat['id']) == 'on') {
				$this->course_model->saveCourseCategory($id, $cat['id']);
			}
		}

		$config['upload_path'] = './upload/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $id.'_banner';
        $config['overwrite'] = TRUE;

		$fileParts = pathinfo($_FILES['banner']['name']);
		$filename = $id.'_banner.'.$fileParts['extension'];

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('banner')){
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors();
        } else {
			$this->course_model->updateCourseBanner($filename, $id);
        }

        $config['image_library'] = 'gd2';
        $config['source_image'] = $this->upload->upload_path.$filename;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 270;
        $config['max_height'] = 160;
        $this->load->library('image_lib',$config); 
        $this->image_lib->resize($config);

        /*
        $config2['upload_path'] = './upload/videos/';
        $config2['allowed_types'] = 'mp4|avi|wmv';
        $config2['file_name'] = $id.'promo_video';

        $this->load->library('upload', $config2);
        if ( ! $this->upload->do_upload('promo_video')){
            $error = array('error' => $this->upload->display_errors());
            echo $this->upload->display_errors();
        }
        */

        redirect('course/cDesignCourse?c='.$id);

	}

	public function uploadVideoDemo() {
		$id = $this->input->post('id');

		$targetFolder = '/upload/videos'; // Relative to the root

		$verifyToken = md5('unique_hash' . $this->input->post('timestamp'));

		if (!empty($_FILES) && $this->input->post('token') == $verifyToken) {
			
			// Validate the file type
			$fileTypes = array('wmv','avi','flv','mkv','mp4'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);

			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$targetFile = rtrim($targetPath,'/') . '/' . $id.'_promo_video_'.$_FILES['Filedata']['name'];
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				$this->course_model->updateCourseVideoPromo($_FILES['Filedata']['name'], $id);
				echo '1';
			} else {
				echo 'Invalid file type.';
			}
		}		
	}

	public function cDesignCourse() {
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;
		$id = $this->input->get('c');

		$data['sideMenu'] = $this->createCourseSideMenu('2', $id);

		if (!$this->session->userdata('name')) {
			redirect('login');
		}

		$name = $this->session->userdata('name');
		$data['author'] = $name;

		$detail = $this->course_model->detailBasicInfo($id)->result_array();
		$data['detail'] = $detail[0];

		$sections = $this->course_model->courseCurriculums($id);

		$dataSections = array();
		$i = 0;
		foreach ($sections->result_array() as $section) {
			$dataSections[$i] = $section;
			//units
			$units = $this->course_model->courseCurriculumTopics($section['id']);
			if ($units->num_rows() > 0) {
				$dataUnits = array();
				$j = 0;
				foreach ($units->result_array() as $unit) {
					$dataUnits[$j] = $unit;

					if ($unit['type'] == '2') {
						//questions
						$questions = $this->course_model->findQuestionByQuiz($unit['quiz_id']);

						if ($questions->num_rows() > 0) {
							$dataQuestions = array();
							$k = 0;
							foreach ($questions->result_array() as $question) {
								$dataQuestions[] = $question;

								//answer
								$answers = $this->course_model->findAnswerByQuestion($question['id']);
								if ($answers->num_rows() > 0) {
									$dataAnswers = array();
									foreach ($answers->result_array() as $answer) {
										$dataAnswers[] = $answer;
									}	
									$dataQuestions[$k]['answer'] = $dataAnswers;
								} else {
									$dataQuestions[$k]['answer'] = array();
								}
							}	
							$dataUnits[$j]['questions'] = $dataQuestions;
							
						} else {
							$dataUnits[$j]['questions'] = array();
						}
					}
					$j++;
				}	
				$dataSections[$i]['units'] = $dataUnits;
			} else {
				$dataSections[$i]['units'] = array();
			}

			$i++;
		}
		$data['sections'] = $dataSections;

		$this->load->helper('form');

		$this->load->view('create_design_course', $data);
	}

	public function saveCourseSection() {
		$title = $this->input->post('title');
		$cid = $this->input->post('cid');

		$id = $this->course_model->saveCurriculum($cid, $title);

		$return = array('data' => $id);

		echo json_encode($id);
	}

	public function deleteCourseSection() {
		$id = $this->input->post('id');

		$this->course_model->deleteTopicByCurriculum($id);
		$this->course_model->deleteCurriculum($id);

		echo json_encode(true);
	}

	public function editCourseSection() {
		$title = $this->input->post('title');
		$id = $this->input->post('id');

		$ret = $this->course_model->updateCurriculum($id, $title);

		echo json_encode(array('data' => 'success'));
	}

	public function saveCourseSectionUnit() {
		$title = $this->input->post('title');
		$type = $this->input->post('livecourse') == 1 ? 4 : 1;
		$id = $this->input->post('id');

		$id = $this->course_model->saveCurriculumTopic($id, $title, $type);

		echo json_encode($id);
	}	

	public function editCourseSectionUnit() {
		$title = $this->input->post('title');
		$isFree = $this->input->post('content_is_free');
		$id = $this->input->post('id');

		$ret = $this->course_model->updateCurriculumTopic($id, $title, $isFree);

		echo json_encode(array('data' => 'success'));
	}

	public function deleteCourseSectionUnit() {
		$id = $this->input->post('id');

		$res = $this->course_model->detailCurriculumTopic($id);
		if ($res->num_rows() > 0) {
			$detail = $res->result_array();
			if ($detail[0]['content_filename']) {
				unlink('/upload/'.$detail[0]['content_filename'].'s/'.$detail[0]['course_id'].'_'.$detail[0]['curriculum_id'].'_'.$detail[0]['id'].'_'.$detail[0]['content_filename']);
			}
		}

		$this->course_model->deleteCurriculumTopic($id);

		echo json_encode(true);
	}

	public function uploadCourseContent() {
		$cId = $this->input->post('cid');
		$curId = $this->input->post('cur_id');
		$id = $this->input->post('id');

		$targetFolder = '/upload/'; // Relative to the root

		if (!empty($_FILES) && $this->input->post('id')) {
			
			// Validate the file type
			$fileTypes = array('wmv','avi','flv','mkv','mp4','pdf'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);

			$targetFolder .= $fileParts['extension'] == 'pdf' ? 'documents' : 'videos';
			$type = $fileParts['extension'] == 'pdf' ? 'document' : 'video';

			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$targetFile = rtrim($targetPath,'/') . '/' . $cId.'_'.$curId.'_'.$id.'_'.$_FILES['Filedata']['name'];
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				$this->course_model->updateTopicContent($id, $type, $_FILES['Filedata']['name'], $fileParts['extension'], round($_FILES['Filedata']['size']/1024));
				echo '1';
			} else {
				echo 'Invalid file type.';
			}
		}
	}

	public function cPublishCourse() {
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;
		$id = $this->input->get('c');
		$user_id = $this->session->userdata('user_id');

		$data['sideMenu'] = $this->createCourseSideMenu('3', $id);

		if (!$this->session->userdata('name')) {
			redirect('login');
		}

		$name = $this->session->userdata('name');
		$data['author'] = $name;

		$get_data_user_login = $this->course_model->getUserLogin($user_id)->result_array();
		$data['data_user_login'] = $get_data_user_login;

		$detail = $this->course_model->detailBasicInfo($id)->result_array();

		$data['detail'] = $detail[0];

		$data['cntSection'] = $this->course_model->countSection($id);
		$data['cntSectionUnit'] = $this->course_model->countSectionUnit($id);

		$this->load->view('create_publish_course', $data);
	}

	public function cConfirmCourse() {
		$id = $this->input->get('c');

		if (!$this->session->userdata('name')) {
			redirect('login');
		}

		$this->course_model->confirmCourse($id);

		redirect('profile/teaching');
	}

	public function cSaveDraft() {
		$id = $this->input->get('c');

		if (!$this->session->userdata('name')) {
			redirect('login');
		}

		$this->course_model->saveDraft($id);
		
		redirect('profile/teaching');
	}

	public function add_course() {
		$header = $this->header->small_header();
		$data['header'] = $header;
		$data['footer'] = $footer;

		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;

			$this->load->view('course_detail_view', $data);
		} else {
			$this->load->view('course_detail_view', $data);
		}
	}

	public function filter() {
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;

		$category_id = $this->uri->segment(3);

		$get_courses_by_category = $this->course_model->getCourseByCategory($category_id)->result();
		$data['courses'] = $get_courses_by_category;

		if (!empty($get_courses_by_category)) {
			for ($i=0; $i<count($get_courses_by_category); $i++) {
				$count_course_member = $this->course_model->countCourseMember($get_courses_by_category[$i]->course_id)->result();
				$array_member[] = array("course_id"=>$get_courses_by_category[$i]->course_id, "course_member"=>count($count_course_member));
			}
			$data['array_member'] = $array_member;
		}

		$get_categories = $this->course_model->getCategories()->result();
		$data['categories'] = $get_categories;

		$this->load->view('course_view', $data);
	}

	public function createCourseSideMenu($step, $id) {
		$data['active1'] = '';
		$data['active2'] = '';
		$data['active3'] = '';

		$data['id'] = $id;

		switch ($step) {
			case '1':
				$data['active1'] = 'active';
				break;			
			case '2':
				$data['active2'] = 'active';
				break;		
			case '3':
				$data['active3'] = 'active';
				break;				
		}

		return $this->load->view('create_course_side_menu', $data, true);
	}

	public function takeCourse() {
		$couponcode = $this->input->post('couponcode');
		$course_id = $this->input->post('course_id');
		$user_id = $this->session->userdata('user_id');

		$check_couponcode = $this->course_model->checkCouponcode($couponcode)->result_array();

		if (!empty($check_couponcode))  {
			$get_course = $this->course_model->getCourseById($course_id)->result_array();

			if ($check_couponcode[0]['coupon_voucher'] < $get_course[0]['price']) {
				$success = 2;
				echo json_encode($success);
			} elseif ($check_couponcode[0]['coupon_voucher'] == $get_course[0]['price']) {
				$get_curriculum_unit = $this->course_model->getCurriculumUnit($course_id)->result_array();
				$data['data_curriculum_unit'] = $get_curriculum_unit;
				$course_price = $get_course[0]['price'];
				$enroll_date = new DateTime();
			
				foreach ($get_curriculum_unit as $curriculum_unit) {
					$take_course = $this->course_model->takeCourse($user_id, $course_id, $curriculum_unit['curriculum_id'], $curriculum_unit['unit_id'], $enroll_date->format('Y-m-d H:i:s'), $course_price);	
				}

				//set status voucher menjadi not available
				$update_voucher = $this->course_model->updateVoucher($couponcode);

				if ($update_voucher == 1) {
					$success = 1;
					echo json_encode($success);
				}
			} elseif ($check_couponcode[0]['coupon_voucher'] > $get_course[0]['price']) {
				$get_curriculum_unit = $this->course_model->getCurriculumUnit($course_id)->result_array();
				$data['data_curriculum_unit'] = $get_curriculum_unit;
				$course_price = $get_course[0]['price'];
				$enroll_date = new DateTime();
			
				foreach ($get_curriculum_unit as $curriculum_unit) {
					$take_course = $this->course_model->takeCourse($user_id, $course_id, $curriculum_unit['curriculum_id'], $curriculum_unit['unit_id'], $enroll_date->format('Y-m-d H:i:s'), $course_price);	
				}

				//kelebihan voucher disimpan di saldo deposit
				$saldo = $check_couponcode[0]['coupon_voucher'] - $get_course[0]['price'];
				$save_saldo = $this->course_model->saveSaldoDeposit($saldo, $user_id);

				//set status voucher menjadi not available
				$update_voucher = $this->course_model->updateVoucher($couponcode);

				if ($update_voucher == 1) {
					$success = 1;
					echo json_encode($success);
				}
			}
		} else {
			$success = 0;
			echo json_encode($success);
		}
	}

	public function takeFreeCourse() {
		$course_id = $this->input->post('course_id');
		$user_id = $this->session->userdata('user_id');
		$enroll_date = new DateTime();
		$course_price = 0;

		$get_curriculum_unit = $this->course_model->getCurriculumUnit($course_id)->result_array();
		$data['data_curriculum_unit'] = $get_curriculum_unit;
	
		foreach ($get_curriculum_unit as $curriculum_unit) {
			$take_course = $this->course_model->takeCourse($user_id, $course_id, $curriculum_unit['curriculum_id'], $curriculum_unit['unit_id'], $enroll_date->format('Y-m-d H:i:s'), $course_price);	
		}

		$success = 1;
		echo json_encode($success);
	}

	public function saveCourseSectionQuiz() {
		$title = $this->input->post('title');
		$cid = $this->input->post('id');

		$idDetail = $this->course_model->saveCurriculumTopic($cid, $title, 2);

		$id = $this->course_model->saveCurriculumQuiz($idDetail, $title);

		echo json_encode($id);
	}	

	public function editCourseSectionQuiz() {
		$title = $this->input->post('title');
		$timelimit = $this->input->post('timelimit');
		$lifetime = $this->input->post('lifetime');
		$total_easy_question = $this->input->post('total_easy_question');
		$total_medium_question = $this->input->post('total_medium_question');
		$total_hard_question = $this->input->post('total_hard_question');
		$intro = $this->input->post('intro');
		$id = $this->input->post('id');

		$ret = $this->course_model->updateCurriculumQuiz($id, $title, $timelimit, $lifetime, $total_easy_question, $total_medium_question, $total_hard_question, $intro);

		echo json_encode(array('data' => 'success'));
	}

	public function deleteCourseSectionQuiz() {
		$id = $this->input->post('id');

		$res = $this->course_model->findQuizById($id);
		if ($res->num_rows() > 0) {
			$detail = $res->result_array();
			$this->course_model->deleteCurriculumTopic($detail[0]['curriculum_detail_id']);
		}

		$this->course_model->deleteCurriculumQuiz($id);

		echo json_encode(true);
	}

	public function saveQuizQuestion() {
		$title = $this->input->post('title');
		$type = $this->input->post('type');
		$level = $this->input->post('level');
		$content = $this->input->post('content');
		$ans1 = $this->input->post('ans1');
		$ans1_istrue = $this->input->post('ans1_istrue');
		$ans2 = $this->input->post('ans2');
		$ans2_istrue = $this->input->post('ans2_istrue');
		$ans3 = $this->input->post('ans3');
		$ans3_istrue = $this->input->post('ans3_istrue');
		$ans4 = $this->input->post('ans4');
		$ans4_istrue = $this->input->post('ans4_istrue');
		$ans5 = $this->input->post('ans5');
		$ans5_istrue = $this->input->post('ans5_istrue');
		$quizId = $this->input->post('quizId');
		$questionId = $this->input->post('questionId');

		if (empty($questionId)) {
			$idQ = $this->course_model->saveQuizQuestion($quizId, $title, $type, $level, $content);			
		} else {
			$this->course_model->updateQuizQuestion($questionId, $title, $type, $level, $content);			
			$this->course_model->deleteAnswerByQuestion($questionId);			
			$idQ = $questionId;
		}

		$this->course_model->saveQuizAnswer($idQ, $ans1, $ans1_istrue);
		$this->course_model->saveQuizAnswer($idQ, $ans2, $ans2_istrue);
		$this->course_model->saveQuizAnswer($idQ, $ans3, $ans3_istrue);
		$this->course_model->saveQuizAnswer($idQ, $ans4, $ans4_istrue);
		$this->course_model->saveQuizAnswer($idQ, $ans5, $ans5_istrue);

		$response = array('quizId' => $quizId, 'question' => $content, 'questionId' => $idQ);
		echo json_encode($response);
	}

	public function detailQuizQuestion() {
		$id = $this->input->get('id');

		$question = array();
		$res = $this->course_model->findQuestionById($id);
		if ($res->num_rows() > 0) {
			$res = $res->result_array();
			$question = $res[0];
			$res2 = $this->course_model->findAnswerByQuestion($id);
			if ($res2->num_rows() > 0) {
				$res2 = $res2->result_array();
				$question['answers'] = $res2;
			}
		}

		echo json_encode($question);
	}

	public function updateQuestionScore() {
		$score = $this->input->post('score');
		$id = $this->input->post('id');

		echo $id;

		$this->course_model->updateQuestionScore($id, $score);

		echo json_encode(array('data' => 'success'));
	}

	public function deleteQuestion() {
		$id = $this->input->post('id');

		$this->course_model->deleteAnswerByQuestion($id);
		$this->course_model->deleteQuestion($id);

		echo json_encode(true);
	}



	public function learn() {
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;

		$course_id = $this->uri->segment(3);
		$course_title = $this->uri->segment(4);
		$user_id = $this->session->userdata('user_id');
		$enroll_date = new DateTime();

		$get_course = $this->course_model->getCourseById($course_id)->result_array();
		$course_price = $get_course[0]['price'];

		if ($this->isTakedCourse($user_id, $course_id) == true) {
			$name = $this->session->userdata('name');
			$data['user_name'] = $name;
			$email = $this->session->userdata('email');

			$discussion_id = $this->uri->segment(4);
			if (is_numeric($discussion_id)) {
				$data['discussion_id'] = $discussion_id;

				$get_discussion_by_id = $this->course_model->getDiscussionById($discussion_id)->result_array();
				$data['data_discussion_by_id'] = $get_discussion_by_id;

				$get_discussion_comment = $this->course_model->getDiscussionComment($discussion_id)->result_array();
				$data['data_comment_discussion'] = $get_discussion_comment;
			}

			$get_data_user_login = $this->course_model->getUserLogin($user_id)->result_array();
			$data['data_user_login'] = $get_data_user_login;

			if ($this->user->isUser($name, $email)) {
					//get data schedule
					$livecourseSchedules = array();
					$schedules = $this->course_model->findLivecourseScheduleByCourse($course_id, $user_id)->result_array();

					$i = 0;
					foreach ($schedules as $schedule) {
						$livecourseSchedules[$i] = $schedule;
						$livecourseSchedules[$i]['unit_learned_cnt'] = $this->course_model->getCountUnitUserLearnedBySection($schedule['course_id'], $schedule['curriculum_id'], $user_id);
						$i++;
					}

					$data['livecourseSchedules'] = $livecourseSchedules;

					$get_course_schedule_title = $this->course_model->getCourseScheduleTitle($course_id)->result_array();
					$data['data_schedule_title'] = $get_course_schedule_title;

					$get_course_schedule = $this->course_model->getCourseSchedule($course_id)->result_array();
					$data['data_schedule'] = $get_course_schedule;

					$get_course = $this->course_model->getCourseById($course_id)->result_array();
					$data['data_course'] = $get_course;

					$get_curriculum = $this->course_model->getCurriculum($course_id)->result_array();
					$data['data_curriculum'] = $get_curriculum;

					// $get_curriculum_quiz = $this->course_model->getCurriculumUnitQuiz($course_id, $user_id)->result_array();
					// $data['data_curriculum_quiz'] = $get_curriculum_quiz;

					//mengambil data curriculum detail
					$get_curriculum_unit = $this->course_model->getCurriculumUnit($course_id)->result_array();

					//mengambil data curriculum unit yang sudah di ambil user
					$get_curriculum_unit_user = $this->course_model->getCurriculumUnitUser($course_id, $user_id)->result_array();

					//pengecekan
					for ($i=0; $i < count($get_curriculum_unit_user); $i++) { 
						for ($j=0; $j < count($get_curriculum_unit); $j++) { 
							if ($get_curriculum_unit_user[$i]['unit_id'] == $get_curriculum_unit[$j]['unit_id']) {
								unset($get_curriculum_unit[$j]);
								$get_curriculum_unit_user[$i]['status_unit'] = 'sama';
							}
						}
					}

					foreach ($get_curriculum_unit as $curriculum_unit) {
						$take_course = $this->course_model->takeCourse($user_id, $course_id, $curriculum_unit['curriculum_id'], $curriculum_unit['unit_id'], $enroll_date->format('Y-m-d H:i:s'), $course_price);	
					}

					//delete curriculum unit
					foreach ($get_curriculum_unit_user as $curriculum_unit_user) {
						if (!isset($curriculum_unit_user['status_unit'])) {
							$delete_curriculum_unit_user = $this->course_model->deleteCurriculumUnitUser($user_id, $curriculum_unit_user['unit_id']);
						}
					}

					$get_curriculum_quiz = $this->course_model->getCurriculumUnitQuiz($course_id, $user_id)->result_array();
					$data['data_curriculum_quiz'] = $get_curriculum_quiz;

					$get_curriculum_unit_learned = $this->course_model->getCurriculumUnitLearned($course_id, $user_id)->result_array();

					for ($i=0; $i < count($get_curriculum_unit_learned); $i++) {
						for ($j=0; $j < count($get_curriculum_quiz); $j++) { 
						 	if ($get_curriculum_unit_learned[$i]['unit_id'] == $get_curriculum_quiz[$j]['unit_id']) {
						 		$get_curriculum_unit_learned[$i]['quiz_id'] = $get_curriculum_quiz[$j]['quiz_id'];
							}
						} 
					}

					$data['data_curriculum_unit'] = $get_curriculum_unit_learned;

					$total_quiz = 0;
					$total_unit = 0;
					foreach ($get_curriculum_unit_learned as $curriculum_unit) {
						if ($curriculum_unit['type'] == 2) {
							$total_quiz = $total_quiz + 1;
						} elseif ($curriculum_unit['type'] == 1) {
							$total_unit = $total_unit + 1;
						}
					}

					$data['total_quiz'] = $total_quiz;
					$data['total_unit'] = $total_unit;

					$get_users_course = $this->course_model->getUsersCourse($course_id)->result_array();
					$data['data_users'] = $get_users_course;
					$data['course_members'] = count($get_users_course);

					$count_all_unit = $this->course_model->countAllUnit($get_course[0]['course_id'], $user_id)->result_array();
					$all_unit = $count_all_unit[0]['total_unit'];

					$count_marked_unit = $this->course_model->countMarkedUnit($get_course[0]['course_id'], $user_id)->result_array();
					$marked_unit = $count_marked_unit[0]['total_marked_unit'];

					if ($marked_unit == 0) {
						$data['learn_progress'] = 0;
					} else {
						$learn_progress = ($marked_unit / $all_unit) * 100;
						$data['learn_progress'] = round($learn_progress);
					}

					$name = $this->session->userdata('name');
					$email = $this->session->userdata('email');
				
					$data['name'] = $name;
					$data['email'] = $email;

					//get discussion data
					$get_discussion = $this->course_model->getDiscussion($course_id)->result_array();
					$data['data_discussion'] = $get_discussion;

					//count comment discussion
					foreach ($get_discussion as $discussion) {
						$count_comment_discussion = $this->course_model->countCommentDiscussion($discussion['id'])->result_array();
						$arrayComment[] = array('discussion_id' => $discussion['id'], 'total_comment' => $count_comment_discussion[0]['total_comment']);
					}

					if (!empty($arrayComment)) {
						$data['array_comment'] = $arrayComment;
					}

					$this->load->view('course_learn_view', $data);
			} else {
				header('location:'.base_url().'login');
			}
		} else {
			header('location:'.base_url().'course/detail/'.$course_id.'/'.$course_title);
		}
	}

	public function learning() {
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;
		$user_id = $this->session->userdata('user_id');

		$name = $this->session->userdata('name');
		$data['user_name'] = $name;

		$unit_id = $this->uri->segment(3);
		$data['unit_id'] = $unit_id;

		$discussion_id = $this->uri->segment(4);

		if (is_numeric($discussion_id)) {
			$data['discussion_id'] = $discussion_id;

			$get_discussion_by_id = $this->course_model->getDiscussionById($discussion_id)->result_array();
			$data['data_discussion_by_id'] = $get_discussion_by_id;

			$get_discussion_comment = $this->course_model->getDiscussionComment($discussion_id)->result_array();
			$data['data_comment_discussion'] = $get_discussion_comment;
		}

		$get_unit = $this->course_model->getUnitById($unit_id)->result_array();
		$data['data_unit'] = $get_unit;

		$get_curriculum_id = $this->course_model->getCurriculumId($unit_id)->result_array();
		$curriculum_id = $get_curriculum_id[0]['curriculum_id'];

		$get_curriculum_by_id = $this->course_model->getCurriculumById($curriculum_id)->result_array();
		$data['curriculum_title'] = $get_curriculum_by_id[0]['name'];

		$get_course_id = $this->course_model->getCourseId($curriculum_id)->result_array();
		$course_id = $get_course_id[0]['course_id'];
		$data['course_id'] = $course_id;

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

		//get discussion data
		$get_discussion = $this->course_model->getDiscussion($course_id)->result_array();
		$data['data_discussion'] = $get_discussion;

		foreach ($get_discussion as $discussion) {
			$count_comment_discussion = $this->course_model->countCommentDiscussion($discussion['id'])->result_array();
			$arrayComment[] = array('discussion_id' => $discussion['id'], 'total_comment' => $count_comment_discussion[0]['total_comment']);
		}

		if (!empty($arrayComment)) {
			$data['array_comment'] = $arrayComment;
		}
			
		if (!empty($get_curriculum_quiz)) {
			$data['data_curriculum_quiz'] = $get_curriculum_quiz;

			foreach ($get_curriculum_quiz as $curriculum_quiz) {
				$get_questions = $this->course_model->getQuestion($curriculum_quiz['quiz_id'])->result_array();
				$arrayQuestion[] = array('quiz_id' => $curriculum_quiz['quiz_id'], 'total_question' => $get_questions[0]['total_question']);
			}
			$data['data_total_questions'] = $arrayQuestion;
		}

		$this->load->view('learning_view', $data);
	}

	public function markaslearned() {
		$unit_id = $this->input->post('unit_id');
		$user_id = $this->session->userdata('user_id');

		$markaslearned = $this->course_model->markaslearned($unit_id, $user_id);

		if ($markaslearned == 1) {
			echo json_encode(array('data' => 'success'));
		}
	}

	public function markasnotlearned() {
		$unit_id = $this->input->post('unit_id');
		$user_id = $this->session->userdata('user_id');

		$markasnotlearned = $this->course_model->markasnotlearned($unit_id, $user_id);

		if ($markasnotlearned == 1) {
			echo json_encode(array('data' => 'success'));
		}
	}

	public function isLearned() {
		$unit_id = $this->input->post('unit_id');
		$user_id = $this->session->userdata('user_id');

		$checkIsLearned = $this->course_model->isLearned($unit_id, $user_id);

		if ($checkIsLearned->num_rows == 1) {
			echo json_encode(array('data' => 'success'));
		}
	}

	public function addCourseDiscussion() {
		$discussion_content = $this->input->post('discussion_content');
		$topic_title = $this->input->post('topic_title');
		$course_id = $this->input->post('course_id');
		$user_id = $this->session->userdata('user_id');
		$datetime = new DateTime();

		$save_discussion = $this->course_model->addCourseDiscussion($topic_title, $discussion_content, $course_id, $user_id, $datetime->format('Y-m-d H:i:s'));

		if ($save_discussion == 1) {
			$get_discussion = $this->course_model->getDiscussionAdded($topic_title, $discussion_content, $course_id)->result_array();
			echo json_encode($get_discussion);
		}
	}

	public function saveCommentDiscussion() {
		$course_id = $this->input->post('course_id');
		$discussion_id = $this->input->post('discussion_id');
		$course_title = $this->input->post('course_title');
		$comment_content = $this->input->post('discussion-content');
		$user_id = $this->session->userdata('user_id');
		$datetime = new DateTime();

		$save_comment_discussion = $this->course_model->saveCommentDiscussion($comment_content, $discussion_id, $user_id, $datetime);

		if ($save_comment_discussion == 1) {
			header('location:'.base_url().'course/learn/'.$course_id.'/'.$discussion_id.'/'.$course_title);
		}
	}

	public function saveCommentDiscussionLearning() {
		$course_id = $this->input->post('course_id');
		$discussion_id = $this->input->post('discussion_id');
		$course_title = $this->input->post('course_title');
		$comment_content = $this->input->post('discussion-content');
		$user_id = $this->session->userdata('user_id');
		$datetime = new DateTime();

		$save_comment_discussion = $this->course_model->saveCommentDiscussion($comment_content, $discussion_id, $user_id, $datetime);

		if ($save_comment_discussion == 1) {
			header('location:'.base_url().'course/learning/'.$course_id.'/'.$discussion_id.'/'.$course_title);
		}
	}

	public function setScheduleLiveCourse() {
		$course_id = $this->input->post('course_id');
		$user_id = $this->session->userdata('user_id');
		$course_id = $this->input->post('course_id');
		$course_title = $this->input->post('course_title');

		$get_course_schedule = $this->course_model->getCourseScheduleTitle($course_id)->result_array();

		foreach ($get_course_schedule as $course_schedule) {
			$pilihanJadwal[] = array('schedule_id' => $this->input->post($course_schedule['title']));
		}

		foreach ($pilihanJadwal as $jadwal) {
			$this->course_model->saveCourseSchedule($user_id, $jadwal['schedule_id']);
		}

		header('location:'.base_url().'course/learn/'.$course_id.'/'.$course_title);
	}

	public function bookingSchedule() {

		$bid = $this->input->get('bid');
		list($courseId, $courseTitle, $scheduleId) = explode(';', $bid);

		$userId = $this->session->userdata('user_id');

		$this->course_model->saveCourseSchedule($userId, $scheduleId);

		header('location:'.base_url().'course/learn/'.$courseId.'/'.$courseTitle);
	}
}