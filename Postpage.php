<?php
session_start();
$_SESSION['postid'] = $_GET['postid'];

$conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");

?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="styles/Postpage.css" type="text/css">
	<link rel="stylesheet" href="styles/icofont.min.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">

	<title>Postpage</title>
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
		<a name="notification" href="#notification" title="Notification"><i class="icofont-notification"></i></button>
			<a name="settings" href="#settings"><i class="fa fa-cogs"></i></a>

		</div>

		<div class="backup">
			<a href="Userfeed.php"><- Back to Feed</a>
		</div>
<?php 

$postID = $_SESSION['postid'];
$userName = $_SESSION['username'] ;

$query = "SELECT * FROM posts WHERE post_id = '$postID'";
$result = mysqli_query($conn, $query);
$query2 = "SELECT* FROM likes WHERE post_id='$postID' and username='$userName'";
$result2 = mysqli_query($conn, $query2);

$line = mysqli_fetch_assoc($result);
$line2 = mysqli_fetch_assoc($result2) ;
if($line2){
	$value="NOPE" ;
}else{
	$value="LIKED" ;
}
?>
		<div class="post">

			<p name="heading"><?php echo $line['title']?>

				<a name="author" href="#shaiju">-<?php echo $line['username']?></a></p>
				<p name="content"><?php echo $line['content']?></p>
				<p name="likoos">
<?php if($value == "NOPE") :?>
					<a name="liking" href="#liking"><i id="myButton" class="fa fa-heart"></i></a>
<?php endif?>
<?php if($value == "LIKED") :?>
					<a name="liking" href="#liking"><i id="myButton" class="fa fa-heart-o"></i></a>
<?php endif?>
					<text name="likecount" id="likecount"><?php echo $line['likes']?></text>
				</p>
				</div>
<script language="JavaScript" type="text/javascript">
    var button = document.getElementById("myButton");
	
    function likeButton(){

		var likeCount = document.getElementById("likecount").innerHTML;

        var newRequest = new XMLHttpRequest();
        var requestText = "";
        newRequest.open('POST', 'functionality.php', true);
        newRequest.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        if(button.className == "fa fa-heart"){
            button.className = "fa fa-heart-o";
			let val = "LIKED";  
            requestText = `likeValue=${val}`;
			document.getElementById("likecount").innerHTML = parseInt(likeCount) - 1;
        }
        else {
            button.className = "fa fa-heart";
            let val = "NOPE";  
            requestText = `likeValue=${val}`;
			document.getElementById("likecount").innerHTML = parseInt(likeCount)+1 ;
        }
        newRequest.onload = function(){
            var response = newRequest.responseText;
        	}
        	newRequest.send(requestText);
        }
        button.addEventListener('click', likeButton);
</script>

			<div class="gototop">
				<a href="#top"><i class="fa fa-arrow-circle-up"></i></a>
			</div>

		</body>
		</html>