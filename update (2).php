<?php
	session_start();
	if(isset($_POST['update']))
	{	
		if($_POST['accleavelist'])
		{
			$link=new mysqli("localhost:3316","root","","fac_leave_management");
			foreach ($_POST['accleavelist'] as $a)
			{
				$q1="select emp_id,No_of_days,type from applies where leave_id='".$a."'";
				$res=mysqli_query($link,$q1);
				$row=mysqli_fetch_assoc($res);
				$nod=$row['No_of_days'];
				$eid=$row['emp_id'];
				$typeol=$row['type'];
				$q2="select ".$typeol." from leaves where emp_id='".$eid."'";
				$res2=mysqli_query($link,$q2);
				//echo $res2['CL'];
				$row2=mysqli_fetch_array($res2,MYSQLI_NUM);
				$totl=$row2[0];
				$left=$totl-$nod;
				if($left>=0)
				{
					$up="update leaves set ".$typeol."=".$left." where emp_id='".$eid."'";
					$resup=mysqli_query($link,$up);
					$grant="update applies set status='APPROVED' where emp_id='".$eid."'";
					mysqli_query($link,$grant);
					$delfor="delete from principal where leave_id=".$a;
					mysqli_query($link,$delfor);
					
				}
				else
				{
					$delfor="delete from principal where leave_id=".$a;
					mysqli_query($link,$delfor);
					$err="update applies set status='OUT OF LEAVES' where emp_id='".$eid."'";
					mysqli_query($link,$err);
				}
			}
			header("Location:admin.php");
		}
		else
		{
			header("Location:admin.php");
		}
	}
?>