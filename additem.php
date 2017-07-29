<?php
	include "database.php";

	GetDataBase();
	$name = $_POST["name"];
	$query = "INSERT INTO SalesItems (name) VALUES('$name')";
	echo $query;
	$result = mysql_query($query);


	echo "OK ", $result;
?>s