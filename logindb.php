<!DOCTYPE html>
<?php
session_start();?>
<html>
<head>
	<meta charset = "utf-8">
	<title></title>
	<style>
	body {
		background-color:black;
		}
	</style>
</head>
<body>
<section class = "form">
<?php
$host = 'localhost';
$user = 'root';
$pw = 'mysql';
$db_name = 'logindb';

$mysqli = new mysqli($host, $user, $pw, $db_name);

$username = $_POST['id'];
$userpass = $_POST['pw'];
$userpw = md5($userpass);

$q = "select * from login where login_id = '$username' and \n login_pw = '$userpw'";
$result = $mysqli->query($q);
$row = $result->fetch_array(MYSQLI_ASSOC);

if($row){
	$_SESSION['username'] = $row['login_id'];
	$_SESSION['name'] = $row['name'];
	echo "<script>alert('로그인 되었습니다!');</script>";
	echo "<script>window.location.replace('main.php')</script>";
	exit;
}
else {
	echo "<script>alert('Invalid Username Or Password'); history.back()</script>";
	exit;
} ?>
<meta http-equiv="refresh" content = "0;url=main.php">
</section>
</body>
</html>
