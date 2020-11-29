<?php
session_start();

$string = $_GET['str'];
$conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");
?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="styles/Search.css" type="text/css">
	<link rel="stylesheet" href="styles/icofont/icofont.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">

	<title>Search Results</title>
</head>
  <body>

	<a name="top"></a>

	<div class="navigation">
		<img src="images/logo.png" name="logo">
		<div class="search">
			<form action="Search.php" method="post">
				<input type="text" name="searchtext" placeholder="Search..." required>
				<button type="submit" name="submit"><i class="fa fa-search"></i></button>
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
		<a name="settings" href="Settings.php" title="Settings"><i class="fa fa-cogs"></i></a>

	</div>

	<div class="post">

		<p name="heading"><i class="fa fa-search"></i><span name="text">SEARCH RESULTS FOR "<?php echo $string ?>" ARE :</span></p>
			<hr/>
			<p name="authors">Authors:</p>
<?php
$sql1 = "CALL search_users('$string')";
$result1 = mysqli_query($conn, $sql1);
while($line1 = mysqli_fetch_row($result1)) :
?>
<?php
$url = "Profilepage.php?userProfile=";
$url1 = (string)$line1[0];
$url .= $url1;
?>
			<p name="authorcontent"><a name="oneauthor" href="<?php echo $url?>"><?php echo $line1[0] ?></a></p><br>
<?php endwhile?>
			<hr/>
			<p name="posts">Posts:</p>
<?php
/*$sql1 = "CALL search_users('$string')";
$result1 = mysqli_query($conn, $sql1);
while($line1 = mysqli_fetch_row($result1)) :
?>
<?php
$urlf = "Postpage.php?postid=";
$url1f = (string)$line2[2];
$urlf .= $url1f;
$urlf .= "&feedVisibility=0"; */
?> <!--
			<p name="postcontent"><a name="onepost" href="<?php echo $urlf ?>"><?php echo $line2[2] ?></a></p>
-->
<?php //endwhile?>
	</div>
    
	<div class="gototop">
		<a href="#top"><i class="fa fa-arrow-circle-up"></i></a>
	</div>

  </body>
</html>