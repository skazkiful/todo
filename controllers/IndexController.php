<?
include_once ROOT. '/models/Index.php';

class IndexController {
	public function checklogin(){
		if(empty($_SESSION['id'])){
			header("Location: http://".$_SERVER['HTTP_HOST']."/login");
		}
	}
	public function actionIndex($a = 0){
		$this->checklogin();
		$site = $_SERVER['HTTP_HOST'];
		$retproject = Index::projects($a);
		require_once(ROOT . '/views/index/index.php');
		return true;
	}
	public function actionProject($a){
		$this->checklogin();
		$site = $_SERVER['HTTP_HOST'];
		$today = Index::today();
		$hightpriorite = Index::hightpriorite($a);
		$projects = Index::projectslist($a);
		$projectinfo = Index::projectinfo($a);
		$lowpriorite = Index::lowpriorite($a);
		$retproject = Index::projects($a);
		if(empty($today)){
			$today = 0;
		}
		require_once(ROOT . '/views/index/project.php');
		return true;
	}
	public function actionAddproject(){
		$this->checklogin();
		$site = $_SERVER['HTTP_HOST'];
		$name = $_POST['name'];
		$color = str_replace("#", '', $_POST['color']);
		$projectid = Index::addproject($name, $color);
		header("Location: http://".$_SERVER['HTTP_HOST']."/project/".$projectid);
		return true;
	}
	public function actionDone(){
		$this->checklogin();
		$id = $_POST['id'];
		$projectid = Index::done($id);
		return true;
	}
	public function actionDeletetask(){
		$this->checklogin();
		$id = $_POST['id'];
		$projectid = Index::deletetask($id);
		return true;
	}
	public function actionEdittask(){
		$this->checklogin();
		$id = $_POST['id'];
		$name = $_POST['name'];
		$projectid = Index::edittask($id, $name);
		return true;
	}
	public function actionEditproject(){
		$this->checklogin();
		$id = $_POST['id'];
		$name = $_POST['name'];
		$projectid = Index::editproject($id, $name);
		return true;
	}
	public function actionDeleteproject(){
		$this->checklogin();
		$id = $_POST['id'];
		$projectid = Index::deleteproject($id);
		return true;
	}
	public function actionAddtask(){
		$this->checklogin();
		$site = $_SERVER['HTTP_HOST'];
		$task = $_POST['task'];
		$chosenproject = $_POST['chosenproject'];
		$chosenprior = $_POST['chosenprior'];
		$date = $_POST['date'];
		if(empty($date)){
			$date = time();
		}else{
			$calendar = explode('.', $date);
			$y = $calendar[2];
			$m = $calendar[1];
			$d = $calendar[0];
			$date = mktime(1,1,1,$m,$d,$y);
		}
		$projectid = Index::addtask($task, $chosenproject, $chosenprior, $date);
		header("Location: http://".$_SERVER['HTTP_HOST']."/project/".$projectid);
		return true;
	}
	
}