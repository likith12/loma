<html>
<head>
	<!--<H1 align="center">FACULTY LEAVE MANAGEMENT SYSTEM</H1>-->
	<H1 align="center">LOGIN</H1>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style type="text/css">
	body
	{
		background-color: black;
		color: white;
	}
	input[type=submit]
	{
		color: white;
	}
	input[type=text]
	{
		color: white;
	}
	input[type=password]
	{
		color:white;
	}
</style>
<body class="loginBck">
<form action="login.php" method="post">
<table align="center">
<tr><td>Username</td><td><input type="text" placeholder="username" name="usr" required/></td></tr>
<tr><td>Password</td><td><input type="password" placeholder="password" name="pass" required /></td></tr>
<tr><td colspan="2"><input type="submit" name="submit" value="submit" class="button" /></td></tr>
</table>
</form>
</body>
</html>