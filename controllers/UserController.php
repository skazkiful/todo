<?
include_once ROOT. '/models/User.php';

class UserController {
	public function checklogin(){
		if(!empty($_SESSION['id'])){
			header("Location: http://".$_SERVER['HTTP_HOST']."/");
		}
	}
	public function salt($num){
		$chars = '1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
		$x = 0;
		$return = '';
		while($x<$num){
			$return .= $chars[rand(0,(strlen($chars))-1)];
			$x++;
		}
		return $return;
	}
	public function actionLogin(){
		$this->checklogin();
		$mysqli = Bd::GetConnection();
		if(isset($_POST['submit'])){
			$mail = $mysqli->real_escape_string($_POST['mail']);
			$password = $mysqli->real_escape_string($_POST['password']);
			$id = User::checkloginuser($mail, $password);
			if(!empty($id)){
				$_SESSION['id'] = $id;
				header("Location: http://".$_SERVER['HTTP_HOST']."/");
			}
		}
		require_once(ROOT . '/views/account/login.php');
		return true;
	}
	public function actionReg(){
		$this->checklogin();
		$mysqli = Bd::GetConnection();
		if(isset($_POST['submit'])){
			$mail = $mysqli->real_escape_string($_POST['mail']);
			if(User::checkmail($mail) == 'true'){
				$password1 = $mysqli->real_escape_string($_POST['password1']);
				$password2 = $mysqli->real_escape_string($_POST['password2']);
				if($password1 === $password2){
					$salt = $this->salt(32);
					$newpass = md5(md5('myhash:'.$password1.':'.$salt));
					$_SESSION['id'] = User::createuser($mail, $newpass, $salt);
					header("Location: http://".$_SERVER['HTTP_HOST']."/");
				}
			}
		}
		require_once(ROOT . '/views/account/reg.php');
		return true;
	}
	public function actionLogout(){
		$_SESSION['id'] = '';
		header("Location: http://".$_SERVER['HTTP_HOST']."/login");
		return true;
	}
}