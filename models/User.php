<?php


class User
{


	public static function checkmail($mail)
	{
		$mysqli = Bd::GetConnection();
		$resultt = $mysqli->query("SELECT id FROM users WHERE mail = '".$mail."'");
		$row = mysqli_fetch_assoc($resultt);
		if(empty($row['id'])){
			return 'true';
		}
	}
	
	public static function createuser($mail, $newpass, $salt){
		$mysqli = Bd::GetConnection();
		$mysqli->query("INSERT INTO users (mail, password, salt) VALUES ('".$mail."', '".$newpass."', '".$salt."')");
		return $mysqli->insert_id;
	}
	
	public static function checkloginuser($mail, $password){
		$mysqli = Bd::GetConnection();
		$resultt = $mysqli->query("SELECT * FROM users WHERE mail = '".$mail."'");
		$row = mysqli_fetch_assoc($resultt);
		$newpass = md5(md5('myhash:'.$password.':'.$row['salt']));
		if($newpass === $row['password']){
			return $row['id'];
		}
	}
	public static function getNewsList() {

		$db = Db::getConnection();
		$newsList = array();

		$result = $db->query('SELECT id, title, date, author_name, short_content FROM news ORDER BY id ASC LIMIT 10');

		$i = 0;
		while($row = $result->fetch()) {
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['date'] = $row['date'];
			$newsList[$i]['author_name'] = $row['author_name'];
			$newsList[$i]['short_content'] = $row['short_content'];
			$i++;
		}

		return $newsList;
	
}
}