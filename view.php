<?php

require_once('../../config.php');
require_once('bookvalidation_form.php');

global $DB, $USER, $OUTPUT, $PAGE;

// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);
 
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_simplehtml', $courseid);
}
 
require_login($course);

$PAGE->set_url('/blocks/bookvalidation/view.php', array('id'=>$courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('bookvalidation', 'block_bookvalidation'));

$bookvalidation = new bookvalidation_form();

echo $OUTPUT->header();
$bookvalidation->display();
echo $OUTPUT->footer();