<?php
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "DataBase18";
        $db_database = "library";
        $conn = new mysqli($db_host, $db_user, $db_password, $db_database);
        if ( !$conn->connect_error ) {
            echo "connection successful<br/>";
        }
        else {
            echo "Failed <br/>";
        }
        // $mySQLi -> set_charset('utf8');
        // $query = "select Name, Continent, Population  from country where Population < $number";
        $query = "select * from book";
        $result = $conn->query($query);
        var_dump($result);
?>