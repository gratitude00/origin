<!DOCTYPE html>
<?php session_start(); ?>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>Main</title>
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+KR:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<section class = "form">
	<p class='hh'>MAIN</p>
	<?php
	if(!isset($_SESSION['username'])) {
	?>
		<div class = "btn-area" style = "display: flex; text-align: center;" >
			<div style="margin-top: 15px; margin-right: 30px; margin-left: 20px;">
				<button type="button" style="font-size: 25px;" onclick="location.href='login.php';">로그인</button>
			</div>
			<div style="margin-top: 15px; margin-left: 20px;">
				<button type="button" style="font-size: 25px;" onclick="location.href='list.php';">게시판</button>
			</div>
			<div style="margin-top: 15px; margin-left: 50px;">
				<button type="button" style="font-size: 25px;" onclick="location.href='qna.php';">문의게시판</button>
			</div>
		</div>
	<?php } else {
		$login_id = $_SESSION['username'];
		$connect = mysqli_connect('localhost', 'root', 'mysql', 'logindb');
		$sql = "SELECT * FROM login where login_id = '$login_id' ";
		$res = mysqli_fetch_array(mysqli_query($connect, $sql));
		$name = $res['name'];
		$_SESSION['name'] = $res['name'];
		echo "<span class='notice'>반갑습니다! $name 님</span>";?>
		<div class = "btn-area" style = "margin-top: 15px; display: flex; text-align: center; margin-left: 60px;" >
			<div style="margin-top: 60px; margin-right: 50px;">
				<button type="button" style="font-size: 25px;" onclick="location.href='logout.php';">로그아웃</button>
			</div>
			<div style="margin-top: 60px; margin-left: 20px;">
				<button type="button" style="font-size: 25px;" onclick="location.href='list.php';">게시판</button>
			</div>
		</div>
		<div class = "btn-area" style = "margin-top: 15px; display: flex; text-align: center; margin-left: 60px;" >
			<div style="margin-top: 20px; margin-right: 50px;">
				<button type="button" style="font-size: 25px;" onclick="location.href='mypage.php';">마이페이지</button>
			</div>
			<div style="margin-top: 20px; margin-left: 20px;">
				<button type="button" style="font-size: 25px;" onclick="location.href='qna.php';">문의게시판</button>
			</div>
		</div>
	<?php }; ?>
</section>
</body>
</html>
