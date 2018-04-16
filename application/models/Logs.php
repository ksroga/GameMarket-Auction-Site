<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs extends CI_Model {

	public function __construct() {
		$this->updateStatus();
	}

	public function updateStatus() {
		if($this->session->logged_in) {
			$data['last_logon'] = time()+timeDefference();
			$this->db->where('id', $this->session->logged_in['id']);
			$this->db->update('gm_users', $data);
		}
	}
}