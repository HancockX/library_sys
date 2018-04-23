<?php
    session_start();

function try_login_with($ID, $password){
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "DataBase18";
    $db_database = "library";
    $conn = new mysqli($db_host, $db_user, $db_password, $db_database);
    if($conn->connect_errno){
        die('连接错误' . $conn->connect_error);
    }
<<<<<<< HEAD
=======
    // $query = "select * from admin where ano = 'ano1' ";
>>>>>>> 1b79be0014b002e493d6a10ff3cca812dd15a788
    $query = "select * from admin where ano = '{$ID}'";
    $result = $conn->query($query);
    if ($result->num_rows > 0){
        while ($row = $result -> fetch_assoc()) {
            if ($row['password'] == $password ){
                $_SESSION['user'] = $row['name'];
                // die('密码正确' . $conn -> connect_error);
                return true;
            }
            else{
                // die('密码错误' . $conn -> connect_error);
                return false;
            }
        }
    }
    return false;
}

// 定义变量并设置为空值
$userErr = $username = $passErr = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
        $userErr = "请输入用户名";
    } else {
        $username = test_input($_POST["username"]);
    }
    if (empty($_POST["password"])) {
        $passErr = "请输入密码";
    } else {
        $password = test_input($_POST["password"]);
    }

    if ($userErr == "" && $passErr == "") {
        setcookie('username', $username, time()+300);
        // setcookie('status', 1, time()+300);
        setcookie('password', $password, time()+300);
        $flag = try_login_with($username, $password);
        // die('flag check');        
        if(!$flag){
            $ErrMessage = '用户名或密码错误，请重新输入';
            echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href = 'index.html' </script>";
        }
        else{
            $ErrMessage = '登陆成功';
            $_SESSION['username'] = $username;
            echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href ='/library_sys/marvel_control/empty_page.html'</script>";
        }
    }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>