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
        <form method = "post" action = "change_info_ok.php">
        <table align=center width=auto border=0 cellpadding=2>
            <tr>
                <th>ID</th>
                <td><?=$res['login_id']?></td>
            </tr>
            <tr>
                <th>PASSWORD</th>
                <td><input name = "pw" class="t_box" type = "password" placeholder="PASSWORD" autocomplete="new-password"/></td>
            </tr>
            <tr>
                <th>NAME</th>
                <td><input name = "name" class="t_box" type = "text" placeholder="NAME"/></td>
            </tr>
            <tr>
                <th>E-MAIL</th>
                <td><input name = "email" class="t_box" type = "text" placeholder="E-MAIL"/></td>
            </tr>
            <tr>
                <th>ADDRESS</th>
                <td><input name = "address" class="t_box" type = "text" placeholder="ADDRESS"/></td>
            </tr>
        </table>
        <div class = "btn-area">
            <button type="submit">저장</button>
        </div>
    </section>
</body>
</html>