<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome to our library</title>
</head>
<body>
	<h2>Testing Connection...</h2>
<?php
	$db_host = "localhost";
	$db_user = "root";
	$db_password = "DataBase18";
	// $db_database = "library";
	$db_database = "world";
	$conn = new mysqli($db_host, $db_user, $db_password, $db_database);
	if ( !$conn->connect_error ) {
		echo "connection successful<br/>";
	}
	else {
		echo "Failed <br/>";
	}
	// $query = "show tables";
	$query = "select Name, Continent, Population  from country where Population > 100000000";
	$result = $conn->query($query);
	if ($result->num_rows > 0){
		echo("<table width=350 border=1>");
		echo("<tr><td width=115> Name </td><td width=110> Continent </td><td> Population </td></tr>");
		while($row = $result->fetch_array()){
			echo "<tr><td width = 150>", $row[0], "</td>", "<td width = 150>", $row[1], "</td><td width = 150>", $row[2], "</td></tr>" ;
		}
		// while($row = $result->fetch_assoc()){
		// 	echo "<tr><td width = 150>", $row["Name"], "</td>", "<td width = 150>", $row["Continent"], "</td><td width = 150>", $row["Population"], "</td></tr>" ;
		// }
		echo "</table>", "Reseults Above", "<br/>" ;
	}

?>
</body>
</html>