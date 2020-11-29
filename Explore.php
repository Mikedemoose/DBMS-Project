<?php
session_start();

$username = $_SESSION['username'];

$conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");
?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="styles/Explore.css" type="text/css">
	<link rel="stylesheet" href="styles/icofont/icofont.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

	<title>Explore</title>
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

				<div class="post">
<?php 

$sql = "SELECT * FROM posts ORDER BY likes DESC";
$result = mysqli_query($conn, $sql);
while($line = mysqli_fetch_assoc($result)):?>

					<p name="heading"><?php echo $line['title']?>
<?php
$url = "Profilepage.php?userProfile=";
$url1 = (string)$line['username'];
$url .= $url1;
?>
						<a name="author" href="<?php echo $url?>"><?php echo $line['username']?></a></p>
<?php
$url = "Postpage.php?postid=";
$url1 = (string)$line['post_id'];
$url .= $url1;
$url .= "&feedVisibility=0";
?>
						<p><a href="<?php echo $url?>" name="linktopost">See Full Post</a>
							<text name="likecount"><?php echo $line['likes']?></text>
							<i class="fa fa-heart"></i>
						</p>
<?php endwhile?>
					</div>
					<div class="gototop">
						<a href="#top"><i class="fa fa-arrow-circle-up"></i></a>
					</div>

				</body>
				</html>