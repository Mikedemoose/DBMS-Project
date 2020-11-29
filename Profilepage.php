<?php
/*if(!isset($_SESSION['username'])){
	header("Location:Login.php");
}*/
session_start();

$conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");
$username = $_SESSION['username'];
$username1 = isset($_GET['userProfile'])? $_GET['userProfile'] : $username;

if($username1 != $username){
	$_SESSION['username1'] = $username1;
}

$query = "SELECT * FROM user_list WHERE username='$username1'";
$result = mysqli_query($conn, $query);
$line = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="styles/Profilepage.css" type="text/css">
	<link rel="stylesheet" href="styles/icofont/icofont.min.css">
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
		<a name="home" href="Userfeed.php" title="Home"><i class="fa fa-home"></i></a>
		<a name="explore" href="#explore" title="Explore"><i class="icofont-telescope"></i></a>
		<a name="notification" href="Notifications.php" title="Notification"><i class="icofont-notification"></i></button>
			<a name="settings" href="Settings.php"><i class="fa fa-cogs"></i></a>

		</div>

		<div class="lefttab">
			<a name="propic"><i class="fa fa-user-circle"></i></a>
			<p name="username"><?php echo $username1?></p>
<?php
	$sql = "SELECT find_if_following('$username1', '$username')";
	$result = mysqli_query($conn, $sql);
	$line1 = mysqli_fetch_row($result);
	if($line1[0] != 0){
		$follow = "Unfollow";
	}else{
		$follow = "Follow";
	}
?>
<?php if($username == $username1) : ?>
			<p ><a name="followers" href="#followers">
				Followers :</a>
				<text name="followercount"><?php echo $line['no_followers']?></text></p>
				<p ><a name="following" href="#following">Following :</a>	
					<text name="followingcount"><?php echo $line['no_following']?></text></p>	
<?php else :?>
			<p ><a name="followers" href="#followers">Followers :</a>
				<text  id = "followercount" name="followercount"><?php echo $line['no_followers']?></text></p>
				<p ><a name="following" href="#following">Following :</a>	
					<text id = "followingcount" name="followingcount"><?php echo $line['no_following']?></text></p>
					<p><button id="followButton" name="follow"><?php echo $follow ?></button></p>
<?php endif?>
<script language="JavaScript" type="text/javascript">
    var button = document.getElementById("followButton");
	button.onclick = followButton;
    function followButton(){
		var followerCount = document.getElementById("followercount").innerHTML;
        var newRequest = new XMLHttpRequest();
        var requestText = "";
		var followStatus = document.getElementById("followButton").innerHTML;
        newRequest.open('POST', 'functionality2.php', true);
        newRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		newRequest.onload = function(){
            var response = newRequest.responseText;
        }
        if(followStatus == "Follow"){
            document.getElementById("followButton").innerHTML = "Unfollow";
			let val = "Follow";  
            requestText = `followStatus=${val}`;
			document.getElementById("followercount").innerHTML = parseInt(followerCount) + 1;
        }
        else {
            document.getElementById("followButton").innerHTML = "Follow";
            let val = "Unfollow";  
            requestText = `followStatus=${val}`;
			document.getElementById("followercount").innerHTML = parseInt(followerCount) - 1;
        }
        	newRequest.send(requestText);
    }
</script>



	</div>

<?php if($username == $username1):?>
		<div class="postnew">
			<button name="newpost" href="newpost.html"><i class="fa fa-plus-circle"></i> New Post</button>	
		</div>
<?php endif?>
<?php 
$query = "SELECT * FROM posts WHERE username='$username1'";
$result = mysqli_query($conn, $query);

while($line = mysqli_fetch_assoc($result)):

?>
				<div class="post">

					<p name="heading"><?php echo $line['title']?>
<?php if($username != $username1) :?>
						<a name="author" >-<?php echo $line['username']?></a></p>
<?php elseif($username == $username1) :?>
						<a name="author" >-You</a></p>
<?php endif?>
<?php
$url = "Postpage.php?postid=";
$url1 = (string)$line['post_id'];
$url .= $url1;
$url .= "&feedVisibility=0";
?>
						<p><a name="linktopost" href="<?php echo $url?>">See Full Post</a>
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