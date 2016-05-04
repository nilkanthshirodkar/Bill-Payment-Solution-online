<?php
mysql_connect("localhost","root");
	mysql_select_db("users");
	include("account.php");
	if($_REQUEST['id'])
	{
		$id=htmlspecialchars($_REQUEST['id']);
		$us=new login();
		if($r=$us->verify($id))
		{
			$uid=$r[0];
			$em=$r[1];
			$ps=$r[2];
			$us->add_login($uid,$em,$ps);
			header( 'Location: index.html' ) ;
			
		}
	}
	echo"Sorry, something went wrong! try again by reloading...";
?>