<?php

session_start();

if(isset($_SESSION['username'])){
  $_SESSION['alreadyloggedin'] = "You have to logout to register another user";
  header("Location:Userfeed.php");
}

$errors = array();

if(isset($_POST["username"])){
  $username = $_POST["username"];
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $dob = $_POST["dob"];
  $gender = $_POST["gender"];
  $password1 = $_POST["password1"];
  $password2 = $_POST["password2"];


  if(empty($username) || empty($firstname) || empty($lastname) || empty($gender) || empty($email) || empty($phone) || empty($dob) || empty($password1) || empty($password2)){
    array_push($errors, "No field must be left empty");
  }
  else if($password1 !== $password2)
    array_push($errors, "Passwords do not match");

  $conn = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");
  $query = "SELECT * FROM user_list WHERE username = '$username' OR email_id = '$email' LIMIT 1";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  if($row != NULL){
    if($row['username'] == $username)
      array_push($errors, "Username is not available.");
    else array_push($errors, "This email-id is already registered");
  }
}

if(isset($_POST['username']) && count($errors) == 0){
  $password = md5($password1);
  $insert = "INSERT INTO user_list VALUES('$username', '$firstname', '$lastname', '$gender', '$email', '$phone', '$password')";
  mysqli_query($conn, $insert);
  header("Location:Login.php");
}

//LOGIC FOR LOGIN PAGE

$errors = array();
if(isset($_POST['E-mail'])){

  $conn1 = mysqli_connect("localhost", "root", "Root123", "DBMS_Project");

  $login_cred_email = mysqli_real_escape_string($conn1, $_POST['E-mail']);
  $login_cred_pwd = md5(mysqli_real_escape_string($conn1, $_POST['passwordlogin']));
  if(empty($login_cred_email) || empty($login_cred_pwd)){
    array_push($errors, "No field must be left empty");
  }

  $query = "SELECT username, email_id, pwd FROM user_list WHERE email_id='$login_cred_email'";
  $result = mysqli_query($conn1, $query);
  $line = mysqli_fetch_assoc($result);
  if($line){
    if($login_cred_pwd != $line['pwd']){
        array_push($errors, "Wrong password. Try Again.");
      }
    else{
      $_SESSION['username'] = $line['username'];
      $_SESSION['success'] = "You have logged in successfully";
      header("Location:Userfeed.php");
    }
  }else{
    array_push($errors, "Email is not registered. ");
  }
}
 ?>
