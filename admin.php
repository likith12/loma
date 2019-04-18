<!--ADMIN page-->
<html>
<head><H1 align="center">ADMIN PAGE</H1><link rel="stylesheet" type="text/css" href="styles.css"></head>
<title>ADMIN</title>
<?php session_start() ?>
<h4 align="right"> <?php echo $_SESSION['empid'] ?></h4>
<body class="bck">
	<form action="" method="POST">
		<input type="submit" name="check" value="Check Leaves" class="button">
		<input type="submit" name="apply" value="Apply Leave" class="button">
		<input type="submit" name="leaves" value="Forward Leaves" class="button">
		<input type="submit" name="selupdate" value="Accepted Leaves" class="button">
		<input type="submit" name="addfac" value="Add Faculty" class="button">
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
			<table border="2">
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
		$q="select * from applies where leave_id in (select distinct leave_id from forwards_to_admin)";
		$record=mysqli_query($link,$q);
		$row;
		?>
		<div>
			<form action="forToP.php" method="POST" id="clist">
				<?php
				while($row=mysqli_fetch_assoc($record))
				{
					echo '<input type="'.'checkbox'.'" name="'.'leavelist[]'.'" value="'.$row['leave_id'].'"/>'; 	
                    echo "<span>";
                    echo $row['leave_id'].' '.$row['emp_id'].' '.$row['Fdate'].' '.$row['Tdate'].' '.$row['Reason'];
                	echo "</span>";
                    echo "<br/>";
                               
				}
				?>
		
				<input type="submit" name="forward_to_principal" value="Forward" class="button" />
			</form>
		</div>

		<?php
		mysqli_free_result($record);
	}
	else
	{
		echo "Unsuccessful";
	}
}
else if (isset($_POST['selupdate'])) {
	?>
	<style type="text/css">
		div 
		{ 
		  color: black; 
		  background-color: transparent; 
		  margin: 2px;  
		} 
	</style>
	<?php

	$link1=new mysqli("localhost:3316","root","","fac_leave_management");
	if($link1)
	{
		$getq="select leave_id from principal where status='YES'";
		$resq=mysqli_query($link1,$getq);
		?>
		<div>
			<form action="update.php" method="POST" id="clist">
				<?php
				while($row=mysqli_fetch_assoc($resq))
				{
					echo '<input type="'.'checkbox'.'" name="'.'accleavelist[]'.'" value="'.$row['leave_id'].'"/>'; 	
                    echo "<span>";
                    echo $row['leave_id'];
                	echo "</span>";
                    echo "<br/>";
                               
				}
				?>
		
				<input type="submit" name="update" value="update" class="button" />
			</form>
		</div>
		<?php
	}
}
else if(isset($_POST["addfac"]))
{

?>
	<html>
		<head>
			<title>Register</title>
			<link rel="stylesheet" type="text/css" href="styles.css">
		</head>
		<body class="bck">
			<h1 align="center">REGISTRATION</h1>
			<form action="register.php" method="POST" align="center">	
				<table align="center" border="1">
					<tr><td>Name</td><td><input type="text" name="fname" pattern="{1,}" title="Name should contain ALPHABETS ONLY" required/></td></tr>
					<tr><td>Employee ID</td><td><input type="text" name="fID" pattern="ANIL[0-9][0-9][0-9][0-9]" maxlength="8" placeholder="ANIL****" required/></td></tr>
					
					<tr><td>Branch</td><td><select name="fbranch">
											<option>--select--</option>
											<option value="CSE">CSE</option>
											<option value="ECE">ECE</option>
											<option value="EEE">EEE</option>
											<option value="MECH">MECH</option>
											<option value="CIV">CIVIL</option>
											<option value="CHEM">CHEMICAL</option>
											<option value="IT">IT</option>
											<option value="ENG">ENGLISH</option>
											<option value="PHY">PHYSICS</option>
											<option value="CHM">CHEMISTRY</option>
											<option value="MAT">MATHEMATICS</option>
											<option value="ADM">ADMINISTRATIVE</option>
									   </select></td>
					<tr><td>Type</td><td><input type="radio" name="type" value="T" required/>Teaching<input type="radio" name="type" value="NT" required/>Non-Teaching</td></tr>
					<tr><td>Designation</td><td><input type="text" name="desig" required/></td></tr>
					<tr><td>E-mail ID</td><td><input type="email" name="email" required/></td></tr>
					<tr><td>Mobile No</td><td><input type="text" name="mob_no" minlength="10" maxlength="10" pattern="[0-9]{10,}" required/></td></tr>
					<tr><td>Date of Joining</td><td><input type="date" name="DOJ" required/></td></tr>
					<tr><td>Password</td><td><input type="password" name="pass" required/></td></tr>
				</table>
				<table align="center"><tr><td><input type="submit" name="register" value="REGISTER" align="center" class="button"></td></tr></table>			
			</form>
		</body>
	</html>

<?php
}
else if(isset($_POST["logout"]))
{
	unset($_SESSION['empid']);
	header("Location: index.php");
}
?>