<?php

require_once('../../config.php');
//require_once('bookvalidation_form.php');

global $DB, $USER, $OUTPUT, $PAGE;

// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);
 
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_simplehtml', $courseid);
}
 
require_login($course);

$PAGE->set_url('/blocks/bookvalidation/view.php', array('id'=>$courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('bookvalidation', 'block_simplehtml'));

//$bookvalidation = new bookvalidation_form();

$query = 'SELECT cu.fullname
				FROM {course} cu
				JOIN (

					SELECT u.id AS userid, u.firstname AS name, mrs.contextid, mrs.roleid, c.instanceid
					FROM {user} u
					JOIN {role_assignments} mrs ON mrs.userid = u.id
					JOIN {context} c ON c.id = mrs.contextid
					WHERE u.id = ?
					AND (
					mrs.roleid =3
					OR mrs.roleid =4
					OR mrs.roleid =1
					) AND c.contextlevel =50
				) AS part ON part.instanceid = cu.id';

		$data = $DB->get_records_sql($query, array($userid));

		var_dump($data);

echo $OUTPUT->header();
$bookvalidation->display();
echo $OUTPUT->footer();