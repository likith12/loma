<?php
session_start();
$hodID=$_SESSION["empid"];
	if(isset($_POST['forward_leaves']))
	{
		if($_POST['leavelist'])
		{
			$link= new mysqli("localhost:3316","root","","fac_leave_management");
			foreach ($_POST['leavelist'] as $selected) {
				$q="insert into forwards_to_admin values('".$hodID."','".$selected."')";
				mysqli_query($link,$q);
			}
		}
	}
	
	header("Location:hod.php");
?>