<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

	<?php
	// 定义变量并设置为空值
	$numErr = "";
	$number = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST["number"])) {
	    $numErr = "number is required";
	  } else {
	    $number = test_input($_POST["number"]);
		}
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	Number of limit: <input type="text" name="number" placeholder="100000000" value = "<?php echo "$number";?>" autofocus>
	<span class="error">* <?php echo $numErr;?></span>
	<br><br>
	</form>

	<?php

	if(!empty($number)){
		find($number);
	}
	function find($number){
		$db_host = "localhost";
		$db_user = "root";
		$db_password = "DataBase18";
		$db_database = "world";
		$conn = new mysqli($db_host, $db_user, $db_password, $db_database);
		if ( !$conn->connect_error ) {
			echo "connection successful<br/>";
		}
		else {
			echo "Failed <br/>";
		}
		$query = "select Name, Continent, Population  from country where Population < $number";
		$result = $conn->query($query);
		if ($result->num_rows > 0){
			echo("<table width=600 border=1>");
			echo("<tr><td width=115> Name </td><td width=110> Continent </td><td> Population </td></tr>");
			while($row = $result->fetch_array()){
				echo "<tr><td width = 250>", $row[0], "</td>", "<td width = 150>", $row[1], "</td><td width = 150>", $row[2], "</td></tr>" ;
			}
			echo "</table>", "Reseults Above", "<br/>" ;
		}
	}
	?>
</body>
</html>