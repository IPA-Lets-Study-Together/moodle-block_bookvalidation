<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * 
 *
 * @package    
 * @copyright  2014 Ivana Skelic, Hrvoje Golcic 
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_bookvalidation extends block_base {
	public function init() {
		$this->title = get_string('bookvalidation', 'block_bookvalidation');
	}

	public function get_content(){
		if ($this->content !== null) {
			return $this->content;
		}

		$this->content 	new stdClass;

		$cmid = required_param('cmid', PARAM_INT); //Book Course Module ID
		$cm = get_coursemodule_from_id('book', $cmid, 0, false, MUST_EXIST);
		$course = $DB->get_record('course', array('id'=>$cm->course), '*', MUST_EXIST);
		$book = $DB->get_record('book', array('id'=>$cm->instance), '*', MUST_EXIST);

		require_login($course, false, $cm);

		try {
			$data = $DB->get_records_sql('SELECT u.firstname FROM 
				mdl_user u
				JOIN mdl_role_assignments ra ON ra.userid=u.id
				JOIN mdl_role r ON ra.roleid=r.id
				JOIN mdl_context con ON ra.contextid=con.id
				JOIN mdl_course c ON c.id=con.instanceid
				WHERE r.shortname="student" AND c.id="2"');

			var_dump($data);
		} catch (Exception $e) {
			echo "problems, problems";
		}
	}

	public function instance_allow_multiple() {
		return false;
	}
}