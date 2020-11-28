<?session_start();

$conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");
$username = $_SESSION['username'];

$query = "SELECT * FROM notifications WHERE username='$username' ORDER BY time_of_posting DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="styles/Notifications.css" type="text/css">
	<link rel="stylesheet" href="styles/icofont/icofont.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">

	<title>Notifications</title>
</head>
  <body>

	<a name="top"></a>

	<div class="navigation">
		<img src="images/logo.png" name="logo">
		<div class="search">
			<form action="\Userpage.php">
				<input type="text" name="searchtext" placeholder="Search...">
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
		<a name="home" href="Userfeed.php" title="Home"><i class="fa fa-home"></i></a>
		<a name="explore" href="#explore" title="Explore"><i class="icofont-telescope"></i></a>
		<a name="notification" href="Notifications.php" title="Notification"><i class="icofont-notification"></i></button>
			<a name="settings" href="Settings.php"><i class="fa fa-cogs"></i></a>

	</div>
	
<?php while($line = mysqli_fetch_assoc($result)): ?>

<?php
$url = "Postpage.php?postid=";
$url1 = (string)$line['post_id'];
$url .= $url1;
$url .= "&feedVisibility=0";
?>
    <a href="<?php echo $url?>">
	<div class="notifs">
		<p><span name="like"><i class="fa fa-heart"></i></span><span name="suku"><?php echo $line['notification']?></span></p>	
	</div>
	</a>
<?php endwhile?>
	<div class="gototop">
		<a href="#top"><i class="fa fa-arrow-circle-up"></i></a>
	</div>

  </body>
</html>