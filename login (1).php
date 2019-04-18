<?php

if ( isset($_POST['submit']) ) {
	session_start();
	$name=$_POST['usr'];
	$_SESSION['empid']=$_POST['usr'];//changed $_SESSION["usr"] to $_SESSION["empid"]
	$password=$_POST['pass'];
	$db="fac_leave_management";
	$pass="";
	$link= new mysqli("127.0.0.1:3316","root",$pass,$db);
	
	if (!$link) {
	    die('Could not connect: ' . mysqli_error($link));
	}
	else{
	
	}	
	$sql = "select * FROM login WHERE username='".$name."' AND password='".$password."'";
	$result= mysqli_query($link,$sql);
	if(mysqli_num_rows($result) > 0)
	{
		$q="select * from employee where emp_id='".$name."'";
		$res=mysqli_query($link,$q);
		$det=mysqli_fetch_assoc($res);
		$_SESSION['branch']=$det['branch'];
		$_SESSION['name']=$det['name'];
		$_SESSION['type']=$det['type'];
		$_SESSION['desig']=$det['desig'];
		$_SESSION['email']=$det['email'];
		$_SESSION['mobile']=$det['mobile'];

		if($_SESSION['desig']=="HOD")
		{
			header("Location: hod.php");
		}
		else if($_SESSION['desig']=="ADMIN")
		{
			header("Location: admin.php");
		}
		elseif ($_SESSION['desig']=="PRIN") 
		{
			header("Location: principal.php");
		}
		else
		{
			header("Location: employee.php");
		}
	}
	else
	{
		echo "Invalid Credentials";
	}
	
	mysqli_close($link);
	}
?>