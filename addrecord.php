<?php
	include "database.php";

	GetDataBase();
	date_default_timezone_set('Asia/Ho_Chi_Minh');

	$id = $_POST["id"];
	$count = $_POST["count"];
	$takeaway = $_POST["takeaway"];

	$time = date('Y-m-d H:i:s');
	$query = "INSERT INTO Records (itemID, time, count, takeaway) VALUES($id, '$time', $count, $takeaway)";
	echo $query;
	$result = mysql_query($query);


	echo "OK", $result;
?>s