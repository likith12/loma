<?php
session_start();

	if(isset($_POST['accepted_Leaves']))
	{
		$link= new mysqli("localhost:3316","root","","fac_leave_management");
		if($_POST['accleavelist'])
		{
			
			foreach ($_POST['accleavelist'] as $selected) {

				$q="insert into principal values('".$selected."','YES')";
				mysqli_query($link,$q);
				$del="delete from forwards where leave_id=".$selected;
				mysqli_query($link,$del);
			}
			$lq="select leave_id from forwards where leave_id not in (select leave_id from principal)";
			$r=mysqli_query($link,$lq);
			while($rr=mysqli_fetch_assoc($r))
			{
				$q1="insert into principal values('".$rr['leave_id']."','PEN')";
					mysqli_query($link,$q1);
			}
			
			header("Location:principal.php");
	}
}
?>