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

$sign_name=$_POST['sign_name'];
$sign_id=$_POST['decide_id'];
$sign_pw=$_POST['sign_pw'];
$sign_email = $_POST['sign_email'];
$hashpass = md5($sign_pw);
$address = $_POST['sign_addr'];

$sql = "INSERT INTO login(login_id, login_pw, name, email, address) VALUES ('$sign_id','$hashpass','$sign_name','$sign_email','$address')";

if(!isset($_POST['sign_name'])||!isset($_POST['sign_id'])||!isset($_POST['sign_pw'])||!isset($_POST['sign_email'])) {
	echo "<script>alert('Unregistered User Of Wrong Access');
	      history.back();</script>";
	exit;
} else {
	$mysqli->query($sql);
	echo "<script>alert('회원가입이 완료되었습니다');</script>";
	echo "<script>window.location.replace('login.php')</script>";
}

?>
<meta http-equiv="refresh" content="0;url=main.php">