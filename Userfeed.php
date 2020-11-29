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
<?php
$username = $_SESSION['username'];
$query = "SELECT no_followers, no_following FROM user_list WHERE username='$username'";
$result1 = mysqli_query($conn, $query);
$line1 = mysqli_fetch_assoc($result1);
$followerCount = $line1['no_followers'];
$followingCount = $line1['no_following'];

?>
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

		<div class="lefttab">
			<a name="propic"><i class="fa fa-user-circle"></i></a>
			<p name="username"><?php echo $_SESSION['username']?></p>
			<p ><a name="followers" href="#followers">Followers :</a>
				<text name="followercount"><?php echo $followerCount ?></text></p>
				<p ><a name="following" href="#following">Following :</a>	
					<text name="followingcount"><?php echo $followingCount ?></text></p>	
					<p><a  name="viewprofile" href="Profilepage.php">View Profile</a></p>
				</div>

<?php 
$query = "CALL view_feed('$username')";
$result = mysqli_query($conn, $query);

while($line = mysqli_fetch_assoc($result)):

?>

				<div class="post">

					<p name="heading"><?php echo $line['title'] ?>
<?php
$url = "Profilepage.php?userProfile=";
$url1 = (string)$line['username'];
$url .= $url1;
?>
						<a name="author" href="<?php echo $url?>">article by <?php echo $line['username']?></a></p>
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