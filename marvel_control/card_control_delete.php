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
			$flag = delete_card($cno , $name , $department , $type);
			if(!$flag)
			{
	            $ErrMessage = '删除失败,请检查表单';
	            echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href = 'card_control.html' </script>";
	        }
	        else
	        {
	            $ErrMessage = '删除成功';
	            clear_card_info();
	            echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href ='card_control.html'</script>";
	        }
	    }	
		else
		{
			$ErrMessage = '删除失败，请确保表单完整';
	        echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href = 'card_control.html' </script>";
		}
	}
	else
	{
		$ErrMessage = '请重新输入！';
        echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href ='/library_sys/marvel_control/empty_page.html'</script>";
	}
	function clear_card_info(){
		unset($_SESSION['cno']);
		unset($_SESSION['name']);
		unset($_SESSION['department']);
		unset($_SESSION['type']);
	}
	function delete_card($cno, $name, $department, $type){
		$db_host = "localhost";
	    $db_user = "root";
	    $db_password = "DataBase18";
	    $db_database = "library";
	    $conn = new mysqli($db_host, $db_user, $db_password, $db_database);
	    if($conn -> connect_errno){
	        die('连接错误' . $conn -> connect_error);
	    }
	    $query = "select * from borrow,card where borrow.cno = card.cno and borrow.cno = '{$cno}' and name='{$name}' and department='{$department}' and type='{$type}';";
	    $result = $conn->query($query);
	    if (empty($result)) {
	    	$ErrMessage = ' Error！';
            echo "<script> alert('{$ErrMessage}');</script>";
            return false;
	    }
	    if ($result->num_rows > 0){
	    	while($row = $result->fetch_assoc()){
	    		// var_dump($row);
	    		// echo "<br/>", "<br/>","<br/>","<br/>","<br/>","<br/>","<br/>","<br/>","<br/>","<br/>","<br/>";
	    		$flag = revert($row['operator'], $cno, $row['bno']);
	    		if (!$flag) {
	    			$ErrMessage = ' 还书时错误！';
			        echo "<script> alert('{$ErrMessage}');</script>";
			        return false;
	    		}
		    }
	    }
	    $query = "delete from card where cno='{$cno}' and name='{$name}' and department='{$department}' and type='{$type}';";
	    $result = $conn->query($query);
	    if ($result) {
	    	// $ErrMessage = ' 删除成功！';
	     //    echo "<script> alert('{$ErrMessage}');</script>";
	        return true;
	    }
	    else{
	    	return false;
	    }
	    return $reult;
	}
	function revert($ano,$number,$bno)
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "DataBase18";
        $db_database = "library";
        $conn = new mysqli($db_host, $db_user, $db_password, $db_database);
        if($conn -> connect_errno)
        {
            die('连接错误' . $conn -> connect_error);
        }
        $query = "select bno
                 from borrow
                 where bno = '{$bno}' and cno='{$number}';";
        $result = $conn->query($query);
        if (empty($result)) {
            $ErrMessage = ' 格式错误，请检查输入！';
            echo "<script type='text/javascript'> alert('{$ErrMessage}');</script>";
            return false;
        }
        if($result->num_rows>0)
        {
            $row = $result->fetch_array();
            $query = "update book set stock=stock+1 where bno='{$row[0]}';";
            $conn->query($query);
            date_default_timezone_set('Asia/Shanghai');
            $current_date=date("Y-m-d");
            $query = "select max(borrow_date)
                      from borrow
                      where bno='{$row[0]}' and cno='{$number}';
                     ";
            $maxrow=$conn->query($query);
            $max_borrow_date = $maxrow->fetch_array();
            $query = "delete from borrow 
                      where bno='{$bno}' and cno='{$number}'
                            and borrow_date='$max_borrow_date[0]';
                     ";
            $result = $conn->query($query);
            if ($result) {
                // $ErrMessage = '还书成功';
                // echo "<script type='text/javascript'> alert('{$ErrMessage}');</script>";
                return true;
            }
            else{
                    $ErrMessage = '还书失败！';
                    echo "<script type='text/javascript'> alert('{$ErrMessage}');</script>";
                    return false;
                }
        }
        else
        {
            $ErrMessage = ' 未借用指定书目';
            echo "<script type='text/javascript'> alert('{$ErrMessage}');</script>";
            return false;
        }
    }
?>