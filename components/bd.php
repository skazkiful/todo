<?php
Class Bd{
	public static function GetConnection(){
		$mysqli = new mysqli('skazki03.mysql.ukraine.com.ua', 'skazki03_test', 'blxm3hdm', 'skazki03_test'); 
		!$mysqli->set_charset("utf8");
		if (mysqli_connect_errno()) { 
			printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error()); 
			exit;
		} 
		return $mysqli;
	}
}