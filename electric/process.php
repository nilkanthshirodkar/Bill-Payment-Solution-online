<?php
	mysql_connect("localhost","root");
	include("account.php");
	include("user.php");
	include("user2.php");
	$u=new user();
	$u2=new user2();
	session_start();
	if(isset($_REQUEST['email']))
	{
		$us=new login();
		mysql_select_db("users");
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
		mysql_select_db("users");
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
		mysql_select_db("electric");
		$cno=$_REQUEST['bill'];
		$r=$u->get_bill($cno);
		$cur=$u->get_reading($cno);
		$prev=$u->get_prev_reading($cno);
		$un=$cur-$prev;
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
		$ed=$un*0.20;
		$total=$ec+$mr+$ed;
		?>
        	<table width="800" style="color:#666; font-size:14px;" border="1" cellpadding="2" cellspacing="2">
 <tr>
	      <td width="69">Division</td>
	      <td width="202">&nbsp;</td><td width="334" class="intro">Electricity Department Government of Goa</td>
		  <td width="" align="left">Current Reading</td><td> <?php echo"$cur";?></td>
          
    </tr>
	 <tr>
     
	      <td width="69">Sub Division</td>
  			      <td width="202">&nbsp;</td>
                   <td width="202">&nbsp;</td>
     <td width="" align="left">Previous Reading</td><td> <?php echo"$prev";?></td>
    </tr></table>
	<table width="800" style="color:#666; font-size:14px;" border="1" cellpadding="2" cellspacing="2">
	 <tr>
	      <td width="85">Consumer ID</td>
       <td width="204">&nbsp;</td><td width="133">Bill Cum Receipt No</td> 
       <td width="188">&nbsp;</td>
	   <td width="171">Metered Units</td> 
       <td width="261"><?php echo"$un";?></td>
      </tr>
	   <tr>
	      <td width="85">Cycle No</td>
       <td width="204"><?php echo"$cno";?></td><td width="133">Bill Issue Date</td> 
       <td width="188"><?php echo date("y-m-d");?> </td>
	   <td width="171">Average Units Kwh</td> 
       <td width="261"></td>
      </tr>
	   <tr>
	      <td width="85">Consumer Name</td>
       <td width="204">&nbsp;</td><td width="133">Bill Due Date</td> 
       <td width="188">&nbsp;</td>
	   <td width="171">Multiplying Factor</td> 
       <td width="261"><?php echo"$mf";?></td>
      </tr>
	   <tr>
	      <td width="85">Consumer Address</td>
       <td width="204">&nbsp;</td><td width="133">Installation No</td> 
       <td width="188">&nbsp;</td>
	   <td width="171">Gross Units Billed</td> 
       <td width="261"><?php echo"$gun";?></td>
      </tr></table>
	  <table width="800" style="color:#666; font-size:14px;" border="1"  cellpadding="2" cellspacing="2">
	  <tr>
	      <td width="93">Date Of Connection</td>
       <td width="152">&nbsp;</td><td width="149"></td> 
       <td width="192"></td>
	   <td width="206">Energy Charges Rs</td> 
       <td width="262"><?php echo"$ec";?></td>
      </tr>
	    <tr>
	      <td width="93">Sanctioned Load</td>
       <td width="152">&nbsp;</td><td width="149"></td> 
       <td width="192"></td>
	   <td width="206">Meter Rent Rs</td> 
       <td width="262"><?php echo"$mr";?></td>
      </tr>
	    <tr>
	      <td width="93">Tarrif</td>
       <td width="152">&nbsp;</td><td width="149"></td> 
       <td width="192"></td>
	   <td width="206">Electricity Duty Rs</td> 
       <td width="262"><?php echo"$ed";?></td>
      </tr>
	    <tr>
	      <td width="93">Minimum Charges Rs</td>
       <td width="152">&nbsp;</td><td width="149"></td> 
       <td width="192"></td>
	   <td width="206">Capacitor Charges Rs</td> 
       <td width="262">&nbsp;</td>
      </tr>
	    <tr>
	      <td width="93">Average Units Kwh</td>
       <td width="152">&nbsp;</td><td width="149"></td> 
       <td width="192"></td>
	   <td width="206">Sundry Charges Rs</td> 
       <td width="262">&nbsp;</td>
      </tr>
	    <tr>
	      <td width="93">Line Min Charges Rs</td>
       <td width="152">&nbsp;</td><td width="149"></td> 
       <td width="192"></td>
	   <td width="206">Gross Bill Amount Rs</td> 
       <td width="262"><?php echo"$total";?></td>
      </tr>
	   <tr>
	      <td width="93">Line Min Period</td>
       <td width="152">&nbsp;</td><td width="149"></td> 
       <td width="192"></td>
	   <td width="206">Arrears Rs</td> 
       <td width="262">&nbsp;</td>
      </tr>
	   <tr>
	      <td width="93">Meter Make</td>
       <td width="152">&nbsp;</td><td width="149"></td> 
       <td width="192"></td>
	   <td width="206">Credit Rs</td> 
       <td width="262">&nbsp;</td>
      </tr>
	   <tr>
	      <td width="93">Lt Pole No</td>
       <td width="152">&nbsp;</td><td width="149"></td> 
       <td width="192"></td>
	   <td width="206">Net Amount Payable Rs</td> 
       <td width="262"><?php echo"$total";?></td>
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
	if(isset($_REQUEST['bil']))
	{
		mysql_select_db("water");
		$cno=$_REQUEST['bil'];
		$r=$u2->get_bill($cno);
		$cur=$u2->get_reading($cno);
		$prev=$u2->get_prev_reading($cno);
		$un=$cur-$prev;
		$nod=30;
		$mu=$un/30;
		$mon_con=$mu*30;
		if($mon_con<25)
		{
			$val=$mon_con*2.50;
		}
		else
		{
			$val=25*2.50;
			$mon2=$mon_con-25;
			if($mon2<10)
			{
			$val2=$mon2*7.50;
			$val=$val+$val2;
			}
			else
			{
			$val2=10*7.50;
			$val=$val+$val2;
			$mon2=$mon_con-35;
			if($mon2<15)
			{
			$val2=$mon2*10;
			$val=$val+$val2;
			}
			else
			{
			$val2=$mon2*15;
			$val=$val+$val2;
			}
			}
			
		}
		$wc=$val;
		$mr=20;
		
		$total=$wc+$mr;
		?>
       <table width="800" style="color:#666; font-size:20px;" border="1" cellpadding="2" cellspacing="2">
           <tr>
        <th><div align='center' class="intro">Government of Goa PUBLIC WORKS DEPARTMENT</div></th>
        </tr>
        </table>
        <table width="800" style="color:#666; font-size:20px;" border="1" cellpadding="2" cellspacing="2">
        <tr>
	      <td width="84">Div.</td>
	      <td width="202">&nbsp;</td>
		  <td width="69">Sub.Div.</td>
	      <td width="202">&nbsp;</td>
		  <td width="72" align="left">Current Meter Reading</td><td><?php echo"$cur";?></td>
          <td width="72" align="left">Previous Reading</td><td>&nbsp;</td>
		  
    </tr>
	 <tr>
	   <td width="72" align="left">Avg.Units </td><td>&nbsp;</td>
	   <td width="72" align="left">Min.Units</td><td>&nbsp;</td>   
	   <td width="84">Meter No.</td>
       <td width="202"><?php echo"$cno";?></td>
	   <td width="84">From Date</td>
       <td width="202">&nbsp;</td>
	   </tr>
	   <tr>
	   <td width="95">To Date</td> 
       <td width="223">&nbsp;</td>
	   <td width="170">Issue Date</td> 
       <td width="256"><?php echo date("y-m-d");?></td>
      </tr>
	   <tr>
	      <td width="84">Units Billed</td>
       <td width="202"><?php echo"$un";?></td>
	   <td width="95">Water Charges</td> 
       <td width="223"><?php echo"$wc";?></td>
	   <td width="170">Meter Rent</td> 
       <td width="256"><?php echo"$mr";?></td>
      </tr>
	   <tr>
	      <td width="84">Consumer Name</td>
       <td width="202"></td>
	   <td width="95">Sewerage charges</td> 
       <td width="223"></td>
	   <td width="170">Sundry Charges</td> 
       <td width="256"></td>
       </tr>
	   <tr>
	   <td width="84">Arrears</td>
       <td width="202">&nbsp;</td>
	   <td width="95">Total</td> 
       <td width="223"><?php echo"$total";?></td>
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