<?php
class Dashboard extends Model {
	protected $account_ID;	
	protected $account;
	
	public function __construct() {
		session_start();
		if(!isset($_SESSION['user_access_id'])){
			header('location: '.DOMAIN.'login');
			exit();
		}else{
			$data = $this->result("SELECT * FROM `accounts` WHERE `email`='".$_SESSION['user_access_id']."'");
			$this->account_ID = $_SESSION['user_access_id'];
			if(!empty($data)){
				$this->account = $data;
			}else{
				unset($_SESSION['user_access_id']);
				header('location: '.DOMAIN.'login');
			}
			
		}
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
		$num_house = $this->result("SELECT COUNT(`id`) FROM `housing`");
		$accounts = $this->read("SELECT * FROM `accounts`");
		
		$this->render('dashboard/include/header', []);
		$this->render('dashboard/include/navbar', ['nav' => 'home', 'nav_title' => 'Dashboard', 'username' => $this->account['name'], 'typo' => $this->account['role']]);
		$this->render('dashboard/index', ['num_house' => $num_house['COUNT(`id`)'], 'accounts' => $accounts]);
		$this->render('dashboard/include/footer', []);
	}
	
	public function Imageuploads() {
		if(!empty($_FILES['files']) || !empty($_POST['imname'])){
			$sourcePath = $_FILES['files']['tmp_name'];
			$targetPath = DATA."temp/".$_POST['imname'].".jpg";
			if(move_uploaded_file($sourcePath,$targetPath)){
				echo 'success';
			}else{
				echo 'failed';
			}
		}else{
			echo 'error';
		}
	}
	
	public function Saveuploads() {
		if(!empty($_POST['imname']) || !empty($_POST['fdname'])){
			$sourcePath = DATA."temp/".$_POST['imname'].".jpg";
			$targetPath = DATA."uploads/".$_POST['imname'].".jpg";
			if(copy($sourcePath, $targetPath)){
				unlink($sourcePath);
				$keyname = str_replace("_"," ",$_POST['fdname']);
				$image_url = DOMAIN."data/uploads/".$_POST['imname'].".jpg";
				$query = $this->write("UPDATE `homepage` SET `value`='".$image_url."' WHERE `feature_name`='".$keyname."'");
				if($query){
					echo 'success';
				}else{
					echo 'failed';
				}
				
		    } else {
				echo 'failed';
		    }
		}else{
			echo 'error';
		}
	}
	
	public function SaveAbtuploads() {
		if(!empty($_POST['imname']) || !empty($_POST['fdname'])){
			$sourcePath = DATA."temp/".$_POST['imname'].".jpg";
			$targetPath = DATA."uploads/".$_POST['imname'].".jpg";
			if(copy($sourcePath, $targetPath)){
				unlink($sourcePath);
				$keyname = str_replace("_"," ",$_POST['fdname']);
				$image_url = DOMAIN."data/uploads/".$_POST['imname'].".jpg";
				$query = $this->write("UPDATE `aboutpage` SET `value`='".$image_url."' WHERE `feature_name`='".$keyname."'");
				if($query){
					echo 'success';
				}else{
					echo 'failed';
				}
				
		    } else {
				echo 'failed';
		    }
		}else{
			echo 'error';
		}
	}
	
	public function Saveslideupload() {
		if(!empty($_POST['imname']) || !empty($_POST['fdname'])){
			$sourcePath = DATA."temp/".$_POST['imname'].".jpg";
			$targetPath = DATA."uploads/".$_POST['imname'].".jpg";
			if(copy($sourcePath, $targetPath)){
				unlink($sourcePath);
				echo 'success';				
		    } else {
				echo 'failed';
		    }
		}else{
			echo 'error';
		}
	}
	
	public function testpage() {
		if(empty($_GET['content']) || empty($_GET['img'])){
			echo 'Value not Given';
		}else{
			$content = $_GET['content'];
			$img = $_GET['img'];
			
			if($content == 'home'){
				$content_page = $this->read("SELECT * FROM `homepage`");
				$site_page = 'test_homepage';
			}
			if($content == 'about'){
				$content_page = $this->read("SELECT * FROM `aboutpage`");
				$site_page = 'test_aboutpage';
			}
			
			$this->render('public/header', []);
			$this->render('dashboard/test/'.$site_page, ['info' => $content_page, 'img_val' => $img]);
			$this->render('public/footer', []);
		}
		
		
	}
	
