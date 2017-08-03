<?php
	include "database_config.php";

	function GetDataBase() 
	{
		global $db_config;

		$connection = mysql_connect($db_config["db_hostname"], $db_config["db_username"], $db_config["db_password"]);
		mysql_select_db($db_config["db_dbname"]);

		mysql_query ("set character_set_results='utf8'");   
		mysql_query("SET NAMES utf8");
	}

	function DatabaseClose()
	{
		mysql_close();
	}


	function GetListOfItems()
	{
		$all_items = array();
		GetDataBase();

		$query = "SELECT * FROM SalesItems";
		$result = mysql_query($query);

		while($row = mysql_fetch_array($result))
		{
			$item = array(
				'id' => $row['id'], 
				'name' => $row['name'],
			);
			array_push($all_items, $item);
		}

		DatabaseClose();
		return $all_items;
	}

	function GetReport($date)
	{
		$report = array();
		GetDataBase();

		$query = "SELECT * FROM Records WHERE time BETWEEN '$date 00:00:00' AND '$date 23:59:59'";
		$result = mysql_query($query);

		while($row = mysql_fetch_array($result))
		{
			$itemid = $row["itemID"];
			$count = $row["count"];
			$takeaway = $row["takeaway"];

			if (!array_key_exists($itemid, $report))
			{
				$report[$itemid] = array(
					'count' => 0,
					'takeawaycount' => 0
				);
			}

			if ($takeaway)
			{
				$report[$itemid]['takeawaycount'] += $count;
			}
			$report[$itemid]['count'] += $count;
		}

		DatabaseClose();
		return $report;
	}

	function GetHistory($date)
	{
		$history = array();

		$currentdate = new DateTime(date('Y-m-d'));

		$end = new DateTime($date);
		$end->modify('+3 day');		
		if ($end > $currentdate)
			$end = $currentdate;

		$begin   = new DateTime($date);
		$begin->modify('-3 day');

		for($i = $begin; $i <= $end; $i->modify('+1 day')){
			$repor_x = GetReport($i->format('Y-m-d'));
			$count_x = 0;
			foreach ($repor_x as $key => $value) {
				$count_x += $value['count'];
			}

		    $history[$i->format('Y-m-d')] = $count_x;
		}
		
		return $history;
	}

	function GetItemName($itemid)
	{
		global $all_items;
		foreach ($all_items as $item)
		{
			$id = $item['id'];
			$name = $item['name'];

			if ($id == $itemid)
			{
				return $name;
			}
		}
	}

	function GetReporTime($date)
	{
		$report = array();
		GetDataBase();

		$query = "SELECT * FROM Records WHERE time BETWEEN '$date 00:00:00' AND '$date 23:59:59'";
		$result = mysql_query($query);

		while($row = mysql_fetch_array($result))
		{
			array_push($report, $row);
		}

		DatabaseClose();
		return $report;
	}

?>