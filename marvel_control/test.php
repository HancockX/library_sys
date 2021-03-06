<!DOCTYPE html>
<?php
    session_start();
    require 'db_config.php';
?>

<?php
// 定义变量并设置为空值
$numErr = "";
$number = "";
$bnoErr = "";
$bno = "";


if ($_GET) 
{
    if (empty($_GET["number"])){
        $numErr = "number is required";} 
    else
    {
        $number = test_input1($_GET["number"]);
    }
    if(empty($_GET["bno"])){
        $bnoErr = "";}
    else{
        $bno = test_input1($_GET["bno"]);}
}

update_session();



function test_input1($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

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
            //  $_SESSION["category"] = $_POST["category"]
            // }
        }
    }

    function get_session($index){
            // return empty($_SESSION)["$index"] ? "" : $_SESSION["$index"] ;
            if(!empty($_SESSION["$index"])){ return $_SESSION["$index"]; }
            else { return ""; }
    }


?>


<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>图书管理系统</title>
    <!-- Bootstrap Styles-->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><strong>图书管理系统</strong></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo"{$_SESSION['user']}";?></a>
                        </li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="index.html"><i class="fa fa-dashboard"></i> 概览 </a>
                    </li>
                    <li>
                        <a href="book_query.html"><i class="fa fa-search"></i> 查询 </a>
                    </li>
                    <li>
                        <a href="book_borrow.html"><i class="fa fa-bookmark"></i> 借书 </a>
                    </li>
                    <li>
                        <a href="book_return.html" class="active-menu"><i class="fa fa-bookmark-o"></i> 还书 </a>
                    </li>
                    <li>
                        <a href="book_store.html"><i class="fa fa-edit"></i> 图书入库 </a>
                    </li>
                    <li>
                        <a href="card_control.html"><i class="fa fa-cog"></i> 借书证管理 </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div class="header"> 
                        <h1 class="page-header">
                            图书归还
                        </h1>                   
            </div>

            
            <div id="page-inner">

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="header">借阅情况</h3>
                        </div>
                        <div class="panel-body">   
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form1">
                                        <div class="form-group">
                                            <label for="number" style="font-size:15px;" class="col-md-3 control-label"> 借书证 </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="number" value="<?php echo get_session("number") ?>">
                                                <!-- <span class="error"><?php echo $numErr;?></span> -->
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" formmethod="get" formaction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="btn btn-primary"> 提交查询 </button>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            
                                        </div> -->
                                        <!-- <hr/> -->
                                    </form>
                                </div>
                            </div> 
                            <!-- echo"     -->
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal">
            <div class="form-group">
                <label class=" col-md-3 control-label"> 借书证!!!</label>
                <div class=col-md-6>
                    <input type=text class=form-control name=number>
                </div>
                <div class=col-md-3>
                    <button type=submit formmethod=get class='btn btn-primary'> 提交查询 </button>
                </div>
            </div>
        </form>
    </div>
