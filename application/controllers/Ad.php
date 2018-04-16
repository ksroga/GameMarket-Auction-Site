<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ad extends CI_Controller {

	public function __construct()
 	{
   		parent::__construct();
   		$this->load->model('ads');
   		$this->load->model('user');
   		$this->load->helper('security');
 	}

	public function index()
	{
		$this->add();
	}

	public function add() 
	{
		if($this->session->logged_in) {
			$data = array(
				'title' => "Nowe ogłoszenie",
				'user' => $this->session->logged_in,
				'categories' => $this->ads->getCategories(),
				'types' => $this->ads->getTypes(),
				'profile' => $this->user->getProfile($this->session->logged_in['id'])
				);

			if(!$_POST) {
				$this->load->view('header', $data);
				$this->load->view('ads/add', $data);
				$this->load->view('footer');
			} else {
				$this->newAd($data);
			}

		} else {
			$data = array(
				'title' => "Błąd",
				'error' => "Aby dodać ogłoszenie musisz być zalogowany!<br><a href='../login'>Zaloguj się</a>");
			$this->load->view('header', $data);
			$this->load->view('error', $data);
			$this->load->view('footer');
		}

	}

	public function view($id = NULL) {
		if(!isset($id))
			$id = $this->uri->segment(3);

		$data['ad'] = $this->ads->getAd($id);

		if(isset($id) && $data['ad']) {

			$data = array(
				'title' => $data['ad']->title,
				'author' => $this->user->getProfile($data['ad']->author),
				'authorStatus' => $this->user->isUserOnline($data['ad']->author),
				'authorAds' => $this->ads->getAdsByUserId($data['ad']->author, 3),
				'images' => $this->ads->getImages($id),
				'ad' => $this->ads->getAd($id),
				'created' => $this->ads->unixToReadableHour($data['ad']->date)
				);

			if(count($data['authorAds']) < 3) {
				$data['authorAds'] += $this->ads->getLastAds(5);
			}

			if($this->session->logged_in)
					$data['user'] = $this->session->logged_in;
			
			$this->load->view('header', $data);
			$this->load->view('ads/view', $data);
			$this->load->view('footer');

		} else {
			die("Wystąpił błąd!");
		}
	}

	public function search() {
		$get = $this->input->get(NULL, TRUE);
		var_dump($get);
	}

	private function newAd($data) {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean|max_length[70]', array(
			'required' => $this->set_error('Tytuł jest wymagany!')));
		$this->form_validation->set_rules('platform', 'Platform', 'trim|required|xss_clean', array(
			'required' => $this->set_error('Wybierz platformę!')));
		$this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean', array(
			'required' => $this->set_error('Zdefiniuj typ przedmiotu!')));
		$this->form_validation->set_rules('desc', 'Desc', 'trim|required|xss_clean|max_length[2000]', array(
			'required' => $this->set_error('Opis nie może być pusty!')));
		$this->form_validation->set_rules('firstname', 'Firstname', 'trim|xss_clean|max_length[32]');
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|max_length[64]');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|xss_clean|max_length[12]');
		$this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean|numeric|less_than[10000]|greater_than[0]', array(
			'required' => $this->set_error('Musisz podać cenę!'),
			'greater_than' => $this->set_error('Cena nie może być mniejsza niż zero!'),
			'less_than' => $this->set_error('Maksymalna cena to 10000!')));

		if($this->form_validation->run() == FALSE) {
			$this->load->view('header', $data);
			$this->load->view('ads/add', $data);
			$this->load->view('footer');
		} else {
			$data['adv'] = $this->ads->newAdv($this->input->post(), $this->uploadImages());
			if($data['adv']) {
				$data['post'] = $this->input->post();
				$this->load->view('header', $data);
				$this->load->view('ads/add_success', $data);
				$this->load->view('footer');
			} else {
				die("Wystąpił błąd krytyczny! Spróbuj ponownie później.");
			}
		
		}
	}

	private function uploadImages() {

		if($_FILES['images']['size'][0] > 0 && !empty($_FILES['images']['name'])) {
			$category_id = $this->ads->getLastAdID() + 1;
			$config['upload_path'] = "./assets/uploads/offers/".$category_id."/";
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size'] = 5120;
		    $config['encrypt_name'] = TRUE;

		    if(!is_dir($config['upload_path'])) {
		       	mkdir($config['upload_path'], 0777, true);
		    }

	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);

	        if ( ! $this->upload->do_multi_upload('images'))
	        {
	            
	        }
	        else
	        {
	            return $this->upload->get_multi_upload_data();
	        }	
		} else {
			return false;
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
