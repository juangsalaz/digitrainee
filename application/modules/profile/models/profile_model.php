<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model {
	function __construct() {
        parent::__construct();
    }

    public function getUserById($user_id) {
        $query = $this->db->query("SELECT * FROM digi_users, digi_user_profile WHERE digi_users.uuid = digi_user_profile.uuid AND digi_users.uuid = '".$user_id."'");
        return $query;
    }

    public function updateProfile($email, $current_password, $new_password, $company = '') {
    	$query = $this->db->query("UPDATE digi_users SET email = '".$email."', password = '".$new_password."', company_id = '".$company."' WHERE password = '".$current_password."'");
    	return $query;
    }

    public function updateUser($id, $email, $company = '') {
        $query = $this->db->query("UPDATE digi_users SET email = '".$email."', company_id = '".$company."' WHERE uuid = '".$id."'");
        return $query;
    }

    public function updatePicture($file_name, $user_id) {
    	$query = $this->db->query("UPDATE digi_user_profile SET picture = '".$file_name."' WHERE uuid = '".$user_id."'");
    	return $query;
    }

    public function getUserDataByEmail($email) {
        $query = $this->db->query("SELECT * FROM digi_users, digi_user_profile WHERE digi_users.uuid = digi_user_profile.uuid AND digi_users.email = '".$email."'");
        return $query;
    }

    public function getTeachingCourses($user_id) {
        $query = $this->db->query("SELECT digi_course.id AS course_id, digi_category.name AS category_name, digi_course.name AS course_name, digi_users.username, digi_user_profile.picture, digi_course.price FROM digi_course, digi_category, digi_users, digi_user_profile WHERE digi_course.category_id = digi_category.id AND digi_course.user_added = digi_users.uuid AND digi_users.uuid = digi_user_profile.uuid AND digi_course.user_added = '".$user_id."' AND digi_course.is_deleted = 0");
        return $query;
    }

    public function countCourseMember($course_id) {
        $query = $this->db->query("SELECT COUNT(*) AS course_member FROM digi_users, digi_course, digi_users_course WHERE digi_users_course.course_id = '".$course_id."' AND digi_users_course.user_id = digi_users.uuid AND digi_users_course.course_id = digi_course.id");
        return $query;
    }

    public function getLearningCourse($user_id) {
        $query = $this->db->query("SELECT digi_course.id AS course_id, digi_category.name AS category_name, digi_course.name AS course_name, digi_course.banner AS banner FROM digi_course, digi_users, digi_user_profile, digi_users_course, digi_category WHERE digi_users.uuid = '".$user_id."' AND digi_users.uuid = digi_users_course.user_id AND digi_course.id = digi_users_course.course_id AND digi_course.category_id = digi_category.id GROUP BY digi_course.id");
        return $query;
    }

    public function getAddedCourseUser($course_id) {
        $query = $this->db->query("SELECT * FROM digi_users, digi_course, digi_user_profile WHERE digi_course.id = '".$course_id."' AND digi_users.uuid = digi_course.user_added AND digi_user_profile.uuid = digi_course.user_added");
        return $query;
    }

    public function cekCurrentPassword($email, $current_password) {
        $query = $this->db->query("SELECT * FROM digi_users WHERE digi_users.email = '".$email."' AND digi_users.password = '".$current_password."'");
        return $query;
    }

    public function saveAboutUser($user_about, $user_id) {
        $query = $this->db->query("UPDATE digi_user_profile SET about = '".$user_about."' WHERE uuid = '".$user_id."'");
        return $query;
    }

    public function findActiveCompany() {
        $query = $this->db->query("SELECT * FROM digi_company WHERE is_enabled = 1");
        return $query;
    }
}