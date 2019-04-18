
		<?php
			
			if(isset($_POST['register']))
			{
				$fname=$_POST['fname'];
				$fID=$_POST['fID'];
				$fBranch=$_POST['fbranch'];
				$fType=$_POST['type'];
				$des=$_POST['desig'];
				$femail=$_POST['email'];
				$mobile=$_POST['mob_no'];
				$DOJ=$_POST['DOJ'];
				$password=$_POST['pass'];


				$link=new mysqli("localhost:3316","root","","fac_leave_management");
				if($link)
				{
					$in="insert into employee values ('".$fID."','".$fname."','".$fBranch."','".$fType."','".$des."','".$femail."','".$mobile."','".$DOJ."')";
					$login="insert into login values ('".$fID."','".$password."')";
					mysqli_query($link,$in);
					mysqli_query($link,$login);
				}	

				else
				{
					echo "linking failed";
				}
				mysqli_close($link);
			}
		?>

