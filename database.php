<?php
	function GetDataBase() {
		$connection = mysql_connect('localhost', 'root', 'root');
		mysql_select_db('SaleManagement2');
		mysql_query ("set character_set_results='utf8'");   
		mysql_query("SET NAMES utf8");
	}
?>