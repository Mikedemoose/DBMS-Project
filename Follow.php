<?php
session_start();

$username = $_SESSION['username'];

$conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles/Follow.css" type="text/css">
	<link rel="stylesheet" href="styles/icofont/icofont.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">

	<title>Followers/Following</title>
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
<?php
	if(isset($_GET['value'])){
		$follow = "Following";
	}else{
		$follow = "Followers";
	}

?>
		<div class="header">
			<p name="head"><?php echo $follow?></p>
		</div>
<?php

if($follow == "Followers"){
	$follow = "username";
	$sql = "SELECT follower FROM followers where username = '$username'";
}else{
	$follow = "follower";
	$sql = "SELECT username FROM followers where follower = '$username'";
}

$result = mysqli_query($conn, $sql);
while($line = mysqli_fetch_assoc($result)):
?>


		<div class="post">
<?php
$url = "Profilepage.php?userProfile=";
if($follow == "username")
	$url1 = (string)$line['follower'];
else
	$url1 = (string)$line['username'];
$url .= $url1;
?>
			<p><a href="<?php echo $url?>" name="heading"><span name="username"> <?php echo $url1?></span></a></p>

		</div>	
<?php endwhile ?>

	</div>
	

			<div class="gototop">
				<a href="#top"><i class="fa fa-arrow-circle-up"></i></a>
			</div>

		</body>
		</html>