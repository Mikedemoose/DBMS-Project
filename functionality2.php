<?php

session_start();

$conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");
$userName = $_SESSION['username'] ;
$userName1 = $_SESSION['username1'];



function follow($conn, $userName1, $userName){
	$query = "CALL follow('$userName1', '$userName')";
    mysqli_query($conn, $query);
}

function unfollow($conn, $userName1, $userName){
    $query = "CALL unfollow('$userName1', '$userName')";
    mysqli_query($conn, $query);
}

$value = strip_tags($_POST['followStatus']);

if($value == "Unfollow"){
    unfollow($conn, $userName1, $userName);
}
else{
    follow($conn, $userName1, $userName);
}

echo $value;

?>