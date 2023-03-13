<!DOCTYPE html>
<?php  
session_start();
?>
<html lang = "ko">
<head>
	<meta charset = "UTF-8">
	<title>Login</title>
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+KR:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
<head>
<body>
	<section class = "form">
	<p class='hhh'>Login</p>

	<form method = "POST" action = "logindb.php">
		<div class = "int-area">
			<input type = "text" name = "id" id = "id"
			autocomplete = "off" required>
			<label for="id" style="color: white;">ID</label>
		</div>
		<div class = "int-area">
			<input type = "password" name = "pw" id = "pw"
			autocomplete="new-password" required>
			<label for = "pw" style="color: white;">PASSWORD</label>
		</div>

		<div class = "btn">
			<button type = "submit" id = "btn" style="font-size: 25px;">login</button>
		</div>
	</form>
	<div style="display: flex; justify-content: center; align-items: center;">
		<div class="caption" style="margin-right: 15px;">
			<a href="signup.php" style="font-size: 20px; color: #F2F2F2;">회원가입</a>
		</div>
		<div class="caption" style="margin-left: 15px;">
			<a href="main.php" style="font-size: 20px; color: #F2F2F2;">메인으로</a>
		</div>
	</div>
	</section>
</body>
</html>

