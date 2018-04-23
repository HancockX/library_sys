<?php 
	$db_host = "localhost";
	$db_user = "root";
	$db_password = "DataBase18";
	$db_database = "library";

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>