<?php
	session_start();
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if(empty($_POST['file'])){
			//网页表单入库
			$Err = "";
			$bno = $category = $title = $press = $author = "";
			$price = 0;
			$year = $total = $stock = 0;
			if (empty($_POST["bno"])) {
		    	$Err = "bno is required";
			} else {
				$bno = test_input($_POST["bno"]);
				$_SESSION['bno'] = $bno;
			}
			if (empty($_POST["category"])) {
		    	$Err = "category is required";
			} else {
				$category = test_input($_POST["category"]);
				$_SESSION['category'] = $category;
			}
			if (empty($_POST["title"])) {
		    	$Err = "title is required";
			} else {
				$title = test_input($_POST["title"]);
				$_SESSION['title'] = $title;
			}
			if (empty($_POST["press"])) {
		    	$Err = "press is required";
			} else {
				$press = test_input($_POST["press"]);
				$_SESSION['press'] = $press;
			}
			if (empty($_POST["author"])) {
		    	$Err = "author is required";
			} else {
				$author = test_input($_POST["author"]);
				$_SESSION['author'] = $author;
			}
			if (empty($_POST["price"])) {
		    	$Err = "price is required";
			} else {
				$price = test_input($_POST["price"]);
				$_SESSION['price'] = $price;
			}
			if (empty($_POST["year"])) {
		    	$Err = "year is required";
			} else {
				$year = test_input($_POST["year"]);
				$_SESSION['year'] = $year;
			}
			if (empty($_POST["total"])) {
		    	$Err = "total is required";
			} else {
				$total = test_input($_POST["total"]);
				$_SESSION['total'] = $total;
			}
			if (empty($_POST["stock"])) {
		    	$Err = "stock is required";
			} else {
				$stock = test_input($_POST["stock"]);
				$_SESSION['stock'] = $stock;
			}
			if ($Err == "") {
				$flag = insert_single_book_entry($bno, $category, $title, $press, $year, $author, $price, $total, $stock);
				if(!$flag){
		            $ErrMessage = '入库失败,请检查表单';
		            die('Error Number 1');
		            echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href = 'book_store.html' </script>";
		        }
		        else{
		            $ErrMessage = '入库成功';
		            // var_dump($_SESSION);die();
		            clear_book_info();
		            echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href ='book_store.html'</script>";
		        }
			}
			else{
				//文件入库
				// die('IN YET????');
				$file=$_FILES['file1'];
				$filename=time().rand(0,1000);  
				// $filename="input";
			    //获取文件的后缀,pathinfo()会以数组的形式返回一个文件的路径信息，其中extension元素则是文件的后缀名  
			    $ext=pathinfo($_FILES['file1']['name'])['extension'];
			    //最终文件名为  
			    $filename=$filename.'.'.$ext;
			    //设置文件上传到服务器后存放的位置,move_uploaded_file()会将文件移动到新位置，第一个参数是要移动的文件，第二个参数是移动到哪里。我在这里是放到和本php文件同一目录下，注意需要将新的文件名连接进去。  
			    $after_path = "C:/Apache24/htdocs/library_sys/marvel_control/tmpfile/".$filename;
			    // $after_path = "C:/Apache24/htdocs/library_sys/marvel_control/tmpfile/input.txt";
			    if (move_uploaded_file($file['tmp_name'], $after_path) ) {  
			        // echo "success";  
			    } else{  
			    	var_dump($after_path);
			    	die('move file error');  
			    }
			    $myfile = fopen($after_path, "r") or die("Unable to open file!");
				// 输出单行直到 end-of-file

				while(!feof($myfile)) {
					$linedata = fgets($myfile);
					if (empty($linedata)) {
						// die('data error');
						break;
					}
					$info = explode(",", $linedata);
					$mark = insert_single_book_entry($info[0], $info[1], $info[2], $info[3], $info[4], $info[5], $info[6], $info[7], $info[8]);
					if(!$mark){
			            $ErrMessage = '入库失败,请检查文件';
			            var_dump($linedata);
			            echo "<br/><br/><br/>";
			            var_dump($info);
			            die('Error Number 3');
			            echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href = 'book_store.html#fileinput' </script>";
			        }
				}
				fclose($myfile);
				$ErrMessage = '入库成功';
	            echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href ='book_store.html#fileinput'</script>";
				}
		}
		else{
			$ErrMessage = '入库失败,请检查表单';
	        die('Error Number 2');
	        echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href = 'book_store.html' </script>";
		}
	}
	else{
		$ErrMessage = '请重新输入！';
        echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href ='/library_sys/marvel_control/empty_page.html'</script>";
	}
	function insert_single_book_entry($bno, $category, $title, $press, $year, $author, $price, $total, $stock){
		$db_host = "localhost";
	    $db_user = "root";
	    $db_password = "DataBase18";
	    $db_database = "library";
	    $conn = new mysqli($db_host, $db_user, $db_password, $db_database);
	    if($conn -> connect_errno){
	        die('连接错误' . $conn -> connect_error);
	    }
	    $query = "insert into book values('{$bno}', '{$category}', '{$title}', '{$press}', $year, '{$author}', $price, $total, $stock);";
	    $result = $conn->query($query);
	    return $result;
	}
	function clear_book_info(){
		unset($_SESSION['bno']);
		unset($_SESSION['category']);
		unset($_SESSION['title']);
		unset($_SESSION['press']);
		unset($_SESSION['year']);
		unset($_SESSION['author']);
		unset($_SESSION['price']);
		unset($_SESSION['total']);
		unset($_SESSION['stock']);
	}
?>