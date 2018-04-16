<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {


	public function login($login, $password) {
		$this->db->select('id, login, password');
		$this->db->from('gm_users');
		$this->db->where('login', $login);
		$this->db->where('password', MD5($password));
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1) {
			$this->db->set('last_logon', time());
			$this->db->where('login', $login);
			$this->db->update('gm_users');
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function register($login, $password, $email) {
		$data = array(
			'login' => $login,
			'password' => MD5($password),
			'email' => $email,
			'created' => time()+timeDefference(),
			'last_logon' => time()+timeDefference()
			);
		$this->db->insert('gm_users', $data);
		$status = $this->login($login, $password);
		if($status == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkLogin($login) {
		$this->db->select('*');
		$this->db->from('gm_users');
		$this->db->where('login', $login);
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return FALSE;
		} else {
			return TRUE;
		}

	}

	public function checkEmail($email) {
		$this->db->select('*');
		$this->db->from('gm_users');
		$this->db->where('email', $email);
		$this->db->limit(1);

		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function getProfile($id) {
		$this->db->select('login, email, created, last_logon, first_name');
		$this->db->from('gm_users');
		$this->db->where('id', $id);

		$query = $this->db->get();

		if(empty($query->result()))
			return FALSE;

		foreach ($query->result() as $row)
		{
			$profile = array(
				'login' => $row->login,
				'email' => $row->email,
				'created' => $row->created,
				'last_logon' => $row->last_logon,
				'first_name' => $row->first_name
				);        	
		}
		
		return $profile;
	}

	public function isUserOnline($id) {
		$this->db->select('last_logon');
		$this->db->from('gm_users');
		$this->db->where('id', $id);

		$query = $this->db->get();

		$row = $query->row();
		if(isset($row)) {
			if(time()+timeDefference() - $row->last_logon <= 300) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

}