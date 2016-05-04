<?php
	mysql_connect("localhost","root");
	mysql_select_db("electric");
	include("Admin.php");
	include("subadmin.php");
	$us=new admin();
	$u=new subadmin();
	session_start();
	if($_REQUEST['us'])
	{
		$email=htmlspecialchars($_REQUEST['us']);
		$pass=md5(htmlspecialchars($_REQUEST['pass']));
		$q=mysql_query("SELECT *
FROM `system_user`
WHERE `username` LIKE '$email' and pass='$pass' ");
		if($r=mysql_fetch_array($q))
		{
			$_SESSION['uid']=$r[0];
			if($r[1]==0)
			{
				echo"super";	
			}
			if($r[1]==1)
			{
				echo"admin";	
			}
			if($r[1]==2)
			{
				echo"sub";	
			}
		}
		else
		{
			echo"fail";	
		}
	}
	if($_REQUEST['names'])
	{
		$name=htmlspecialchars($_REQUEST['names']);
		$a=htmlspecialchars($_REQUEST['addresss']);
		$email=htmlspecialchars($_REQUEST['emails2']);
		$pass=htmlspecialchars($_REQUEST['passs2']);
		$us->add(1,$a,$name,$email,$pass);
		echo"true";
	}
	if($_REQUEST['name2'])
	{
		$name=htmlspecialchars($_REQUEST['name2']);
		$a=htmlspecialchars($_REQUEST['address2']);
		$email=htmlspecialchars($_REQUEST['email22']);
		$pass=htmlspecialchars($_REQUEST['pass22']);
		$u->add(2,$a,$name,$email,$pass);
		echo"true";
	}
	if($_REQUEST['cno'])
	{
		$name=htmlspecialchars($_REQUEST['cno']);
		$address=htmlspecialchars($_REQUEST['current']);
		$date=date("y-m-d");
		$u->add_bill($address,$date,$due
,$name);		
		echo"true";
		
	}
	
?>