<?php
session_start();
$conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");

$username = $_SESSION['username'] ;
$query = "SELECT * FROM user_list WHERE username='$username'";
$result = mysqli_query($conn, $query);
$line = mysqli_fetch_assoc($result);

$password = md5($line['password']);

?>
<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="styles/Password.css" type="text/css">
	<link rel="stylesheet" href="styles/icofont/icofont.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">

	<title>Change Password</title>
</head>
  <body>

	<a name="top"></a>

	<div class="navigation">
		<img src="images/logo.png" name="logo">
		<div class="search">
			<form method="post">
				<input type="text" name="searchtext" placeholder="Search...">
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
		<a name="explore" href="#explore" title="Explore"><i class="icofont-telescope"></i></a>
		<a name="notification" href="Notifications.php" title="Notification"><i class="icofont-notification"></i></button>
		<a name="settings" href="Settings.php"><i class="fa fa-cogs"></i></a>

	</div>
    
   <div class="post">
   		
   		<p name="heading"><i class="icofont-settings-alt"></i><span name="text">Change Password</span></p>

		<div class="pwd">
			<p><input type="password" name="oldpwd" id="name" placeholder="Current Password" required/></p>
			<p><input type="password" name="newpwd" id="name" placeholder="New Password" required/></p>
			<p><input type="password" name="cnewpwd" id="name" placeholder="Confirm New Password" required/></p>
		</div>
	
	</div>

  </body>
</html>