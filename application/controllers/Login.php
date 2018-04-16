<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
   		$this->load->model('user');
 	}


	public function index()
	{
		if(!$this->session->logged_in) {
			if(!$_POST) {
				$this->load->helper(array('form'));
				$data['title'] = "Logowanie";
				$this->load->view('header', $data);
		   		$this->load->view('users/login');
		   		$this->load->view('footer');
			} else {
				$this->login();
			}
		} else {
			echo "Jesteś już zalogowany!";
		}
	}


	private function login() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login', 'Login', 'trim|required', array(
			'required' => $this->set_error("Login jest wymagany!")));
		$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_checkUser', array(
			'required' => $this->set_error("Hasło jest wymagane!"),
			'checkUser' => $this->set_error("Login bądź hasło jest nieprawidłowy!")));

		if($this->form_validation->run() == FALSE) {
			$data['title'] = "Logowanie";
			$this->load->view('header', $data);
			$this->load->view('users/login');
			$this->load->view('footer');
		} else {
			if($this->session->logged_in)
			$data = array(
				'user' => $this->session->logged_in,
				'modal' => array(
					'title' => "Logowanie",
					'text' => "Zalogowałeś się pomyślnie."
					)
				);
			$this->load->model('ads');
			$data['title'] = "Strona Główna";
			$data['categories'] = $this->ads->getCategories();
			$data['ads'] = $this->ads->getLastAds();
			$this->load->view('header', $data);
			$this->load->view('start', $data);
			$this->load->view('footer', $data);
		}
	}

 	function checkUser($password) {
 		$login = $this->input->post('login');
 		$query = $this->user->login($login, $password);

 		if($query) {
 			$sess_array = array();
 			foreach($query as $row) {
 				$sess_array = array(
 					'id' => $row->id,
 					'login' => $row->login
 					);
 				$this->session->set_userdata('logged_in', $sess_array);
 			}
 			return TRUE;
 		} else {
 			return FALSE;
 		}
	}

	private function set_error($text) {
		return '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width:80%; margin: 0 auto;">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				  '.$text.'
				</div>';
	}
}
