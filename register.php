<?php include("server.php") ?>
<!DOCTYPE HTML>
<html>
<title>Register</title>

<head>

	<link href="styles/register.css" rel="stylesheet" type='text/css'>

</head>

<body>
	<div class="main">
		<h1>REGISTRATION</h1>
		<br>
		<br>
		<center>
			<form action="register.php" name="registerform" method="post" >

				<input type="text" name="firstname" placeholder="First Name" required>
				<input type="text" name="lastname" placeholder="Last Name" required>
				<input type="Email" name="email" placeholder="Email" required>
				<input type="tel" name="phone" pattern="[0-9]{10}" placeholder="Mobile No." required>
				<input type="text" name="dob" placeholder="mm-dd-yyyy" onfocus="(this.type='date')" onblur="(this.type='text')" required>
				<input type="text" name="username" placeholder="Username" required>

				<div class="pwd">
					<input type="password" name="password1" id="name" placeholder="Password" required/>
					<input type="password" name="password2" id="name" placeholder="Confirm Password" required/>
				</div>

				<div class="gender">
					<input type="radio" value="M" id="male" name="gender" required/>
					<label for="male" class="radio" chec>Male</label>
					<input type="radio" value="F" id="female" name="gender" required />
					<label for="female" class="radio">Female</label>
					<input type="radio" value="O" id="other" name="gender" required />
					<label for="other" class="radio">Other</label>
				</div>

				<input type="submit" name="Regbutton" value="SIGN UP">

			</form>

			<p>Already a user? <a href="Login.php">Login</a></p>
		</center>
	</div>
</body>
</html>
