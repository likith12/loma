<head><link rel="stylesheet" type="text/css" href="styles.css"></head>
<body class="bck">
<?php
if(isset($_POST['namde']))
	{		
		$db1="fac_leave_management";
		$pass1="";
		$link1= new mysqli("127.0.0.1:3316","root",$pass1,$db1);
	
		if (!$link1) {
		    die('Could not connect: ' . mysqli_error($link1));
		}
		else
		{
			$name1=$_POST['id'];
			$quer="select * from leaves where emp_id='".$name1."'";
			$result1=mysqli_query($link1,$quer);
			while($row1=mysqli_fetch_assoc($result1))
			{
				#echo $row['emp_id']."  ".$row['CL']."  ".$row['EL']."  ".$row['AL']."  ".$row['OD'];
				echo "<table border='1' align='center'>";
				echo "<tr><th>Emp ID</th><th>CL</th><th>EL</th><th>AL</th><th>OD</th></tr>";
				echo "<tr><td>".$row1['emp_id']."</td><td>".$row1['CL']."</td><td>".$row1['EL']."</td><td>".$row1['AL']."</td><td>".$row1['OD']."</td></tr>";
				echo "</table>";
			}
		}
	}
?>
<form action="" method="POST">
	<input type="submit" name="ok" value="OK" class="button" />
</form>
</body>
<?php
	if(isset($_POST['ok']))
	{
		header("Location:principal.php");
	}
?>