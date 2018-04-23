<?php
	session_start();
	function test_input($data)
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		//网页表单入库
		$Err = "";
		$cno = $name = $department = $type = "";

		if (empty($_POST["cno"])){
	    	$Err = "bno is required";} 
	    else 
	    {
			$cno = test_input($_POST["cno"]);
			$_SESSION['cno'] = $cno;
		}
		if (empty($_POST["name"])){
	    	$Err = "name is required";} 
	    else 
	    {
			$name = test_input($_POST["name"]);
			$_SESSION['name'] = $name;
		}
		if (empty($_POST["department"])){
	    	$Err = "department is required";} 
	    else 
	    {
			$department = test_input($_POST["department"]);
			$_SESSION['department'] = $department;
		}
		if (empty($_POST["type"])){
	    	$Err = "type is required";} 
	    else 
	    {
			$type = test_input($_POST["type"]);
			$_SESSION['type'] = $type;
		}
		
		if ($Err == "")
		{
			$flag = insert_card_entry($cno , $name , $department , $type);
			if(!$flag)
			{
	            $ErrMessage = '录入失败,请检查表单';
	            echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href = 'card_control.html' </script>";
	        }
	        else
	        {
	            $ErrMessage = '录入成功';
	            clear_card_info();
	            echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href ='card_control.html'</script>";
	        }
		}
		else
		{
			$ErrMessage = '录入失败';
	        echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href = 'card_control.html' </script>";
		}
	}
	else
	{
		$ErrMessage = '请重新输入！';
        echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href ='/library_sys/marvel_control/empty_page.html'</script>";
	}
	function insert_card_entry($cno, $name, $department, $type){
		$db_host = "localhost";
	    $db_user = "root";
	    $db_password = "DataBase18";
	    $db_database = "library";
	    $conn = new mysqli($db_host, $db_user, $db_password, $db_database);
	    if($conn -> connect_errno){
	        die('连接错误' . $conn -> connect_error);
	    }
	    $query = "insert into card values('{$cno}', '{$name}', '{$department}', '{$type}');";
	    $result = $conn->query($query);
	    return $result;
	}
	function clear_card_info(){
		unset($_SESSION['cno']);
		unset($_SESSION['name']);
		unset($_SESSION['department']);
		unset($_SESSION['type']);
	}
?>