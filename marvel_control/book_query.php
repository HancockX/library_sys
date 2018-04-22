<?php
	function update_session(){
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			foreach ($_POST as $key => $value) {
				if (!empty($value)) {
					$value = test_input($value);
					$_SESSION[$key] = $value;
					$GLOBALS[$key] = $value;
				}
			}
			// var_dump($_SESSION);
			// die("CHECK!");
			// if (!empty($_POST["category"])){
			// 	$_SESSION["category"] = $_POST["category"]
			// }
		}
	}
?>