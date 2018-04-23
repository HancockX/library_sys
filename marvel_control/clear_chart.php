<?php
	session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		foreach ($_POST as $key => $value) {
			if (!empty($value)) {
				unset($_SESSION[$key]);
			}
		}
	}
	$ErrMessage = '清空成功';
	// die();
	// echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href ='book_query.html'</script>";
	echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href ='{$_SERVER['HTTP_REFERER']}'</script>";
?>