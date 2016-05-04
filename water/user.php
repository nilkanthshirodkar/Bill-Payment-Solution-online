<?php
class user{
	public function get_bill($num)
	{
		$q=mysql_query("SELECT * FROM `bill_unit` WHERE meter_no='$num'");
		$r=mysql_fetch_array($q);
		return $r;
	}
	public function get_reading($num)
	{
		$q=mysql_query("SELECT *
FROM `meter_reading` where meter_no='$num'
ORDER BY `date` DESC
LIMIT 0 , 1");
		$r=mysql_fetch_array($q);
		return $r['reading'];	
	}
	public function get_prev_reading($num)
	{
		$q=mysql_query("SELECT *
FROM `meter_reading` where meter_no='$num'
ORDER BY `date` DESC
LIMIT 1 , 2");
		$r=mysql_fetch_array($q);
		return $r['reading'];	
	}
	public function get_tarrif()
	{
		$q=mysql_query("SELECT *
FROM `tarrif`");
		$r=mysql_fetch_array($q);
		return $r;	
	}
	public function get_other_tarrif()
	{
		$q=mysql_query("SELECT *
FROM `other_tarrif`");
		$r=mysql_fetch_array($q);
		return $r;	
	}
	public function status($bid)
	{
		$q=mysql_query("SELECT *  FROM `bill_status` WHERE `bid` = '$bid'");
		$r=mysql_fetch_array($q);
		return $r['status'];	
	}
}
?>