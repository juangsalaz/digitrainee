<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_model extends CI_Model {
	function __construct() {
        parent::__construct();
    }

    public function createCourse($title, $category, $userId, $status = 3) {
        $sql = "INSERT INTO digi_course SET 
                name = '".$title."', 
                category_id = '".$category."', 
                user_added = '".$userId."', 
                status = ".$status.", 
                date_submitted = NOW()";

        $query = $this->db->query($sql);

        return $this->db->insert_id();
    }

    public function detailBasicInfo($id) {
        $sql = "SELECT c.*, u.username as instructor, cat.name as category_name, up.about as instructor_about
                FROM digi_course c 
                LEFT JOIN digi_category cat ON cat.id = c.category_id
                LEFT JOIN digi_users u ON u.uuid = c.user_added
                LEFT JOIN digi_user_profile up ON u.uuid = up.uuid
                WHERE c.id = '".$id."'";

        $query = $this->db->query($sql);

        return $query;        
    }

    public function saveBasicInfo($description, $level, $isFree, $price, $tools, $tags, $id) {

        $sql = "UPDATE digi_course SET 
                description = '".$description."', 
                is_free = '".$isFree."', 
                price = '".$price."', 
                level = '".$level."', 
                tool_requirement = '".$tools."', 
                tag = '".$tags."' 
                WHERE id = ".$id;

        $query = $this->db->query($sql);

        return $query;
    }

    public function updateCourseTitle($title, $id) {
        $sql = "UPDATE digi_course SET name = '".$title."' WHERE id = ".$id;
        $query = $this->db->query($sql);

        return $query;
    }

    public function updateCourseBanner($banner, $id) {
        $sql = "UPDATE digi_course SET banner = '".$banner."' WHERE id = ".$id;
        $query = $this->db->query($sql);

        return $query;
    }

    public function updateCourseVideoPromo($video, $id) {
        $sql = "UPDATE digi_course SET video_promo = '".$video."' WHERE id = ".$id;
        $query = $this->db->query($sql);

        return $query;
    }

    public function deleteCourseCategory($courseId) {
        $sql = "DELETE FROM digi_course_category WHERE course_id = ".$courseId;
        return $this->db->query($sql);
    }

    public function saveCourseCategory($courseId, $catId) {
        $sql = "INSERT INTO digi_course_category SET course_id = ".$courseId.", category_id = ".$catId;
        return $this->db->query($sql);
    }

    public function categoryList() {
        $query = $this->db->query("SELECT * FROM digi_category WHERE is_enabled = 1");
        return $query;
    }

    public function courseCurriculums($cId) {
        $query = "SELECT * FROM digi_course_curriculum WHERE course_id = '".$cId."'";
        $result = $this->db->query($query);

        return $result;
    }

    public function saveCurriculum($cId, $name) {
        $query = $this->db->query("INSERT INTO digi_course_curriculum SET course_id = '".$cId."', name = '".$name."'");
        return $this->db->insert_id();
    }

    public function updateCurriculum($id, $name) {
        $query = $this->db->query("UPDATE digi_course_curriculum SET name = '".$name."' WHERE id = '".$id."'");
        return $query;
    }

    public function deleteCurriculum($id) {
        $query = $this->db->query("DELETE FROM digi_course_curriculum WHERE id = '".$id."'");
        return $query;
    }

    public function courseCurriculumTopics($cId) {
        $query = "SELECT cd.*, q.id AS quiz_id, q.title AS quiz_title, q.timelimit AS quiz_timelimit, q.lifetime AS quiz_lifetime, q.intro AS quiz_intro, q.total_score AS quiz_total_score, q.total_question AS quiz_total_question, q.total_easy_question, q.total_medium_question, q.total_hard_question
                    FROM digi_course_curriculum_detail cd 
                    LEFT JOIN digi_course_curriculum_quiz q ON q.curriculum_detail_id = cd.id
                    WHERE curriculum_id = '".$cId."' ORDER BY cd.id";
        $result = $this->db->query($query);

        return $result;
    }

    public function detailCurriculumTopic($id) {
        $query = "SELECT d.*, dc.course_id FROM digi_course_curriculum_detail d 
                    LEFT JOIN digi_course_curriculum dc ON dc.id = d.curriculum_id
                    LEFT JOIN digi_course c ON c.id = dc.course_id
                    WHERE curriculum_id = '".$id."'";
        $result = $this->db->query($query);

        return $result;
    }

    public function saveCurriculumTopic($cId, $name, $type = '1') {
        $query = $this->db->query("INSERT INTO digi_course_curriculum_detail SET curriculum_id = '".$cId."', topic = '".$name."', type = '".$type."'");
        return $this->db->insert_id();
    }

    public function updateCurriculumTopic($id, $name, $isFree) {
        $sql = "UPDATE digi_course_curriculum_detail SET topic = '".$name."', is_free = '".$isFree."' WHERE id = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function updateTopicContent($id, $type, $name, $filetype, $size) {
        $query = $this->db->query("UPDATE digi_course_curriculum_detail SET content_type = '".$type."', content_filename = '".$name."', content_filetype = '".$filetype."', content_filesize = '".$size."' WHERE id = '".$id."'");
        return $query;
    }

    public function deleteTopicByCurriculum($cid) {
        $query = $this->db->query("DELETE FROM digi_course_curriculum_detail WHERE curriculum_id = '".$cid."'");
        return $query;
    }

    public function deleteCurriculumTopic($id) {
        $query = $this->db->query("DELETE FROM digi_course_curriculum_detail WHERE id = '".$id."'");
        return $query;
    }

    public function getCourses() {
        // $query = $this->db->query("SELECT digi_course.id AS course_id, digi_category.name AS category, digi_course.name AS course_title, digi_course.price AS course_price, digi_users.username AS user_name, digi_users.uuid AS user_id, digi_course.is_free, digi_user_profile.picture FROM digi_course, digi_category, digi_users, digi_user_profile WHERE digi_category.id = digi_course.category_id AND digi_course.user_added = digi_users.uuid AND digi_user_profile.uuid = digi_users.uuid AND digi_course.status = 1 ORDER BY digi_course.id DESC");
        $query = $this->db->query("SELECT digi_course.id AS course_id, digi_category.name AS category, digi_course.name AS course_title, digi_course.price AS course_price, digi_course.banner AS banner,  digi_users.username AS user_name, digi_users.uuid AS user_id, digi_course.is_free, digi_user_profile.picture FROM digi_course, digi_category, digi_users, digi_user_profile WHERE digi_category.id = digi_course.category_id AND digi_course.user_added = digi_users.uuid AND digi_user_profile.uuid = digi_users.uuid AND digi_course.status = 3 ORDER BY digi_course.id DESC");
        return $query;
    }

    public function countCourseMember($course_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM digi_users_course WHERE digi_users_course.course_id = '".$course_id."'");
        return $query;
    }

    public function getCategories() {
        $query = $this->db->query("SELECT * FROM digi_category order by digi_category.id");
        return $query;
    }

    public function getCategoryId($category) {
        $query = $this->db->query("SELECT id FROM digi_category WHERE name = '".$category."'");
        return $query;
    }

    public function getCourseByCategory($category_id) {
        // $query = $this->db->query("SELECT digi_course.id AS course_id, digi_category.name AS category, digi_course.name AS course_title, digi_course.price AS course_price, digi_users.username AS user_name, digi_users.uuid AS user_id, digi_course.is_free, digi_user_profile.picture FROM digi_course, digi_category, digi_users, digi_user_profile WHERE digi_category.id = digi_course.category_id AND digi_course.user_added = digi_users.uuid AND digi_users.uuid = digi_user_profile.uuid AND digi_course.status = 1 AND digi_course.category_id = '".$category_id."' ORDER BY digi_course.id DESC");
        $query = $this->db->query("SELECT digi_course.id AS course_id, digi_category.name AS category, digi_course.name AS course_title, digi_course.price AS course_price, digi_users.username AS user_name, digi_users.uuid AS user_id, digi_course.is_free, digi_user_profile.picture FROM digi_course, digi_category, digi_users, digi_user_profile WHERE digi_category.id = digi_course.category_id AND digi_course.user_added = digi_users.uuid AND digi_users.uuid = digi_user_profile.uuid AND digi_course.status = 3 AND digi_course.category_id = '".$category_id."' ORDER BY digi_course.id DESC");
        return $query;
    }

    public function teachingList($userId) {
        $sql = "SELECT c.id, c.name as title, cat.name as category_name, c.description, c.is_free, c.price, c.discount, c.banner,
                c.discount_deadline, c.date_submitted, c.date_modified, c.status, c.level, u.username as instructor, up.picture
                FROM digi_course c 
                LEFT JOIN digi_category cat ON cat.id = c.category_id
                LEFT JOIN digi_users u ON u.uuid = c.user_added
                LEFT JOIN digi_user_profile up ON up.uuid = c.user_added
                WHERE c.user_added = '".$userId."' AND c.is_deleted = 0
                ORDER BY c.date_submitted";

        $query = $this->db->query($sql);
        return $query;
    }


    public function getCourseById($course_id) {
        $query = $this->db->query("SELECT digi_course.id AS course_id, digi_course.name AS course_title, digi_course.description AS course_description, digi_course.price, digi_course.banner, digi_course.video_promo_path, digi_course.tool_requirement, digi_course.tag, digi_user_profile.about AS about_instructur, digi_users.username, digi_course.is_free, digi_course.video_promo, digi_category.name AS category_name, digi_user_profile.picture FROM digi_course, digi_users, digi_category, digi_user_profile WHERE digi_course.id = '".$course_id."' AND digi_course.user_added = digi_users.uuid AND digi_course.category_id = digi_category.id AND digi_users.uuid = digi_user_profile.uuid");
        return $query;
    }

    public function getCurriculum($course_id) {
        $query = $this->db->query("SELECT * FROM digi_course_curriculum WHERE course_id = '".$course_id."'");
        return $query;
    }

    public function getCurriculumUnit($course_id) {
        $query = $this->db->query("SELECT cd.id AS unit_id, cd.curriculum_id, cd.topic, cd.content_type, cd.is_free, cd.type FROM digi_course_curriculum_detail cd, digi_course_curriculum cc WHERE cc.course_id = '".$course_id."' AND cd.curriculum_id = cc.id");
        return $query;
    }

    public function getCurriculumQuiz($course_id) {
        $query = $this->db->query("SELECT cq.id AS quiz_id, cq.curriculum_detail_id, cq.title, cq.intro, cq.timelimit, cq.total_score FROM digi_course_curriculum_quiz cq, digi_course_curriculum_detail cd, digi_course_curriculum cc WHERE cq.curriculum_detail_id = cd.id AND cd.curriculum_id = cc.id AND cc.course_id = '".$course_id."'");
        return $query;
    }

    public function getCurriculumUnitLearned($course_id, $user_id) {
        $query = $this->db->query("SELECT cd.id AS unit_id, cd.curriculum_id, cd.topic, cd.content_type, uc.learned_mark, cd.type FROM digi_course_curriculum_detail cd, digi_course_curriculum cc, digi_users_course uc WHERE cc.course_id = '".$course_id."' AND cd.curriculum_id = cc.id AND uc.unit_id = cd.id AND uc.curriculum_id = cc.id AND uc.user_id = '".$user_id."'");
        return $query;
    }

    public function getCurriculumUnitUser($course_id, $user_id) {
        $query = $this->db->query("SELECT * FROM digi_users_course uc WHERE uc.user_id = '".$user_id."' AND uc.course_id = '".$course_id."'");
        return $query;
    }

    public function getCurriculumUnitQuiz($course_id, $user_id) {
        $query = $this->db->query("SELECT cd.id AS unit_id, cq.id AS quiz_id FROM digi_course_curriculum_detail cd, digi_course_curriculum cc, digi_users_course uc, digi_course_curriculum_quiz cq WHERE cc.course_id = '".$course_id."' AND cd.curriculum_id = cc.id AND uc.unit_id = cd.id AND uc.curriculum_id = cc.id AND cq.curriculum_detail_id = cd.id AND uc.user_id = '".$user_id."'");
        return $query;
    }

    public function getUsersCourse($course_id) {
        $query = $this->db->query("SELECT DISTINCT u.username, up.picture FROM digi_users u, digi_users_course uc, digi_user_profile up WHERE uc.course_id = '".$course_id."' AND uc.user_id = u.uuid AND u.uuid = up.uuid");
        return $query;
    }

    public function countSection($id) {
        $sql = "SELECT count(1) as cnt FROM digi_course_curriculum WHERE course_id = '".$id."'";
        $query = $this->db->query($sql);

        $res = $query->result_array();

        return $res[0]['cnt'];   
    }

    public function countSectionUnit($id) {
        $sql = "SELECT count(1) as cnt FROM digi_course_curriculum JOIN digi_course_curriculum_detail ON digi_course_curriculum_detail.curriculum_id = digi_course_curriculum.id WHERE course_id = '".$id."'";
        $query = $this->db->query($sql);

        $res = $query->result_array();

        return $res[0]['cnt'];   
    }

    public function confirmCourse($id) {
        $sql = "UPDATE digi_course SET status = 2 WHERE id = '".$id."'";
        $query = $this->db->query($sql);

        return $query;   
    }
	
	public function saveDraft($id) {
        $sql = "UPDATE digi_course SET status = 1 WHERE id = '".$id."'";
        $query = $this->db->query($sql);

        return $query;   
    }

    public function takeCourse($user_id, $course_id, $curriculum_id, $unit_id, $enroll_date, $course_price) {
        $query = $this->db->query("INSERT INTO digi_users_course (user_id, course_id, curriculum_id, unit_id, learned_mark, enroll_date, course_price) VALUES ('".$user_id."', '".$course_id."', '".$curriculum_id."', '".$unit_id."', 0, '".$enroll_date."', '".$course_price."')");
    }

    public function saveCurriculumQuiz($cId, $title) {
        $sql = "INSERT INTO digi_course_curriculum_quiz SET curriculum_detail_id = '".$cId."', title = '".$title."'";
        $query = $this->db->query($sql);
        return $this->db->insert_id();
    }

    public function deleteCurriculumQuiz($id) {
        $query = $this->db->query("DELETE FROM digi_course_curriculum_quiz WHERE id = '".$id."'");
        return $query;
    }

    public function updateCurriculumQuiz($id, $title, $timelimit, $lifetime, $total_easy_question, $total_medium_question, $total_hard_question, $intro) {
        $sql = "UPDATE digi_course_curriculum_quiz SET title = '".$title."', timelimit = '".$timelimit."', lifetime = '".$lifetime."', total_easy_question = '".$total_easy_question."', total_medium_question = '".$total_medium_question."', total_hard_question = '".$total_hard_question."', intro = '".$intro."' WHERE id = '".$id."'";
        $query = $this->db->query($sql);
        return "$query";
    }

    public function findQuizByCurriculum($id) {
        $sql = "SELECT q.* FROM digi_course_curriculum_quiz q 
                JOIN digi_course_curriculum_detail cd ON cd.id = q.curriculum_detail_id
                WHERE cd.curriculum_id = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function findQuizById($id) {
        $sql = "SELECT * FROM digi_course_curriculum_quiz WHERE id = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function findQuestionById($id) {
        $sql = "SELECT * FROM digi_quiz_question WHERE id = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function findQuestionByQuiz($id) {
        $sql = "SELECT * FROM digi_quiz_question WHERE quiz_id = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function findAnswerByQuestion($id) {
        $sql = "SELECT * FROM digi_quiz_answer WHERE question_id = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function saveQuizQuestion($id, $title, $type, $level, $content) {
        $sql = "INSERT INTO digi_quiz_question (quiz_id, title, type, question_weight, question) VALUES  ('".$id."', '".$title."', '".$type."', '".$level."', '".$content."')";
        $query = $this->db->query($sql);
        return $this->db->insert_id();
    }

    public function updateQuizQuestion($id, $title, $type, $level, $content) {
        $sql = "UPDATE digi_quiz_question SET title = '".$title."', type = '".$type."', question_weight = '".$level."', question = '".$content."' WHERE id = '".$id."' ";
        $query = $this->db->query($sql);
        return $query;
    }

    public function updateQuestionScore($id, $score) {
        $sql = "UPDATE digi_quiz_question SET score = '".$score."' WHERE id = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function deleteQuestion($id) {
        $sql = "DELETE FROM digi_quiz_question WHERE id = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function saveQuizAnswer($id, $answer, $is_true = 0) {
        $sql = "INSERT INTO digi_quiz_answer SET question_id = '".$id."', answer = '".$answer."', is_true = '".$is_true."'";
        $query = $this->db->query($sql);
        return $this->db->insert_id();
    }

    public function deleteAnswerByQuestion($id) {
        $sql = "DELETE FROM digi_quiz_answer WHERE question_id = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getUnitById($unit_id) {
        $query = $this->db->query("SELECT * FROM digi_course_curriculum_detail WHERE id = '".$unit_id."'");
        return $query;
    }

    public function getCurriculumId($unit_id) {
        $query = $this->db->query("SELECT digi_course_curriculum.id AS curriculum_id FROM digi_course_curriculum, digi_course_curriculum_detail WHERE digi_course_curriculum_detail.id = '".$unit_id."' AND digi_course_curriculum_detail.curriculum_id = digi_course_curriculum.id");
        return $query;
    }

    public function getCurriculumById($curriculum_id) {
        $query = $this->db->query("SELECT digi_course_curriculum.name FROM digi_course_curriculum WHERE digi_course_curriculum.id = '".$curriculum_id."'");
        return $query;
    }

    public function getCourseId($curriculum_id) {
        $query = $this->db->query("SELECT digi_course.id AS course_id FROM digi_course, digi_course_curriculum WHERE digi_course_curriculum.id = '".$curriculum_id."' AND digi_course_curriculum.course_id = digi_course.id");
        return $query;
    }

    public function markaslearned($unit_id, $user_id) {
        $query = $this->db->query("UPDATE digi_users_course SET learned_mark = 1 WHERE unit_id = '".$unit_id."' AND user_id = '".$user_id."'");
        return $query;
    }

    public function markasnotlearned($unit_id, $user_id) {
        $query = $this->db->query("UPDATE digi_users_course SET learned_mark = 0 WHERE unit_id = '".$unit_id."' AND user_id = '".$user_id."'");
        return $query;
    }

    public function isLearned($unit_id, $user_id) {
        $query = $this->db->query("SELECT * FROM digi_users_course WHERE learned_mark = 1 AND unit_id = '".$unit_id."' AND user_id = '".$user_id."'");
        return $query;
    }

    public function countAllUnit($course_id, $user_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total_unit FROM digi_users_course WHERE course_id = '".$course_id."' AND user_id = '".$user_id."'");
        return $query;
    }

    public function countMarkedUnit($course_id, $user_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total_marked_unit FROM digi_users_course WHERE learned_mark = 1 AND course_id = '".$course_id."' AND user_id = '".$user_id."'");
        return $query;
    }

    public function isTakedCourse($user_id, $course_id) {
        $query = $this->db->query("SELECT * FROM digi_users_course WHERE user_id = '".$user_id."' AND course_id = '".$course_id."'");
        return $query;
    }

    public function getQuestion($quiz_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total_question FROM digi_quiz_question WHERE quiz_id = '".$quiz_id."'");
        return $query;
    }

    public function checkCouponcode($couponcode) {
        $query = $this->db->query("SELECT * FROM digi_coupons WHERE coupon_code = '".$couponcode."' AND is_used = 0");
        return $query;
    }

    public function updateVoucher($couponcode) {
        $query = $this->db->query("UPDATE digi_coupons SET is_used = 1 WHERE coupon_code = '".$couponcode."'");
        return $query;
    }

    public function saveSaldoDeposit($saldo, $user_id) {
        $query = $this->db->query("UPDATE digi_users SET saldo_deposit = '".$saldo."' WHERE uuid = '".$user_id."'");
        return $query;
    }

    public function addCourseDiscussion($topic_title, $discussion_content, $course_id, $user_id, $datetime) {
        $query = $this->db->query("INSERT INTO digi_course_discussion (topic, content, user_created, course_id, datetime) VALUES ('".$topic_title."', '".$discussion_content."', '".$user_id."', '".$course_id."', '".$datetime."')");
        return $query;
    }

    public function getDiscussion($course_id) {
        $query = $this->db->query("SELECT ds.*, u.username, up.picture FROM digi_course_discussion ds, digi_users u, digi_user_profile up WHERE course_id = '".$course_id."' AND ds.user_created = u.uuid AND ds.user_created = up.uuid ORDER BY ds.datetime DESC");
        return $query;
    }

    public function getUserLogin($user_id) {
        $query = $this->db->query("SELECT * FROM digi_users u, digi_user_profile up WHERE u.uuid = '".$user_id."' AND u.uuid = up.uuid");
        return $query;
    }

    public function getDiscussionById($discussion_id) {
        $query = $this->db->query("SELECT cd.*, u.username, up.picture FROM digi_course_discussion cd, digi_users u, digi_user_profile up WHERE id = '".$discussion_id."' AND cd.user_created = u.uuid AND u.uuid = up.uuid");
        return $query;
    }

    public function saveCommentDiscussion($comment_content, $discussion_id, $user_id, $datetime) {
        $query = $this->db->query("INSERT INTO digi_course_comment_discussion (comment, discussion_id, user_comment, datetime) VALUES ('".$comment_content."', '".$discussion_id."', '".$user_id."', '".$datetime."')");
        return $query;
    }

    public function getDiscussionComment($discussion_id) {
        $query = $this->db->query("SELECT cds.*, u.username, up.picture FROM digi_course_comment_discussion cds, digi_users u, digi_user_profile up WHERE discussion_id = '".$discussion_id."' AND cds.user_comment = u.uuid AND u.uuid = up.uuid ORDER BY id DESC");
        return $query;
    }

    public function countCommentDiscussion($discussion_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total_comment FROM digi_course_comment_discussion WHERE discussion_id = '".$discussion_id."'");
        return $query;
    }

    public function getDiscussionAdded($topic_title, $discussion_content, $course_id) {
        $query = $this->db->query("SELECT * FROM digi_course_discussion WHERE topic = '".$topic_title."' AND content = '".$discussion_content."' AND course_id = '".$course_id."'");
        return $query;
    }

    public function getCourseScheduleTitle($course_id) {
        $query = $this->db->query("SELECT * FROM digi_livecourse_schedule WHERE pre_req_course_id = '".$course_id."' GROUP BY title");
        return $query;
    }

    public function getCourseSchedule($course_id) {
        $query = $this->db->query("SELECT * FROM digi_livecourse_schedule WHERE pre_req_course_id = '".$course_id."'");
        return $query;
    }

    public function checkUserSchedule($user_id, $schedule_id) {
        $query = $this->db->query("SELECT * FROM digi_livecourse_user_booking WHERE user_id = '".$user_id."' AND schedule_id = '".$schedule_id."'");
        return $query;
    }

    /** live course **/
    public function findLivecourseScheduleByCourse($id, $userId) {
        $sql = "SELECT lc.*, date_format(lc.course_date, '%d-%m-%Y %h:%i') as course_date_str, cc.name AS section_name, ccd.topic AS unit_name, ub.id AS booking_id, 
                (select count(1) from digi_course_curriculum_detail ccd1 join digi_course_curriculum cc1 on cc1.id = ccd1.curriculum_id where cc1.course_id = lc.course_id and ccd1.curriculum_id <= lc.curriculum_id and ccd1.type = 1) as unit_cnt, 
                (select count(1) from digi_livecourse_user_booking ub where ub.schedule_id = lc.id) as user_booking_cnt
                FROM digi_livecourse_schedule lc
                LEFT JOIN digi_course_curriculum cc ON cc.id = lc.curriculum_id
                LEFT JOIN digi_course_curriculum_detail ccd ON ccd.id = lc.curriculum_detail_id
                LEFT JOIN digi_livecourse_user_booking ub ON ub.schedule_id = lc.id AND ub.user_id = '".$userId."'
                WHERE lc.course_id = '".$id."' 
                ORDER BY lc.curriculum_id, lc.curriculum_detail_id";
        $query = $this->db->query($sql);

        return $query;        
    }

    public function getCountUnitUserLearnedBySection($courseId, $curriculumId, $userId)
    {
        $sql = "SELECT COUNT(1) AS cnt FROM digi_users_course uc
                JOIN digi_course_curriculum_detail ccd ON ccd.curriculum_id = uc.curriculum_id
                JOIN digi_course_curriculum cc ON cc.id = ccd.curriculum_id
                WHERE cc.course_id = '".$courseId."' AND uc.curriculum_id <= '".$curriculumId."' AND uc.user_id = '".$userId."' 
                AND ccd.type = 1 AND uc.learned_mark = 1 ";

        $query = $this->db->query($sql);
        $res = $query->result_array();
        
        return (count($res) > 0) ? $res[0]['cnt'] : 0;
    }

    public function saveCourseSchedule($user_id, $schedule_id) 
    {
        $sql = "INSERT INTO digi_livecourse_user_booking SET schedule_id = '".$schedule_id."', user_id = '".$user_id."'";
        $query = $this->db->query($sql);
        return $query;
    }
    /** end live course **/

    /*Update curriculum unit*/
    public function deleteCurriculumUnitUser($user_id, $unit_id) {
        $query = $this->db->query("DELETE FROM digi_users_course WHERE user_id = '".$user_id."' AND unit_id = '".$unit_id."'");
        return $query;
    }
}