<html>
<body>
<?php

function days()
{
	$var1=$_POST['fromDate'];
	$today =$_POST['toDate'];
	$diff= date_diff(date_create($var1), date_create($today));
	$d= $diff->format("%d");
	return $d;
}
if(isset($_POST["submit"]))
{
	session_start();
	//echo "details recieved";
	
	$empID=$_SESSION['empid'];

	$branch=$_SESSION['branch'];
	//print_r($_SESSION);
	if(isset($_SESSION['branch']))
		{ ?>
			<h1><?php echo $branch ?></h1>
		<?php }
	else
		{ ?>
			<h1><?php echo "some mistake" ?></h1>
		<?php }
	$db="fac_leave_management";
	$pass="";
	$link=new mysqli("localhost:3316","root","","fac_leave_management");
	
	if (!$link) {
	    die('Could not connect: ' . mysqli_error($link));
	} 
	else
	{
		$NoD = days();
		
		
		$q= "insert into applies(emp_id,Reason,Fdate,Tdate,No_of_days,branch,type,status) values('".$empID."','".$_POST["reason"]."','".$_POST["fromDate"]."','".$_POST["toDate"]."',".$NoD.",'".$branch."','".$_POST['Type']."','PENDING')";
		mysqli_query($link,$q);

		//$q1="select desig from employee where emp_id='".$name."'";
		//$desig= mysqli_query($link,$q1);
		//$arr=mysqli_fetch_assoc($desig);
		if($_SESSION['desig']=="HOD")
		{
			header("Location: hod.php");
		}
		else if($_SESSION['desig']=="ADMIN")
		{
			header("Location: admin.php");
		}
		else
		{
			header("Location: employee.php");
		}

	}
}
?>
</body>
</html>