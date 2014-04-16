<?php

require_once("{$CFG->libdir}/formslib.php");
 
class simplehtml_form extends moodleform {
 
    function definition() {
 
        $mform =& $this->_form;
        $mform->addElement('header','displayinfo', get_string('textfields', 'block_simplehtml'));
        $options = array();
$mform->addElement('selectwithlink', 'scaleid', get_string('scale'), $options, null, 
    array('link' => $CFG->wwwroot.'/grade/edit/scale/edit.php?courseid='.$COURSE->id, 'label' => get_string('scalescustomcreate')));
    }
}