</div> 
                                        <!-- "; -->
                            <?php

                            if(!empty($number))
                            {
                                //$borrow_num = find($number);
                                $borrow_num=1;
                                if($borrow_num>=0)
                                {
                                    $to_borrow_num = 5-$borrow_num;
                                    // echo "<p font-size:13px align=center valign=middle>  借书证：$number &nbsp &nbsp已借书目总数：$borrow_num  &nbsp &nbsp 可借书目总数：$to_borrow_num</p> <br/><br/>";


                                    // echo"
                                    //     <div class='row'>"."
                                    //         <div class='col-md-12'>"." 
                                    //             <form>
                                    //                 <div class='form-horizontal'>"."
                                    //                     <div class='form-group'>"."
                                    //                         <label for='bno' "." class='col-md-3' "." 'control-label'> 书号 </label>"."
                                    //                         <div class='col-md-6'>"."
                                    //                             <input type='text' "." form='form1' "." name='bno' "." value='get_session(bno)'>"."
                                    //                             <span class='error'>$numErr</span>"."
                                    //                         </div>"."
                                    //                         <div class='col-md-3'>"."
                                    //                             <button type='submit' "." form='form1'  formmethod=get formaction=" .htmlspecialchars($_SERVER["PHP_SELF"]). " "." class='btn btn-primary'> 提交查询 </button>"."
                                    //                         </div>
                                    //                     </div>
                                    //                 </div>
                                    //             <form/>
                                    //         </div>
                                    //     </div>
                                    //     ";
                                    echo"    
                                        <div class=row>
                                            <div class=col-md-12>
                                                <form class=form-horizontal method=get>
                                                    <div class=form-group>
                                                        <div class=col-md-3>
                                                            <label control-label align = right > 借书证!!!</label>
                                                        </div>
                                                        <div class=col-md-6>
                                                            <input type=text class=form-control name=number>
                                                        </div>
                                                        <div class=col-md-3>
                                                            <button type=submit formmethod=get class='btn btn-primary'> 提交查询 </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div> 
                                        ";

                                    // echo "
                                    //     书号 <br/>
                                    //     <input form=form1 type=text name=bno value='{$bno}' autofocus>
                                    //     <span class=error>$bnoErr</span>
                                    //     <input type=submit form=form1 formmethod='get' formaction=". htmlspecialchars($_SERVER["PHP_SELF"]). "  value=return>
                                    //     <br/>";

                                    if(!empty($bno))
                                    {
                                        $ano=$_SESSION['username'];
                                        revert($ano,$number,$bno);
                                    }
                                }
                            }
                            function find($number)
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
                                $query = "select * from card where cno='{$number}';";
                                $result = $conn->query($query);
                                if($result->num_rows > 0)
                                {
                                    $query = "select book.bno,category,title,press,year,author,price,total,stock
                                             from book, borrow
                                             where book.bno=borrow.bno 
                                                    and cno='{$number}';
                                             ";
                                    $result = $conn->query($query);
                                    
                                    $borrow_num = 0;
                                    if ($result->num_rows > 0)
                                    {
                                        echo("<br/>");
                                        echo("<table width=1000 border=1>");
                                        echo("
                                            <tr>
                                                <td align=center valign=middle width=80>  书号 </td>
                                                <td align=center valign=middle width=80>  类别 </td>
                                                <td align=center valign=middle width=200>  书名 </td>
                                                <td align=center valign=middle width=150>  出版社 </td>
                                                <td align=center valign=middle width=80>  年份 </td>
                                                <td align=center valign=middle width=100>  作者 </td>
                                                <td align=center valign=middle width=100>  价格 </td>
                                                <td align=center valign=middle width=80>  总藏书量 </td>
                                                <td align=center valign=middle width=80>  库存 </td>
                                            </tr>");
                                        while($row = $result->fetch_array())
                                        {
                                            echo("<tr>
                                                    <td align=center valign=middle width = 80> $row[0] </td>
                                                    <td align=center valign=middle width = 80> $row[1] </td>
                                                    <td align=center valign=middle width = 200> $row[2] </td>
                                                    <td align=center valign=middle width = 150> $row[3] </td>
                                                    <td align=center valign=middle width = 80> $row[4] </td>
                                                    <td align=center valign=middle width = 100> $row[5] </td>
                                                    <td align=center valign=middle width = 100> $row[6] </td>
                                                    <td align=center valign=middle width = 80> $row[7] </td>
                                                    <td align=center valign=middle width = 80> $row[8] </td>
                                                  </tr>");
                                        }
                                        echo "</table>";
                                        $query = "select count(*)
                                                  from borrow
                                                  where cno='{$number}';";
                                        $result = $conn->query($query);
                                        $borrow_num = $result->fetch_array()[0];
                                    }
                                    else
                                    {
                                        echo("<br/>");
                                        echo("<table width=1000 border=1>");
                                        echo("
                                            <tr>
                                                <td align=center valign=middle width=80>  书号 </td>
                                                <td align=center valign=middle width=80>  类别 </td>
                                                <td align=center valign=middle width=200>  书名 </td>
                                                <td align=center valign=middle width=150>  出版社 </td>
                                                <td align=center valign=middle width=80>  年份 </td>
                                                <td align=center valign=middle width=100>  作者 </td>
                                                <td align=center valign=middle width=100>  价格 </td>
                                                <td align=center valign=middle width=80>  总藏书量 </td>
                                                <td align=center valign=middle width=80>  库存 </td>
                                            </tr>");
                                        echo("<table/>");
                                        $borrow_num = 0;
                                    }
                                }
                                else
                                {
                                    echo "<br/> 未找到指定借书证<br/>";
                                    $borrow_num = -1;
                                }     

                                return $borrow_num;
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
                                    $conn->query($query);
                                    $query = "select * from book where bno='{$row[0]}';";
                                    $result = $conn->query($query);
                                    echo("<br/>");
                                    echo("<table width=1000 border=1>");
                                    echo("<tr>
                                        <td align=center valign=middle width=80>  书号 </td>
                                        <td align=center valign=middle width=80>  类别 </td>
                                        <td align=center valign=middle width=200>  书名 </td>
                                        <td align=center valign=middle width=150>  出版社 </td>
                                        <td align=center valign=middle width=80>  年份 </td>
                                        <td align=center valign=middle width=100>  作者 </td>
                                        <td align=center valign=middle width=100>  价格 </td>
                                        <td align=center valign=middle width=80>  总藏书量 </td>
                                        <td align=center valign=middle width=80>  库存 </td>
                                      </tr>");
                                    $row = $result->fetch_array();
                                    echo("<tr>
                                            <td align=center valign=middle width = 80> $row[0] </td>
                                            <td align=center valign=middle width = 80> $row[1] </td>
                                            <td align=center valign=middle width = 200> $row[2] </td>
                                            <td align=center valign=middle width = 150> $row[3] </td>
                                            <td align=center valign=middle width = 80> $row[4] </td>
                                            <td align=center valign=middle width = 100> $row[5] </td>
                                            <td align=center valign=middle width = 100> $row[6] </td>
                                            <td align=center valign=middle width = 80> $row[7] </td>
                                            <td align=center valign=middle width = 80> $row[8] </td>
                                          </tr>");
                                    echo "</table>";

                                    echo "<br/> 还书成功<br/>";

                                }
                                else
                                {
                                    echo "<br/> 未借用指定书目<br/>";
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form1">
                                        <div class="form-group">
                                            <label for="number" style="font-size:15px;" class="col-md-3 control-label"> 借书证 </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="number" value="<?php echo get_session("number") ?>">
                                                <!-- <span class="error"><?php echo $numErr;?></span> -->
                                            </div>
                                            <div class="col-md-3">
                                                <button type="submit" formmethod="get" formaction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="btn btn-primary"> 提交查询 </button>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                            
                                        </div> -->
                                        <!-- <hr/> -->
                                    </form>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            </div>


        </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   




    
</body>
</html>
