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

defined('MOODLE_INTERNAL') || die;


class block_bookvalidation extends block_base {
	public function init() {
		$this->title = get_string('pluginname', 'block_bookvalidation');
	}

	public function get_content(){

		global $COURSE, $DB, $USER, $OUTPUT, $PAGE;

		if ($this->content !== null) {
			return $this->content;
		}	
		 
		$url = new moodle_url('/blocks/bookvalidation/view.php', array('blockid' => $this->instance->id, 'courseid' => $COURSE->id));
		$this->content->footer = html_writer::link($url, get_string('bookvalidation', 'block_bookvalidation'));
}

	public function instance_allow_multiple() {
		return false;
	}
}