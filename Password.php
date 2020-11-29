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
		<a name="explore" href="#explore" title="Explore"><i class="icofont-telescope"></i></a>
		<a name="notification" href="Notifications.php" title="Notification"><i class="icofont-notification"></i></button>
		<a name="settings" href="Settings.php"><i class="fa fa-cogs"></i></a>

	</div>
<?php
	if(isset($_GET['error'])):
?>
	<div id="passError" style="display:none"><?php $_GET['error']?></div>
<?php endif ?>
<script language="JavaScript" type="text/javascript">

		var errorType = document.getElementById('passError').innerHTML ;
		errorType = parseInt(errorType);
		if(errorType == 1){
			alert("Incorrect Password");
		}
		else if(errorType == 2){
			alert("passwords do not match");
		}

</script>
   <div class="post">
   		
   		<p name="heading"><i class="icofont-settings-alt"></i><span name="text">Change Password</span></p>

		<div class="pwd">
		<form method='post'>
			<p><input type="password" name="oldpwd" id="name" placeholder="Current Password" required/></p>
			<p><input type="password" name="newpwd" id="name" placeholder="New Password" required/></p>
			<p><input type="password" name="cnewpwd" id="name" placeholder="Confirm New Password" required/></p>
			<input type="submit" value="change Password" name="submit">
		</form>
		</div>
<?php
	if(isset($_POST['submit'])){
		$oldPass = md5(mysqli_real_escape_string($conn, $_POST['oldpwd']));
		if($oldPass != $password){
			header("Location:Password.php?error=1");
		}else{
			$newPass = md5(mysqli_real_escape_string($conn, $_POST['newpwd']));
			$confirmPass = md5(mysqli_real_escape_string($conn, $_POST['cnewpwd']));
			if($newPass != $confirmPass){
				header("Location:Password.php?error=2");
			}else{
				$query5 = "UPDATE user_list SET pwd = '$newPass' WHERE username = '$username'";
				mysqli_query($query5);
				header("Location:Userfeed.php?message=1");
			}
		}
	}
?>
	
	</div>

  </body>
</html>