<?php
    session_start();
    if (isset($_COOKIE['username'])) {
        setcookie('username', "", time()-300);
    }
    if (isset($_COOKIE['password'])) {
        setcookie('password', "", time()-300);
    }
    session_destroy();
    $ErrMessage = '登出成功';
    echo "<script type='text/javascript'> alert('{$ErrMessage}');location.href = '../login_page/index.html' </script>";
?>