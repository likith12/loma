<!--`PRINCIPAL page-->
<html>
<head><H1 align="center">PRINCIPAL PAGE</H1><link rel="stylesheet" type="text/css" href="styles.css"></head>
<title>PRINCIPAL</title>
<?php session_start() ?>
<h4 align="right"> <?php echo $_SESSION['empid'] ?></h4>
<body class="bck">
	<form action="" method="POST">
		<input type="submit" name="check" value="Check Leaves" class="button">
		<input type="submit" name="checkother" value="Check for Specific Emp" class="button">
		<input type="submit" name="apply" value="Apply Leave" class="button">
		<input type="submit" name="leaves" value="Approve Leave" class="button">
		<input type="submit" name="logout" value="Logout" class="button">
	</form>
	
</body>
</html>
<?php
if(isset($_POST["check"]))
{

$name=$_SESSION['empid'];
$db="fac_leave_management";
	$pass="";
	$link= new mysqli("127.0.0.1:3316","root",$pass,$db);
	
	if (!$link) {
	    die('Could not connect: ' . mysqli_error($link));
	}
	else
	{
		$q="select * from leaves where emp_id='".$name."'";
		$result=mysqli_query($link,$q);
		while($row=mysqli_fetch_assoc($result))
		{
			#echo $row['emp_id']."  ".$row['CL']."  ".$row['EL']."  ".$row['AL']."  ".$row['OD'];
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
		<tr><td colspan="2"><input type="submit" name="submit" value="submit" class="button"></td></tr>
		</table>
	</form>
</body>
</html>
<?php
}
else if(isset($_POST["leaves"]))
{?>
<style type="text/css">
	div 
	{ 
	  color: black; 
	  background-color: transparent; 
	  margin: 2px;  
	} 
</style>
<?php
	$link= new mysqli("localhost:3316","root","","fac_leave_management");
	if($link)
	{
		$q="select * from applies where leave_id in (select distinct leave_id from forwards)";
		$record=mysqli_query($link,$q);
		$row;
		?>
		<div>
			<form action="accept.php" method="POST" id="clist">
				<?php
				while($row=mysqli_fetch_assoc($record))
				{
					echo '<input type="'.'checkbox'.'" name="'.'accleavelist[]'.'" value="'.$row['leave_id'].'"/>'; 	
                    echo "<span>";
                    echo $row['leave_id'].' '.$row['emp_id'].' '.$row['Fdate'].' '.$row['Tdate'].' '.$row['Reason'];
                	echo "</span>";
                    echo "<br/>";
                               
				}
				?>
		
				<input type="submit" name="accepted_Leaves" value="Forward" class="button" />
			</form>
		</div>

		<?php
		mysqli_free_result($record);
	}
	else
	{
		echo "Unsuccessful";
	}
?>
<?php
}
else if(isset($_POST["logout"]))
{
	unset($_SESSION['empid']);
	header("Location: index.php");
}
else if(isset($_POST['checkother']))
{?>
		<form action="checkspec.php" method="POST">
			<input type="text" name="id" placeholder="Enter employee ID" autocomplete="off">
			<input type="submit" name="namde" value="checkspec" class="button">
		</form>

<?php
}
?>