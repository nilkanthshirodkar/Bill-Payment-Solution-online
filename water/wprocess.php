<?php
	mysql_connect("localhost","root");
	mysql_select_db("water");
	include("user.php");
	$u=new user();
	session_start();
	if(isset($_REQUEST['bill']))
	{
		$cno=$_REQUEST['bill'];
		$r=$u->get_bill($cno);
		echo"Meter number: $cno";
		$cur=$u->get_reading($cno);
		$prev=$u->get_prev_reading($cno);
		$un=$r['unit'];
		if($un<=25)
		{
			$wc=$un*2.50;	
		}elseif($gun<=35)
		{
			$wc=$un*7.50;
		}elseif($un<=50)
		{
			$wc=$un*10.00;
		}
		else
		{
			$wc=$un*15.00;
		}
		$mr=40;
		$total=$wc+$mr;
		?>
        	<table width="100%" style="color:#666; font-size:20px;" border="1" cellpadding="2" cellspacing="2">
 <tr>
  <td width="334" class="intro">Government of Goa PUBLIC WORKS DEPARTMENT</td>
  </tr>
 <tr>
	      <td width="84">Div.</td>
	      <td width="202"><input type="text" id="fname" name="fname" class="in" /></td>
		  <td width="69">Sub.Div.</td>
	      <td width="202"><input type="text" id="fname" name="fname" class="in" /></td>
		  <td width="72" align="left">Current Meter Reading</td><td> <input type="text" id="fname" name="fname" class="in" /></td>
          <td width="72" align="left">Previous Reading</td><td> <input type="text" id="fname" name="fname" class="in" /></td>
		  
    </tr>
	 <tr>
	   <td width="72" align="left">Avg.Units </td><td> <input type="text" id="fname" name="fname" class="in" /></td>
	   <td width="72" align="left">Min.Units</td><td> <input type="text" id="fname" name="fname" class="in" /></td>   
	   <td width="84">Meter No.</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td>
	   <td width="84">From Date</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td>
	   </tr>
	   <tr>
	   <td width="95">To Date</td> 
       <td width="223"><input type="text" id="fname" name="fname" class="in" /></td>
	   <td width="170">Issue Date</td> 
       <td width="256"><?php echo date("y-m-d");?></td>
      </tr>
	   <tr>
	      <td width="84">Units Billed</td>
       <td width="202"><?php echo"$un";?></td>
	   <td width="95">Water Charges</td> 
       <td width="223"><?php echo"$mc";?></td>
	   <td width="170">Meter Rent</td> 
       <td width="256"><?php echo"$mr";?></td>
      </tr>
	   <tr>
	      <td width="84">Consumer Name</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td>
	   <td width="95">Sewerage charges</td> 
       <td width="223"><input type="text" id="fname" name="fname" class="in" /></td>
	   <td width="170">Sundry Charges</td> 
       <td width="256"><input type="text" id="fname" name="fname" class="in" /></td>
       </tr>
	   <tr>
	   <td width="84">Arrears</td>
       <td width="202"><input type="text" id="fname" name="fname" class="in" /></td>
	   <td width="95">Total</td> 
       <td width="223"><?php echo"$total";?></</td>
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