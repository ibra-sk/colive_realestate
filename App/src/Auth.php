<?php
class Auth extends Model {
	
	public function __construct() {
		//$this->render();
	}
	
	protected function render($view_file,$view_data){
		$this->view_file = $view_file;
		$this->view_data = $view_data;
		if(file_exists(APP . 'view/' . $view_file . '.phtml'))
		{
		  include APP . 'view/' . $view_file . '.phtml';
		}
	}
	
	public function login() {
		session_start();
		if(isset($_SESSION['user_access_id'])){
			header('location: admin/home');
			exit();
		}
		
		$alert;
		if(isset($_POST['email']) && isset($_POST['pwd'])){
			$username = $_POST['email'];
			$password = $_POST['pwd'];
			if($username == "" || $password == ""){
				$alert = "Please enter your email and password";
				$this->render('auth/login', ['alert' => $alert]);
				exit();
			}else{
				$hashedpass = hash("sha256", $password);
				$data = $this->result("SELECT * FROM `accounts` WHERE `email`='".$username."' AND `password`='".$hashedpass."'");
				if($data){
					$_SESSION['user_access_id'] = $username;
					header('location: admin/home');
					exit();		
				}else{
					$alert = "Wrong email or password";
					$this->render('auth/login', ['alert' => $alert]);
					exit();
				}
			}
		}else{
			$this->render('auth/login', []);
		}
	}
	
	public function logout() {
		session_start();
		unset($_SESSION['user_access_id']);
		header('location: home');
	}
	
	public function ForgotPassword() {
		if(isset($_POST['submit'])){
			$username = $_POST['email'];
			if($username == ""){
				$alert = "Please enter your email first";
				$this->render('auth/forgot', ['alert' => $alert]);
				exit();
			}else{
				$data = $this->result("SELECT * FROM `accounts` WHERE `email`='".$username."'");
				if($data){
					$forgot_pwd_token = $this->generateRandomString();
					$encoded_ID = base64_encode($data['account_ID']);
					$query = $this->write("UPDATE `accounts` `pwd_reset`='".$forgot_pwd_token."' WHERE `email`='".$username."'");
					if($query){
						$this->render('auth/forgotconfirm', []);
					}else{
						$alert = "Error occurred while resetting your password, Please try again later.";
						$this->render('auth/forgot', ['alert' => $alert]);
					}
				}else{
					$alert = "Given email address in unavialable";
					$this->render('auth/forgot', ['alert' => $alert]);
				}
			}
		}else{
			$this->render('auth/forgot', []);
		}
	}
	
	public function ResetPassword() {
		if(isset($_POST['submit'])){
			$accountID = $_POST['account'];
			$token_key = $_POST['token'];
			$password = $_POST['newpwd'];
			$repassword = $_POST['repwd'];
			if($password == $repassword){
				$data = $this->result("SELECT * FROM `membership` WHERE `activation_code`='".$accountID."' AND `pwd_reset`='".$token_key."'");
				if($data){
					$hashedpass = hash("sha256", $password);
					$query = $this->write("UPDATE `accounts` SET `password`='".$hashedpass."', `pwd_reset`='none' WHERE `activation_code`='".$accountID."'");
					if($query){
						header('location: '.DOMAIN.'login');
						exit();
					}else{
						$alert = "Error occurred while resetting your password, Please try again later.";
						$this->render('auth/resetpwd', ['alert' => $alert, 'token' => $token_key, 'usrid' => $accountID]);
					}
				}else{
					$alert = "The account you are trying to reset is not valid";
					$this->render('auth/resetpwd', ['alert' => $alert, 'token' => $token_key, 'usrid' => $accountID]);
				}
			}else{
				$alert = "Password do not match, Try again.";
				$this->render('auth/resetpwd', ['alert' => $alert, 'token' => $token_key, 'usrid' => $accountID]);
				exit();
			}
		}else{
			if(isset($_GET['q']) && isset($_GET['em'])){
				$usrID = base64_decode($_GET['em']);
				$token = $_GET['q'];
				$this->render('auth/resetpwd', ['token' => $token, 'usrid' => $usrID]);
			}else{
				header('location: error404');
				exit();
			}
		}
		
	}
	
	function generateRandomString($length = 20) {
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);		
	}
	
}
?>