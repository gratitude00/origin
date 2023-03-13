<!DOCTYPE html>
<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        echo "<script>alert('비회원입니다!');</script>";
        echo "<script>window.location.replace('main.php');</script>";
    }

    $conn = mysqli_connect('localhost', 'root', 'mysql', 'logindb');
    $login_id = $_SESSION['username'];
    $sql = "SELECT * FROM login WHERE login_id='$login_id'";
    $res = mysqli_fetch_array(mysqli_query($conn, $sql));
?>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+KR:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="mypagestyle.css">
</head>
<body>
    <section class = "form">
        <p class='hh'>My Page</p>
        <table align=center width=auto border=0 cellpadding=2>
            <tr>
                <th>ID</th>
                <td><?=$res['login_id']?></td>
            </tr>
            <tr>
                <th>NAME</th>
                <td><?=$res['name']?></td>
            </tr>
            <tr>
                <th>E-MAIL</th>
                <td><?=$res['email']?></td>
            </tr>
            <tr>
                <th>ADDRESS</th>
                <td><?=$res['address']?></td>
            </tr>
        </table>
        <div class = "btn-area">
            <button type="button" id="" style="margin-top: 30px" onclick="location.href='check_pw.php';">내 정보 수정</button>
        </div>
        <div class = "btn-area">
            <button type="button" id="signup_btn" onclick="location.href='main.php';">메인으로</button>
        </div>
    </section>
</body>
</html>