<?php
class admin
{
	//Add admin to system
	public function add($super,$div,$name,$username,$pass)
	{
		$pass=md5($pass);
		mysql_query("insert into system_user values('','$super','$div','$name','$username','$pass')");	
	}
	//adds terrif rate
	public function add_terrif($catagory,$type,$fixed,$at)
	{
		mysql_query("insert into tarrif values('$catagory','$type','$fixed','at')");	
	}	
	//Add Division & sub Division
	public function add_division($circle,$div,$sub){
		mysql_query("insert into divison values('$circle'.'$div','$sub')");
	}
	//Add other tarrif charges
	public function add_other($fppca,$meter_rent,$duty,$multiplying_factor)
	{
		mysql_query("insert into other_tarrif values('$fppca','$meter_rent','$duty','$multiplying_factor')");	
	}
}
?>