	public function homepage() {
		$alert = 'none';
		if(isset($_POST['Hero_Header'])){
			$bool = true;
			foreach($_POST as $key=>$value){			
				$keyname = str_replace("_"," ",$key);
				$query = $this->write("UPDATE `homepage` SET `value`='".$value."' WHERE `feature_name`='".$keyname."'");
				if($query == false){$bool = false;}
			}
			if($bool){
				$alert = 'Success';
			}else{
				$alert = 'Failed';
			}
		}
		
		
		$homepage = $this->read("SELECT * FROM `homepage`");
		
		$this->render('dashboard/include/header', []);
		$this->render('dashboard/include/navbar', ['nav' => 'homepage', 'nav_title' => 'Edit Home Page', 'username' => $this->account['name'], 'typo' => $this->account['role']]);
		$this->render('dashboard/homepage', ['info' => $homepage, 'alert' => $alert]);
		$this->render('dashboard/include/footer', []);
	}
	
	public function aboutpage() {
		$alert = 'none';
		if(isset($_POST['Header'])){
			$bool = true;
			foreach($_POST as $key=>$value){
				$keyname = str_replace("_"," ",$key);
				$query = $this->write("UPDATE `aboutpage` SET `value`='".$value."' WHERE `feature_name`='".$keyname."'");
				if($query == false){$bool = false;}
			}
			if($bool){
				$alert = 'Success';
			}else{
				$alert = 'Failed';
			}
		}
		
		$abtpage = $this->read("SELECT * FROM `aboutpage`");
		
		$this->render('dashboard/include/header', []);
		$this->render('dashboard/include/navbar', ['nav' => 'aboutpage', 'nav_title' => 'Edit About Page', 'username' => $this->account['name'], 'typo' => $this->account['role']]);
		$this->render('dashboard/aboutpage', ['info' => $abtpage, 'alert' => $alert]);
		$this->render('dashboard/include/footer', []);
		
		
	}
	
	public function company() {
		$alert = 'none';
		if(isset($_POST['Telephone'])){
			$bool = true;
			foreach($_POST as $key=>$value){			
				$keyname = str_replace("_"," ",$key);
				$query = $this->write("UPDATE `company` SET `value`='".$value."' WHERE `feature_name`='".$keyname."'");
				if($query == false){$bool = false;}
			}
			if($bool){
				$alert = 'Success';
			}else{
				$alert = 'Failed';
			}
		}
		
		
		$companypage = $this->read("SELECT * FROM `company`");
		$staff = $this->read("SELECT * FROM `staff`");
		
		$this->render('dashboard/include/header', []);
		$this->render('dashboard/include/navbar', ['nav' => 'company', 'nav_title' => 'Company Profile', 'username' => $this->account['name'], 'typo' => $this->account['role']]);
		$this->render('dashboard/company', ['info' => $companypage, 'alert' => $alert, 'staff' => $staff]);
		$this->render('dashboard/include/footer', []);
	}
	
	public function housing() {
		$alert = 'none';
		$house = $this->read("SELECT * FROM `housing`");
		
		$this->render('dashboard/include/header', []);
		$this->render('dashboard/include/navbar', ['nav' => 'housing', 'nav_title' => 'House Listing', 'username' => $this->account['name'], 'typo' => $this->account['role']]);
		$this->render('dashboard/housing', [ 'alert' => $alert, 'house' => $house]);
		$this->render('dashboard/include/footer', []);
	}
	
