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
		}
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	function echo_result($row){
		$head = '<tr>';
		$rear = '</tr>';
		$ret = $head;
		for ($i=0; $i < 9; $i++) { 
			$ret = $ret. '<td>' .$row[$i]. '</td>';
		}
		$ret .= $rear;
		return $ret;
	}

	function exec_search(){
		$db_host = "localhost";
		$db_user = "root";
		$db_password = "DataBase18";
		$db_database = "library";

		$table = $query = $Err = "";
		$condition = array();
		$query = "select title, bno, category, press, year, author, price, total, stock from book";
	    $order_limit = " order by title desc limit 50; ";
	    $conn = new mysqli($db_host, $db_user, $db_password, $db_database);
	    if($conn -> connect_errno){
	        die('连接错误' . $conn -> connect_error);
	    }

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// var_dump($_POST);
			foreach ($_POST as $key => $value) {
				if (!empty($value)) {
					// echo "$key", "$value", "<br/>";
					$value = test_input($value);
					$_SESSION[$key] = $value;
					$condition[$key] = $value;
					$GLOBALS[$key] = $value;
				}
				else{
				}
			}
			if( count($_POST) == 0 ){
				//没有提交任何条件，则和不提交表单等价
				goto execute;
			}
			else{
				$query = "select title, bno, category, press, year, author, price, total, stock from book where total > -1 ";
				if (!empty($condition['category'])) {
					$extra = " and category like '%{$condition['category']}%' ";
					$query = $query . $extra;
				}
				if (!empty($condition['title'])) {
					$extra = " and title like '%{$condition['title']}%' ";
					$query = $query . $extra;
				}
				if (!empty($condition['press'])) {
					$extra = " and press like '%{$condition['press']}%' ";
					$query = $query . $extra;
				}
				if (!empty($condition['author'])) {
					$extra = " and author like '%{$condition['author']}%' ";
					$query = $query . $extra;
				}
				if (!empty($condition['year_min'])) {
					$extra = " and year > {$condition['year_min']} ";
					$query = $query . $extra;
				}
				if (!empty($condition['year_max'])) {
					$extra = " and year < {$condition['year_max']} ";
					$query = $query . $extra;
				}
				if (!empty($condition['price_min'])) {
					$extra = " and price > {$condition['price_min']} ";
					$query = $query . $extra;
				}
				if (!empty($condition['price_max'])) {
					$extra = " and price < {$condition['price_max']} ";
					$query = $query . $extra;
				}
			}
		}
		else{
			//如果没有提交表单的话，返回值为整个书库
		}
		execute:
		$query .= $order_limit;
		// var_dump($condition);
		// var_dump($query);
		$result = $conn->query($query);
		$table = $line = "";
	    if ($result->num_rows > 0){
	        while ($row = $result -> fetch_array()) {
	        	$line = echo_result($row);
	        	$table.=$line;
	        }
	    }
	    else{
			// var_dump($query);
			$ErrMessage = "未查询到任何结果！将返回整个书库，请重新输入查询条件";
			echo "<script> alert('{$ErrMessage}');location.href ='{$_SERVER['HTTP_REFERER']}'</script>";
	    }
		return $table;
	}
?>