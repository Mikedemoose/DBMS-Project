<?php include("server.php") ?>
<!DOCTYPE HTML>
<html>
<title>Login</title>

<head>

	<link href="styles/Login.css" rel="stylesheet" type='text/css'>

</head>

<body>

	<div class="main">
		<h1>LOGIN</h1>
		<br>
		<br>
		
		<center>
			<form action="Login.php" method="post" >

				<input type="Email" name="E-mail" placeholder="Email" required>
				<div class="pwd">
				<input type="password" name="passwordlogin" id="name" placeholder="Password" required/>
				</div>
				<input type="submit" name="Regbutton" value="SIGN IN">

			</form>

			<p>New user? <a href="register.php">Register</a></p>
		</center>
	</div>
</body>
</html>
