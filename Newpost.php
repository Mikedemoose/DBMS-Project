<?php
session_start();

$conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="styles/Newpost.css" type="text/css">
	<link rel="stylesheet" href="styles/icofont/icofont.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">

	<title>Newpost</title>
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
<form method="post">
			<p name="heading"><div class="heading"><input type="text" name="titleText" placeholder="Title" required></div></p>

			<div class="input" ><input type="text" name="contentText" placeholder="Enter Text Here..." required></div>

			<p><button type="submit" name="submit">Submit</button></p>
</form>
<?php
	if(isset($_POST['titleText'])){
		$titleText = mysqli_real_escape_string($conn, $_POST['titleText']);
		$contentText = mysqli_real_escape_string($conn, $_POST['contentText']);

		$query = "INSERT INTO posts(username, title, content, likes, time_of_posting) VALUES('$username', '$titleText', '$contentText', 0, now())";
		mysqli_query($conn, $query);
		$url = "Profilepage.php?userProfile=";
		$url1 = (string)$username;
		$url .= $url1;
		header("Location:$url");
	}
?>

		</div>

			<div class="gototop">
				<a href="#top"><i class="fa fa-arrow-circle-up"></i></a>
			</div>

		</body>
		</html>