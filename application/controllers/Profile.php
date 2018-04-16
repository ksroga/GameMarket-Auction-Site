<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
   		$this->load->model(array('user', 'ads'));
 	}

	public function index()
	{
		$data = array(
				'title' => "Błąd",
				'error' => "404 - taka strona nie istnieje!"
				);
			$this->load->view('header', $data);
			$this->load->view('error', $data);
			$this->load->view('footer');
	}

	public function view($profileID = NULL) {
		if(!isset($profileID))
			$profileID = $this->uri->segment(3);

		$data = array(
			'title' => 'Profil użytkownika',
			'profile' => $this->user->getProfile($profileID)
			);

		if($data['profile'] != FALSE) {
			$this->load->view('header', $data);
			$this->load->view('profiles/view', $data);
			$this->load->view('footer');
		} else {
			$data = array(
				'title' => "Błąd",
				'error' => "Taki profil nie istnieje!"
				);
			$this->load->view('header', $data);
			$this->load->view('error', $data);
			$this->load->view('footer');
		}

	}

	



}
