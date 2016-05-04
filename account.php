<?php
	class login
	{
		public function login2($email,$pass)
		{
			$pass=md5($pass);
			$q=mysql_query("select * from login where email='$email' and pass='$pass'");
			return mysql_fetch_array($q);	
		}	
		public function verify($hash)
		{
			$q=mysql_query("select * from temp where hash='$hash'");
			return mysql_fetch_array($q);				
		}
		public function add_login($uid,$email,$pass)
		{
			mysql_query("insert into login values('$uid','$email','$pass')");	
		}
		public function reg2($name,$email,$pass,$address,$contact,$mobile)
		{
			mysql_query("INSERT INTO  `basic` (  `uid` ,  `name` ,  `address` ,  `contact` ,  `mobile` ,  `email` ) 
VALUES (
NULL ,  '$name',  '$address',  '$contact',  '$mobile',  '$email'
)");
			$hah=md5($email);
			$pass=md5($pass);
			mysql_query("insert into temp values('','$email','$pass','$hah')");
		}
		public function exist($email)
		{
			$q=mysql_query("select * from basic where email='$email'");
			return mysql_fetch_array($q);	
		}
	}
?>