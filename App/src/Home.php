<?php
class Home extends Model {
	
	public function __construct() {
		
	}
	
	protected function render($view_file,$view_data){
		$this->view_file = $view_file;
		$this->view_data = $view_data;
		if(file_exists(APP . 'view/' . $view_file . '.phtml'))
		{
		  include APP . 'view/' . $view_file . '.phtml';
		}
	}
	
	public function index() {
		$homepage = $this->read("SELECT * FROM `homepage`");
		$social = $this->read("SELECT * FROM `company` WHERE `feature_type`='social'");
		
		$this->render('public/header', []);
		$this->render('index', ['info' => $homepage, 'social' => $social]);
		$this->render('public/footer', ['social' => $social]);
	}
	
	public function about() {
		$aboutpage = $this->read("SELECT * FROM `aboutpage`");
		$staff = $this->read("SELECT * FROM `staff`");
		$social = $this->read("SELECT * FROM `company` WHERE `feature_type`='social'");
		
		$this->render('public/header', []);
		$this->render('about', ['info' => $aboutpage, 'staff' => $staff, 'social' => $social]);
		$this->render('public/footer', ['social' => $social]);
	}
	
	public function housing() {
		$homeimg = $this->result("SELECT `value` FROM `aboutpage` WHERE `feature_name`='AboutH Image'");
		$house = $this->read("SELECT * FROM `housing`");
		$aboutpage = $this->read("SELECT * FROM `aboutpage`");
		$social = $this->read("SELECT * FROM `company` WHERE `feature_type`='social'");
		
		$this->render('public/header', []);
		$this->render('housing', ['info' => $aboutpage, 'house' => $house, 'image' => $homeimg['value'], 'social' => $social]);
		$this->render('public/footer', ['social' => $social]);
	}
	
	public function property() {
		if(isset($_GET['id'])){
			$house = $this->result("SELECT * FROM `housing` WHERE `id`='".$_GET['id']."'");
			$social = $this->read("SELECT * FROM `company` WHERE `feature_type`='social'");
			
			$this->render('public/header', []);
			$this->render('property', ['house' => $house, 'social' => $social]);
			$this->render('public/footer', ['social' => $social]);
		}else{
			header('location: housing');
		}		
	}
	
	public function contact() {
		$homeimg = $this->result("SELECT `value` FROM `homepage` WHERE `feature_name`='Hero Image'");
		$contact = $this->read("SELECT * FROM `company`");
		$social = $this->read("SELECT * FROM `company` WHERE `feature_type`='social'");
		
		$this->render('public/header', []);
		$this->render('contact', ['info' => $contact, 'social' => $social, 'image' => $homeimg['value']]);
		$this->render('public/footer', ['social' => $social]);
	}
}
?>