<?php
session_start();

	if(isset($_POST['forward_to_principal']))
	{
		if($_POST['leavelist'])
		{
			$link= new mysqli("localhost:3316","root","","fac_leave_management");
			foreach ($_POST['leavelist'] as $selected) {

				$q="insert into forwards values('".$selected."')";
				mysqli_query($link,$q);
				$del="delete from forwards_to_admin where leave_id=".$selected;
				mysqli_query($link,$del);
		}
		header("Location:admin.php");
	}
}
?>