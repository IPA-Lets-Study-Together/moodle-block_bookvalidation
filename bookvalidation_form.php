<?php

require_once("{$CFG->libdir}/formslib.php");
 
class bookvalidation_form extends moodleform {
 
    function definition() {

    	global $CFG, $DB, $USER, $COURSE;
 
        $mform =& $this->_form;

        $query = 'SELECT b.id AND b.name
        	FROM {book} b
        	JOIN (
        		SELECT cu.id
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
				) AS part ON part.instanceid = cu.id
        	) AS part2 ON part2.id = b.course';
		
			$books = $DB->get_records_sql($query, array($USER->id));

			foreach ($books as $book) {

				//check if there are any records that need attention
				$query = 'SELECT chapterid 
					FROM {booktool_validator} WHERE bookid = ? AND validated = 0';
				if($DB->record_exists_sql($query, array($book->id))) {
					echo(array($book->name));
					
				}
			}

        /*$course_query = 'SELECT cu.id
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
			) AS part ON part.instanceid = cu.id';*/

		$courses = $DB->get_records_sql($query, array($USER->id));


		var_dump($courses);


        $mform->addElement('header','displayinfo', get_string('textfields', 'block_simplehtml'));
        $options = array();
		//$mform->addElement('selectwithlink', 'scaleid', get_string('scale'), $options, null, 
    	array('link' => $CFG->wwwroot . 'mod/book/view.php?id=' . $COURSE->id . '&chapterid=' . $chapterid, 'label' => get_string('scalescustomcreate')));
    }
}