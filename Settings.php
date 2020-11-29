<?php
session_start();
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="styles/Settings.css" type="text/css">
	<link rel="stylesheet" href="styles/icofont/icofont.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">

	<title>Settings</title>
</head>
  <body>

	<a name="top"></a>

	<div class="navigation">
		<img src="images/logo.png" name="logo">
		<div class="search">
			<form method="post">
				<input type="text" name="searchtext" placeholder="Search..." required>
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
<?php
if(isset($_POST['searchtext'])){
	$url = "Search.php?str=";
	$str = (string)$_POST['searchtext'];
	$url .= $str ;
	header("Location:$url");
}
?>
		</div>
		<a name="home" href="Userfeed.php" title="Home"><i class="fa fa-home"></i></a>
		<a name="explore" href="Explore.php" title="Explore"><i class="icofont-telescope"></i></a>
		<a name="notification" href="Notifications.php" title="Notification"><i class="icofont-notification"></i></button>
			<a name="settings" href="Settings.php"><i class="fa fa-cogs"></i></a>

	</div>
    
    <a href="Change.html">
	<div class="changepwd">
		<a href="Password.php">
		<p><span name="pwd"><i class="fa fa-lock"></i></span><span name="pwdtext"> Change Password</span></p>	
		</a>
	</div>
	</a>

	<a href="Settings.php?logout=1">
	<div class="signout">
		<p><span name="door"><i class="icofont-logout"></i></span><span name="logout">Log Out</span></p>	
	</div>
<?php

if(isset($_GET['logout'])){
	session_destroy();
	header("Location:Login.php");
}

?>
	</a>
  </body>
</html>