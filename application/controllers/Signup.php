<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
   		$this->load->model('user');
 	}


	public function index()
	{
		if(!$this->session->logged_in) {
			if(!$_POST) {
				$data['title'] = "Rejestracja";
				$this->load->helper(array('form'));
				$this->load->view('header', $data);
		   		$this->load->view('users/signup');
		   		$this->load->view('footer');
			} else {
				$this->register();
			}
		} else {
			echo "Jesteś już zalogowany!";
		}
	}


	private function register() {
		$this->load->library('form_validation');
		$autoload['helper'] = array('url','form','security');
		$this->form_validation->set_rules('login', 'Login', 'trim|required|min_length[3]|callback_checkLogin', array(
			'required' => $this->set_error("Login jest wymagany!"),
			'min_length' => $this->set_error("Podany Login jest za krótki! (Minimum 3 znaki)"),
			'checkLogin' => $this->set_error("Taki login już istnieje!")));

		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]', array(
			'required' => $this->set_error("Hasło jest wymagane!"),
			'min_length' => $this->set_error("Podane hasło jest za krótkie!")));

		$this->form_validation->set_rules('password2', 'Password2', 'trim|required|callback_checkPassword', array(
			'required' => $this->set_error("Podane hasła nie zgadzają się!"),
			'checkPassword' => $this->set_error("Podane hasła nie zgadzają się!")));

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_checkEmail', array(
			'required' => $this->set_error("E-Mail jest wymagany!"),
			'valid_email' => $this->set_error("E-Mail jest nieprawidłowy!"),
			'checkEmail' => $this->set_error("Ten adres E-Mail jest już zarejestrowany!")));

		$this->form_validation->set_rules('rules', 'Rules', 'trim|required', array(
			'required' => $this->set_error("Musisz zaakceptować regulamin serwisu!")));


		if($this->form_validation->run() == FALSE) {
			$this->load->view('header');
			$this->load->view('users/signup');
			$this->load->view('footer');
		} else {
			/*
			if($this->session->logged_in)
			$data = array(
				'user' => $this->session->logged_in,
				'modal' => array(
					'title' => "Rejestracja",
					'text' => "Zarejestrowałeś się pomyślnie. Zostałeś zalogowany."
					)
				);

			$this->load->view('header', $data);
			$this->load->view('start');
			$this->load->view('footer', $data);
			*/
			$login = $this->input->post("login");
			$password = $this->input->post("password");
			$email = $this->input->post("email");

			if($this->user->register($login, $password, $email) == TRUE) {
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
		 			$data = array(
					'user' => $this->session->logged_in,
					'modal' => array(
						'title' => "Rejestracja",
						'text' => "Zarejestrowałeś się pomyślnie. Zostałeś zalogowany."
						)
					);
					$this->load->view('header', $data);
					$this->load->view('start');
					$this->load->view('footer', $data);
		 		} else {
		 			die("Wystąpił błąd. Spróbuj ponownie!");
		 		}
			} else {
				die("błąd jak skurwysyn");
			}
		}
	}

	public function checkLogin($login) {
			if($this->user->checkLogin($login) == TRUE) {
				return TRUE;
			} else {
				return FALSE;
			}
	}

	public function checkPassword($password) {
		$password2 = $this->input->post('password');
		if($password == $password2) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function checkEmail($email) {
		if($this->user->checkEmail($email) == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

 	function addUser($password) {
 		$login = $this->input->post('login');
 		$email = $this->input->post('email');

 		$qSign = $this->user->register($login, $password, $email);

 		if($qSign == TRUE) {
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
