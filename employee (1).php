<!--Employee page-->
<html>
<head><H1 align="center">FACULTY PAGE</H1>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<title>faculty</title>
<?php
session_start();
$db="fac_leave_management";
$pass="";
	$link= new mysqli("127.0.0.1:3316","root",$pass,$db);
?>
<h4 align="right"> <?php echo $_SESSION['empid'] ?></h4>

<body class="bck">
	<form action="" method="POST" >
		<input type="submit" name="check" value="Check Leave"class="button">
		<input type="submit" name="apply" value="Apply Leave"class="button">
		<input type="submit" name="checkls" value="Check Leave Status"class="button">
		<input type="submit" name="logout" value="Logout"class="button">
	</form>
</body>
</html>
<?php
$eid=$_SESSION['empid'];
$branch=$_SESSION['branch'];
//print_r($_SESSION);
if(isset($_POST["check"]))
{	
	if (!$link) {
	    die('Could not connect: ' . mysqli_error($link));
	}
	else
	{
		$q="select * from leaves where emp_id='".$eid."'";
		$result=mysqli_query($link,$q);
		while($row=mysqli_fetch_assoc($result))
		{
			echo "<table border='1' align='center'>";
			echo "<tr><th>Emp ID</th><th>CL</th><th>EL</th><th>AL</th><th>OD</th></tr>";
			echo "<tr><td>".$row['emp_id']."</td><td>".$row['CL']."</td><td>".$row['EL']."</td><td>".$row['AL']."</td><td>".$row['OD']."</td></tr>";
			echo "</table>";
		}
	}
}
else if(isset($_POST["apply"]))
{?>
<html>
<script type="text/javascript">
	function apply_leave()
	{
		var name= document.getElementById("myform");
		var text="";
		//text+=name.elements[0].value;
		var i;
		for(i=0;i<name.length-1;i++){
			text+=name.elements[i].value+"<br>";
		}

		
		document.write(text);
	}
</script>

<body>
	<form action="applyLeave.php" method="POST" id="myform">
		<table border="2" align="center">
		<tr><td><label>Reason</label></td><td><input type="text" name="reason" id="reason"></td></tr>
		<tr><td><label>From Date</label></td><td><input type="Date" name="fromDate"></td></tr>
		<tr><td><label>To Date</label></td><td><input type="Date" name="toDate"></td></tr>
		<tr><td>Type</td><td><input type="text" name="Type" ></td></tr>
		<tr><td colspan="2" ><input type="submit" name="submit" value="submit" class="button"></td></tr>
		</table>
	</form>
</body>
</html>
<?php
}
elseif (isset($_POST['checkls'])) 
{
	$q1="select * from applies where emp_id='".$eid."'";
		$res=mysqli_query($link,$q1);
		echo "<table border='1'>";
			echo "<tr><th>Emp ID</th><th>Leave ID</th><th>Reason</th><th>From Date</th><th>To Date</th><th>No of Days</th><th>Type</th><th>Status</th></tr>";
		while($row1=mysqli_fetch_assoc($res))
		{
			
			echo "<tr><td>".$row1['emp_id']."</td><td>".$row1['leave_id']."</td><td>".$row1['Reason']."</td><td>".$row1['Fdate']."</td><td>".$row1['Tdate']."</td><td>".$row1['No_of_days']."</td><td>".$row1['type']."</td><td><b>".$row1['status']."</b></td></tr>";
			
		}
		echo "</table>";
}
else if(isset($_POST["logout"]))
{
	unset($_SESSION['empid']);
	header("Location: index.php");
}	
?>