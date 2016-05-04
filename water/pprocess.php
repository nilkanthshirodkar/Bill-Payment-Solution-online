<?php
	mysql_connect("localhost","root");
	mysql_select_db("users");
	mysql_select_db("electric");
	include("account.php");
	include("user.php");
	$u=new user();
	session_start();
	if(isset($_REQUEST['email']))
	{
		$us=new login();
		$email=htmlspecialchars($_REQUEST['email']);
		$pass=htmlspecialchars($_REQUEST['pass']);
		if($r=$us->login2($email,$pass))
		{
			$_SESSION['uid']=$r[0];
			echo"true";	
		}
	}
	if(isset($_REQUEST['name']))
	{
		$us=new login();
		$name=htmlspecialchars($_REQUEST['name']);
		$address=htmlspecialchars($_REQUEST['address']);
		$email=htmlspecialchars($_REQUEST['email2']);
		$pass=htmlspecialchars($_REQUEST['pass2']);
		$contact=htmlspecialchars($_REQUEST['contact']);
		$mobile=htmlspecialchars($_REQUEST['mobile']);
		if(!$r=$us->exist($email))
		{	$us->reg2($name,$email,$pass,$address,$contact,$mobile);
			$to = $email;
			$hash=md5($email);
$subject = "Activation of easypay account";
$message = "click on the link to activate your account :http://soft-pay.org/verify.php?id=$hash";
$from = "easypay@soft-pay.org";
$headers = "From:" . $from;
mail($to,$subject,$message,$headers);
			echo"true";	
		}
		else
		{
			echo"Email already been registered";	
		}	
	}
	if(isset($_REQUEST['s']))
	{
		if($_SESSION['uid']=="")
		{
			echo "false";			
		}
	}
	if(isset($_REQUEST['out']))
	{
		$_SESSION['uid']="";
		echo "true";			
	}
	if(isset($_REQUEST['bill']))
	{
		$cno=$_REQUEST['bill'];
		$r=$u->get_bill($cno);
		$cur=$u->get_reading($cno);
		$prev=$u->get_prev_reading($cno);
		$un=$r['unit'];
		$mf=1;
		$gun=$mf*$un;
		if($gun<=60)
		{
			$ec=$gun*1.00;	
		}elseif($gun<=250)
		{
			$ec=$gun*1.50;
		}elseif($gun<=500)
		{
			$ec=$gun*2.20;
		}
		else
		{
			$ec=$gun*2.50;
		}
		$ec=$ec+20;
		$mr=20;
		$ed=56;
		$total=$ec+$mr+$ed;
		?>
        	<table width="100%" style="color:#666; font-size:20px;" border="1" cellpadding="2" cellspacing="2">
 <tr>
	      <td width="69">Division</td>
	      <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="334" class="intro">Electricity Department Government of Goa</td>
		  <td width="" align="left">Current Reading</td><td> <input type="text" id="fname" name="fname" class="in" /></td>
    </tr>
	 <tr>
	      <td width="69">Sub Division</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td>
    </tr></table>
	<table width="100%" style="color:#666; font-size:20px;" border="1" cellpadding="2" cellspacing="2">
	 <tr>
	      <td width="84">Consumer ID</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95">Bill Cum Receipt No</td> 
       <td width="223"><input type="text" id="fname" name="fname" class="in" /></td>
	   <td width="170">Metered Units</td> 
       <td width="256"><?php echo"$un";?></td>
      </tr>
	   <tr>
	      <td width="84">Cycle No</td>
       <td width="202"><?php echo"$cno";?></td><td width="95">Bill Issue Date</td> 
       <td width="223"><?php echo date("y-m-d");?> </td>
	   <td width="170">Average Units Kwh</td> 
       <td width="256"></td>
      </tr>
	   <tr>
	      <td width="84">Consumer Name</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95">Bill Due Date</td> 
       <td width="223"><input type="text" id="fname" name="fname" class="in" /></td>
	   <td width="170">Multiplying Factor</td> 
       <td width="256"><?php echo"$mf";?></td>
      </tr>
	   <tr>
	      <td width="84">Consumer Address</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95">Installation No</td> 
       <td width="223"><input type="text" id="fname" name="fname" class="in" /></td>
	   <td width="170">Gross Units Billed</td> 
       <td width="256"><?php echo"$gun";?></td>
      </tr></table>
	  <table width="100%" style="color:#666; font-size:20px;" cellpadding="2" cellspacing="2">
	  <tr>
	      <td width="84">Date Of Connection</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95"></td> 
       <td width="223"></td>
	   <td width="170">Energy Charges Rs</td> 
       <td width="256"><?php echo"$ec";?></td>
      </tr>
	    <tr>
	      <td width="84">Sanctioned Load</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95"></td> 
       <td width="223"></td>
	   <td width="170">Meter Rent Rs</td> 
       <td width="256"><?php echo"$mr";?></td>
      </tr>
	    <tr>
	      <td width="84">Tarrif</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95"></td> 
       <td width="223"></td>
	   <td width="170">Electricity Duty Rs</td> 
       <td width="256"><?php echo"$ed";?></td>
      </tr>
	    <tr>
	      <td width="84">Minimum Charges Rs</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95"></td> 
       <td width="223"></td>
	   <td width="170">Capacitor Charges Rs</td> 
       <td width="256"><input type="text" id="fname" name="fname" class="in" /></td>
      </tr>
	    <tr>
	      <td width="84">Average Units Kwh</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95"></td> 
       <td width="223"></td>
	   <td width="170">Sundry Charges Rs</td> 
       <td width="256"><input type="text" id="fname" name="fname" class="in" /></td>
      </tr>
	    <tr>
	      <td width="84">Line Min Charges Rs</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95"></td> 
       <td width="223"></td>
	   <td width="170">Gross Bill Amount Rs</td> 
       <td width="256"><input type="text" id="fname" name="fname" class="in" /></td>
      </tr>
	   <tr>
	      <td width="84">Line Min Period</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95"></td> 
       <td width="223"></td>
	   <td width="170">Arrears Rs</td> 
       <td width="256"><input type="text" id="fname" name="fname" class="in" /></td>
      </tr>
	   <tr>
	      <td width="84">Meter Make</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95"></td> 
       <td width="223"></td>
	   <td width="170">Credit Rs</td> 
       <td width="256"><input type="text" id="fname" name="fname" class="in" /></td>
      </tr>
	   <tr>
	      <td width="84">Lt Pole No</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td><td width="95"></td> 
       <td width="223"></td>
	   <td width="170">Net Amount Payable Rs</td> 
       <td width="256"><?php echo"$total";?></td>
	   <tr>
	  <td height="56"> <form method="link" action="file:///G:/Project%202012-2013/pay%20option/pay.html">
	    <input type="Submit" value="Pay Now" width:1024px; height:1024px; />
	  </form>
		
   </td>
   </tr>
      </tr>
	   </table>

        <?php
		
	}
?>