<?php

session_start();

$conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");
$userName = $_SESSION['username'] ;
$postId = $_SESSION['postid'] ;


function like($conn, $post_id, $userName){
	$query = "INSERT INTO likes values('$post_id', 'LIKED', '$userName')";
    mysqli_query($conn, $query);
}

function unlike($conn, $post_id, $userName){
    $query = "call unlike('$post_id', '$userName')";
    mysqli_query($conn, $query);
}

$value = strip_tags($_POST['likeValue']);

if($value == "LIKED"){
    unlike($conn, $postId, $userName);
}
else{
    like($conn, $postId, $userName);
}

echo $value;

?>