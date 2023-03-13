<!DOCTYPE html>
<?php session_start(); ?>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+KR:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<script>
		function check_id() {
			var userid = document.getElementById("uid").value;
			if(userid)
			{
				url = "check.php?userid="+userid;
				window.open(url,"IDcheck", "width=400, height=200");
			}
		}
		function address() {
			url = "address.php";
			window.open(url,"addr",'width=500, height = 400,scrollbars=no, resizable = no')
		}
		function decide(){ //이 아이디 사용
			document.getElementById("decide_id").value = document.getElementById("uid").value
			document.getElementById("signup_btn").disabled = false
			document.getElementById("check_button").value = "다른 ID로 변경"
			document.getElementById("check_button").setAttribute("onclick", "change()")
			var userid = document.getElementById("uid").value
			return userid
		}
		function change(){ //다른 아이디 사용
			document.getElementById("uid").disabled = false
			document.getElementById("uid").value = ""
			document.getElementById("signup_btn").disabled = true
			document.getElementById("check_button").setAttribute("onclick", "check_id()")
		}
	</script>

</head>
<body>
	<section class="form">
		<p class='hhhh'>Sign Up</p>
		<form method="POST" action="signupdb.php">
			<div class = "int-area">
					<input type = "text" name = "sign_id" id="uid" autocomplete="off" required>
					<label for="id">ID</label>
					<input type="hidden" name="decide_id" id="decide_id">
					<p><span id="decide" style="color:#fff; margin-left: 10px; margin-top: 5px">아이디 중복 체크해주세요</span></p>
					<button class = "chkbtn" id="check_button" onclick="check_id()">중복 확인</button>
			</div>
			<div class = "int-area">
				<input type = "password" name = "sign_pw"
				autocomplete="new-password" required>
				<label for="pw">PASSWORD</label>
			</div>
			<div class = "int-area">
				<input type = "text" name = "sign_name"
				autocomplete = "off" required>
				<label for="name">NICKNAME</label>
			</div>
			<div class = "int-area">
				<input type = "text" name = "sign_email"
				autocomplete = "off" required>
				<label for="email">E-MAIL</label>
			</div>
			<div style="width: width: 400px; position: relative; ">
				<h4 style="margin-top: 30px; margin-left: 10px; color: white;">ADDRESS (선택)</h4>
				<input type = "text" name = "sign_addr" id = "addr"
				onclick="address()"; autocomplete="off" style="width: 100%; padding: 20px 10px 10px; background-color: transparent; border: none; border-bottom: 1px solid #555; font-size: 18px; color: #fff; outline: none;">
				<label for="addr" style="position: absolute; left: 10px; top: 15px; font-size: 18px; color: #555; transition: all .5s ease;"></label>
			</div>
			<div class = "area">
				<button type="submit">회원가입</button>
			</div>
			<div class = "area">
				<button type="button" id="signup_btn" onclick="location.href='login.php';">로그인 페이지</button>
			</div>
		</form>
		</section>
</body>
</html>


