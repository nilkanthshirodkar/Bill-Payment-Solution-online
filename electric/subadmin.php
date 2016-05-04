<?php
class subadmin{
		//Add sub admin to system
		public function add($aid,$sdiv,$name,$username,$pass)
		{
			$pass=md5($pass);
			mysql_query("insert into system_user values('','$aid','$sdiv','$name','$username','$pass')");	
		}
		//Adds meter reading of a cycle 
		public function add_bill($current,$to,$due,$cycle_no)
		{
			$q=mysql_query("SELECT * FROM `meter_reading`  WHERE `cycle_no` LIKE '$cycle_no' ORDER BY `date` DESC");
			$r=mysql_fetch_array($q);
			$prev=$r['reading'];
			mysql_query("insert into meter_reading values('$cycle_no','$current','$to')");
			$meter_unit=$current-$prev;
			mysql_query("insert into bill_unit values('','$cycle_no','$meter_unit')");
			mysql_query("insert into bill_status values('','pending')");
		} 
		//Adds customer to a sub division
		public function add_user($sb_id,$sdiv,$cycle_no)
		{
			mysql_query("insert into user values('$sb_id','$sdiv','$cycle_no')");	
		}
		//Get all customers in a sub_division
		public function get_user($sb_id)
		{
			$q=mysql_query("select * from users");
			$r=mysql_fetch_array($q);
			return $r;
		}
		//get bill_unpaid
		public function bill_status($si)
		{
			$q=mysql_query("select * from bill_status where status='pending'");
			$r=mysql_fetch_array($q);
			return $r['status'];	
		}
	}
?>