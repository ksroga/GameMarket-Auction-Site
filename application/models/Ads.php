<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends CI_Model {

	public function getCategories() {
		$this->db->select('*');
		$this->db->from('gm_categories');
		$this->db->where('active', 1);

		$query = $this->db->get();

		foreach ($query->result() as $row)
		{
			$categories[$row->id] = array(
				'id' => $row->id,
				'category' => $row->category,
				'icon' => $row->icon
				);        	
		}
		
		return $categories;
	}

	public function getTypes() {
		$this->db->select('*');
		$this->db->from('gm_types');
		$this->db->where('active', 1);

		$query = $this->db->get();

		foreach ($query->result() as $row)
		{
			$types[$row->id] = array(
				'id' => $row->id,
				'type' => $row->type
				);        	
		}
		
		return $types;
	}

	public function getLastCategoryID() {
		$this->db->select('id');
		$this->db->from('gm_categories');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get();

		$row = $query->row();

		if(isset($row))
			return $row->id;
	}

	public function getLastAdID() {
		$this->db->select('id');
		$this->db->from('gm_ads');
		$this->db->order_by('id', 'DESC');
		$this->db->limit(1);

		$query = $this->db->get();

		$row = $query->row();

		if(isset($row))
			return $row->id;
	}

	public function newAdv($post, $images) {
		$data = array(
			'title' => $post['title'],
			'type' => $post['type'],
			'description' => nl2br($post['desc']),
			'author' => $this->session->logged_in['id'],
			'date' => time()+timeDefference(),
			'price' => $post['price'],
			);

		if(is_numeric($post['platform']) && $post['platform'] > 0 && $post['platform'] <= $this->getLastCategoryID())
			$data['platform'] = $post['platform'];

		if(is_int($post['type']) && $post['type'] > 0 && $post['type'] <= 4)
			$data['type'] = $post['type'];

		if(!empty($post['phone']) && is_int($post['phone']))
			$data['phone'] = $post['phone'];

		if(!empty($post['firstname'])) {
			//do skonczenia
		}

		if(isset($post['negotiation']))
			$data['negotiation'] = 1;

		if(isset($post['exchange']))
			$data['exchange'] = 1;

		if(isset($post['selectedImg']) && !empty($post['selectedImg'])) {
			foreach($images as $image) {
				if($image['orig_name'] == $post['selectedImg'])
					$data['image'] = $image['file_name'];
			}

			if(!isset($data['image']))
				$data['image'] = $images[0]['file_name'];
		}

		$this->db->insert('gm_ads', $data);
		return $this->getLastAdID();
	}

	public function getLastAds($limit = 5) {
		$this->db->select('*');
		$this->db->from('gm_ads');
		$this->db->order_by('last_raise', 'DESC');
		$this->db->limit($limit);

		$query = $this->db->get();

		foreach($query->result() as $ad) {
			$ad->platform = $this->getPlatformById($ad->platform);
			$ad->type = $this->getTypeById($ad->type);
			$ad->created = $this->unixToReadableHour($ad->date);
			if(is_null($ad->image)) {
				$ad->image = asset_url()."img/nofoto.png";
			} else {
				$ad->image = asset_url()."uploads/offers/".$ad->id."/".$ad->image;
			}
		}

		return $query->result();
	}

	public function getAdsByUserId($userID, $limit = NULL) {
		$this->db->select('*');
		$this->db->from('gm_ads');
		$this->db->where('author', $userID);
		$this->db->order_by('last_raise', 'DESC');
		if(isset($limit))
			$this->db->limit($limit);

		$query = $this->db->get();

		foreach($query->result() as $ad) {
			$ad->platform = $this->getPlatformById($ad->platform);
			$ad->type = $this->getTypeById($ad->type);
			$ad->created = $this->unixToReadableHour($ad->date);
			if(is_null($ad->image)) {
				$ad->image = asset_url()."img/nofoto.png";
			} else {
				$ad->image = asset_url()."uploads/offers/".$ad->id."/".$ad->image;
			}
		}
			return $query->result();
	}

	public function getPlatformById($id) {
		$this->db->select('category');
		$this->db->from('gm_categories');
		$this->db->where('id', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		$row = $query->row();

		if(isset($row))
			return $row->category;
	}

	public function getPlatformIconById($id) {
		$this->db->select('icon');
		$this->db->from('gm_categories');
		$this->db->where('id', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		$row = $query->row();


		if(isset($row))
			return $row->icon;
	}

	public function getTypeById($id) {
		$this->db->select('type');
		$this->db->from('gm_types');
		$this->db->where('id', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		$row = $query->row();

		if(isset($row))
			return $row->type;
	}

	public function getTypeIconById($id) {
		$this->db->select('icon');
		$this->db->from('gm_types');
		$this->db->where('id', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		$row = $query->row();


		if(isset($row))
			return $row->icon;
	}

	public function getAd($id) {
		$this->db->select('*');
		$this->db->from('gm_ads');
		$this->db->where('id', $id);
		$this->db->limit(1);

		$query = $this->db->get();

		foreach($query->result() as $ad) {
			$ad->platformIcon = $this->getPlatformIconById($ad->platform);
			$ad->platform = $this->getPlatformById($ad->platform);
			$ad->typeIcon = $this->getTypeIconById($ad->type);
			$ad->type = $this->getTypeById($ad->type);
			$ad->description = nl2br($ad->description);
		}

		return $query->row();
	}

	public function getImages($id) {
		$this->load->helper('directory');
		return directory_map('assets/uploads/offers/'.$id);
	}

	public function unixToReadableHour($unix) {
		date_default_timezone_set('Europe/Warsaw');
		$today =  (date('G') * 3600 + date('i') * 60 + date('s'));

		if(time() + timeDefference() - $unix <= $today) {
			return "dzisiaj o ".gmdate("H:i", $unix);
		} else if(time() + timeDefference() - $unix > $today && time() + timeDefference() - $unix <= 86400 + $today) {
			return "wczoraj o ".gmdate("H:i", $unix);
		} else if(time() + timeDefference()- $unix > 86400 + $today && time() + timeDefference() - $unix <= 172800 + $today){
			return "przedwczoraj o ".gmdate("H:i", $unix);
		} else {
			$day = $this->unixToReadableDate('day', $unix+timeDefference());
			$month = $this->unixToReadableDate('month', $unix+timeDefference());
			$year = $this->unixToReadableDate('year', $unix+timeDefference());
			return $day.' '.$month.' '.$year;
		}
	}

	public function unixToReadableDate($type = "day", $unix) {
		switch($type) {
			case "weekday":
				$weekday = date('N', $unix);
				$days = array("Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela");
				return $days[$weekday];
			break;

			case "month":
				$month = date('m', $unix);
				$months = array("Stycznia", "Lutego", "Marca", "Kwietnia", "Maja", "Czerwca", "Lipca", "Sierpnia", "Września", "Października", "Listopada", "Grudnia");
				return $months[$month];
			break;

			case "day":
				return date('d', $unix);
			break;

			case "year":
				return date('Y', $unix);
			break;
		}
	}

}