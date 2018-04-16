<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
 	}

 	public function index() {
 		if($this->session->logged_in) {
 			$this->session->unset_userdata('logged_in');
 			$data['modal'] = array(
 				'title' => "Wylogowano",
 				'text' => "Wylogowałeś się pomyślnie!");
 			$data['title'] = "Strona Główna";
 			$this->load->model('ads');
 			$data['categories'] = $this->ads->getCategories();
 			$data['ads'] = $this->ads->getLastAds();
 			$this->load->view('header', $data);
 			$this->load->view('start');
 			$this->load->view('footer', $data);
 		} else {
 			echo "Nie jesteś zalogowany!";
 		}
 	}


	
}
