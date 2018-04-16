<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
   		$this->load->model('ads');
 	}

	public function index()
	{
		$data = array(
			'categories' => $this->ads->getCategories(),
			'ads' => $this->ads->getLastAds()
			);
		foreach($data['ads'] as $ad) {
			$ad->created = $this->ads->unixToReadableHour($ad->date);
		}

		if($this->session->logged_in)
			$data['user'] = $this->session->logged_in;
		$data['title'] = "Strona Główna";
		$this->load->view('header', $data);
		$this->load->view('start', $data);
		$this->load->view('footer');
	}
}
