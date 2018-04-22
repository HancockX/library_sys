<?php
	session_start();
	function insert_book_entry(){
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["number"])) {
		    	$numErr = "number is required";
			} else {
				$number = test_input($_POST["number"]);
			}
		}
	}


	
?>