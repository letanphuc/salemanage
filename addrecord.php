<?php
	include "database.php";

	GetDataBase();
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	$id = $_POST["id"];
	$time = date('Y-m-d H:i:s');
	$query = "INSERT INTO Records (itemID, time) VALUES($id, '$time')";
	echo $query;
	$result = mysql_query($query);


	echo "OK", $result;
?>s