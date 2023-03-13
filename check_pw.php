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
        <p class='hh'>Check Your Password</p>
        <form method = "post" action = "check_pw_ok.php" autocomplete="off">
        <table align=center width=auto border=0 cellpadding=2>
            <tr>
                <th>ENTER THE CURRENT PASSWORD</th>
                <td><input name = "pw" class="box" type = "password" autocomplete="new-password"/></td>
            </tr>
        </table>
        <div class = "btnarea">
            <button type="submit">CONFIRM PASSWORD</button>
        </div>
    </section>
</body>
</html>