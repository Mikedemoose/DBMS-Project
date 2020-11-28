<?php
/*if(!isset($_SESSION['username'])){
	header("Location:Login.php");
}*/
session_start();

$conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");

?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="styles/Userfeed.css" type="text/css">
	<link rel="stylesheet" href="styles/icofont/icofont.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

	<title>Userfeed</title>
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
		<a name="home" href="Userfeed.html" title="Home"><i class="fa fa-home"></i></a>
		<a name="explore" href="#explore" title="Explore"><i class="icofont-telescope"></i></a>
		<a name="notification" href="Notifications.php" title="Notification"><i class="icofont-notification"></i></button>
			<a name="settings" href="Settings.php"><i class="fa fa-cogs"></i></a>

		</div>

		<div class="lefttab">
			<a name="propic"><i class="fa fa-user-circle"></i></a>
			<p name="username"><?php echo $_SESSION['username']?></p>
			<p ><a name="followers" href="#followers">Followers :</a>
				<text name="followercount">0</text></p>
				<p ><a name="following" href="#following">Following :</a>	
					<text name="followingcount">0</text></p>	
					<p><a  name="viewprofile" href="#profile">View Profile</a></p>
				</div>

<?php 

$query = "SELECT * FROM posts ORDER BY time_of_posting DESC";
$result = mysqli_query($conn, $query);

while($line = mysqli_fetch_assoc($result)):

?>

				<div class="post">

					<p name="heading"><?php echo $line['title'] ?>
						<a name="author" href="#shaiju">-<?php echo $line['username']?></a></p>
<?php
$url = "Postpage.php?postid=";
$url1 = (string)$line['post_id'];
$url .= $url1;
?>
						<p><a href="<?php echo $url?>" name="linktopost">See Full Post</a>
							<text name="likecount"><?php echo $line['likes'] ?></text>
							<i class="fa fa-heart"></i>
						</p>

					</div>
<?php endwhile ?>
					<div class="gototop">
						<a href="#top"><i class="fa fa-arrow-circle-up"></i></a>
					</div>

				</body>
				</html>