	public function newstaff() {
		$alert = 'none';
		$bool = false;
		$boba = false;
		if(isset($_POST['Fullname']) && isset($_POST['Description']) && isset($_POST['Position'])){
			
			if(isset($_FILES['staffimg'])){
				$sourcePath = $_FILES['staffimg']['tmp_name'];
				$targetPath = DATA."uploads/".$_POST['Fullname'].".jpg";
				if(move_uploaded_file($sourcePath,$targetPath)){
					$boba = true;
				}
			}
			if($boba){
				$sql_edit = ",`image`='".DOMAIN."data/uploads/".$_POST['Fullname'].".jpg'";
				$sql_add = ",'".DOMAIN."data/uploads/".$_POST['Fullname'].".jpg'";
			}else{
				$sql_edit = "";
				$sql_add = "";
			}
			
			if(isset($_POST['staff_id'])){
				$query = $this->write("UPDATE `staff` SET `fullname`='".$_POST['Fullname']."',`position`='".$_POST['Position']."',`about`='".$_POST['Description']."' ".$sql_edit." WHERE `id`='".$_POST['staff_id']."'");
			}else{
				$query = $this->write("INSERT INTO `staff`(`fullname`, `position`, `about`, `image`) VALUES ('".$_POST['Fullname']."','".$_POST['Position']."','".$_POST['Description']."'".$sql_add.")");
			}				
			if($query){
				$bool = true;
			}else{
				$bool = false;				
			}
			
		}else{
			$staff = '';
			if(isset($_GET['id'])){
				$staff = $this->result("SELECT * FROM `staff` WHERE `id`='".$_GET['id']."'");
			}
			$this->render('dashboard/include/header', []);
			$this->render('dashboard/include/navbar', ['nav' => 'company', 'nav_title' => 'New Staff', 'username' => $this->account['name'], 'typo' => $this->account['role']]);
			$this->render('dashboard/staff', ['alert' => $alert, 'staff' => $staff]);
			$this->render('dashboard/include/footer', []);
		}
		
		if($bool){
			header('location: '.DOMAIN.'admin/company');
			exit();
		}
	}
		
	public function remvstaff() {
		if(isset($_GET['id'])){
			$staff = $this->write("DELETE FROM `staff` WHERE `id`='".$_GET['id']."'");
		}
		header('location: '.DOMAIN.'admin/company');
		exit();
	}
	
	public function newhouse() {
		$alert = 'none';
		$bool = false;		
		$boba = false;		
		$boba2 = false;		
		$boba3 = false;
		$boba4 = false;
		if(isset($_POST['name']) && isset($_POST['summary']) && isset($_POST['price'])){
			if(isset($_FILES['houseimg'])){
				$sourcePath = $_FILES['houseimg']['tmp_name'];
				$targetPath = DATA."uploads/".$_POST['name'].".jpg";
				if(move_uploaded_file($sourcePath,$targetPath)){
					$boba = true;
				}
			}
			
			if($boba){
				$sql_edit = ",`image`='".DOMAIN."data/uploads/".$_POST['name'].".jpg'";
				$sql_add = ",'".DOMAIN."data/uploads/".$_POST['name'].".jpg'";
			}else{
				$sql_edit = "";
				$sql_add = ",'none'";
			}
			/////////
			if(isset($_FILES['imgu1'])){
				$sourcePath = $_FILES['imgu1']['tmp_name'];
				$name1Path = $this->generateRandomString().".jpg";
				$targetPath = DATA."uploads/".$name1Path;
				if(move_uploaded_file($sourcePath,$targetPath)){
					$boba2 = true;
				}
			}
			
			if($boba2){
				$sql_edit .= ",`feature img 1`='".DOMAIN."data/uploads/".$name1Path."'";
				$sql_add .= ",'".DOMAIN."data/uploads/".$name1Path."'";
			}else{
				$sql_add .= ",'none'";
			}
			/////////
			if(isset($_FILES['imgu2'])){
				$sourcePath = $_FILES['imgu2']['tmp_name'];
				$name2Path = $this->generateRandomString().".jpg";
				$targetPath = DATA."uploads/".$name2Path;
				if(move_uploaded_file($sourcePath,$targetPath)){
					$boba3 = true;
				}
			}
			
			if($boba3){
				$sql_edit .= ",`feature img 2`='".DOMAIN."data/uploads/".$name2Path."'";
				$sql_add .= ",'".DOMAIN."data/uploads/".$name2Path."'";
			}else{				
				$sql_add .= ",'none'";
			}
			
			//////////////////
			$slidImgDATA = '';
			for ($x = 1; $x <= 4; $x++) {
				$nameImg = 'sdlimg'.$x;
				if(isset($_FILES[$nameImg])){
					$nameXPath = $this->generateRandomString().".jpg";
					$targetPath = DATA."uploads/".$nameXPath;
					if(move_uploaded_file($_FILES[$nameImg]['tmp_name'],$targetPath)){
						$slidImgDATA .= DOMAIN.'data/uploads/'.$nameXPath.',';
					}
				}
			}
			if(empty($slidImgDATA)){
				$sql_add .= ",'".$slidImgDATA."'";
			}else{
				$sql_edit .= ",`slidepreview`='".$slidImgDATA."'";
				$sql_add .= ",'".$slidImgDATA."'";
			}
			//////////////////
			
			if(isset($_POST['house_id'])){
				$sql = "UPDATE `housing` SET `name`='".$_POST['name']."',`road`='".$_POST['road']."',`summary`='".$_POST['summary']."',`size`='".$_POST['size']."',`beds`='".$_POST['beds']."',`baths`='".$_POST['baths']."',`garage`='".$_POST['garage']."',`price`='".$_POST['price']."',`feature title 1`='".$_POST['title1']."',`feature info 1`='".$_POST['info1']."',`feature title 2`='".$_POST['title2']."',`feature info 2`='".$_POST['info2']."'".$sql_edit." WHERE `id`='".$_POST['house_id']."'";
				echo $sql;
				$query = $this->write($sql);
			}else{
				$query = $this->write("INSERT INTO `housing`(`name`, `road`, `summary`, `price`, `size`, `beds`, `baths`, `garage`, `feature title 1`, `feature info 1`,  `feature title 2`, `feature info 2`, `image`,`feature img 1`,`feature img 2`,`slidepreview`) VALUES ('".$_POST['name']."','".$_POST['road']."','".$_POST['summary']."','".$_POST['price']."','".$_POST['size']."','".$_POST['beds']."','".$_POST['baths']."','".$_POST['garage']."','".$_POST['title1']."','".$_POST['info1']."','".$_POST['title2']."','".$_POST['info2']."'".$sql_add.")");
			}
			
			if($query){
				$bool = true;
			}else{
				$bool = false;				
			}
		}else{
			$house = '';
			if(isset($_GET['id'])){
				$house = $this->result("SELECT * FROM `housing` WHERE `id`='".$_GET['id']."'");
			}
			$this->render('dashboard/include/header', []);
			$this->render('dashboard/include/navbar', ['nav' => 'housing', 'nav_title' => 'New House', 'username' => $this->account['name'], 'typo' => $this->account['role']]);
			$this->render('dashboard/house', ['alert' => $alert, 'house' => $house]);
			$this->render('dashboard/include/footer', []);
		}
		
		if($bool){
			header('location: '.DOMAIN.'admin/housing');
			exit();
		}
	}
		
	public function remvhouse() {
		if(isset($_GET['id'])){
			$staff = $this->write("DELETE FROM `housing` WHERE `id`='".$_GET['id']."'");
		}
		header('location: '.DOMAIN.'admin/housing');
		exit();
	}
		
	public function newAccount() {
		$bool = false;
		if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pwd']) && isset($_POST['role'])){
			$date = date("Y/m/d");
			$hashedpass = hash("sha256", $_POST['pwd']);
			$query = $this->write("INSERT INTO `accounts`(`name`, `email`, `password`, `role`, `pwd_reset`, `created_date`) VALUES ('".$_POST['name']."','".$_POST['email']."','".$hashedpass."','".$_POST['role']."','none','".$date."')");
			if($query){
				$bool = true;
			}else{
				$bool = false;				
			}
		}else{
			$this->render('dashboard/include/header', []);
			$this->render('dashboard/include/navbar', ['nav' => 'dashboard', 'nav_title' => 'New Account', 'username' => $this->account['name'], 'typo' => $this->account['role']]);
			$this->render('dashboard/account', []);
			$this->render('dashboard/include/footer', []);
		}
		
		if($bool){
			header('location: '.DOMAIN.'admin/home');
			exit();
		}
	}
	
	public function ChangePwdAccount(){
		$bool = false;
		if(isset($_POST['pwd']) && isset($_POST['user_id'])){
			$hashedpass = hash("sha256", $_POST['pwd']);
			$query = $this->write("UPDATE `accounts` SET `password`='".$hashedpass."' WHERE `id`='".$_POST['user_id']."'");
			if($query){
				$bool = true;
			}else{
				$bool = false;				
			}
		}else{
			$this->render('dashboard/include/header', []);
			$this->render('dashboard/include/navbar', ['nav' => 'dashboard', 'nav_title' => 'Change Account Password', 'username' => $this->account['name'], 'typo' => $this->account['role']]);
			$this->render('dashboard/changepwd', []);
			$this->render('dashboard/include/footer', []);
		}
		if($bool){
			header('location: '.DOMAIN.'admin/home');
			exit();
		}
	}
	
	public function RemoveAccount() {
		if(isset($_GET['id'])){
			$staff = $this->write("DELETE FROM `accounts` WHERE `id`='".$_GET['id']."'");
		}
		header('location: '.DOMAIN.'admin/home');
		exit();
	}
	
	function generateRandomString($length = 20) {
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);		
	}
}
?>