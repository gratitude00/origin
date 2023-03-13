<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        echo "<script>alert('비회원입니다!');</script>";
        echo "<script>window.location.replace('main.php');</script>";
    }
    $connect = mysqli_connect('localhost', 'root', 'mysql', 'logindb');

    $login_id = $_SESSION['username'];
    $pw = $_POST['pw'];
    $hashpass = md5($pw);

    $sql = "SELECT login_pw FROM login where login_id = '$login_id'";
    $res = mysqli_fetch_array(mysqli_query($connect, $sql));

    if($res['login_pw'] == $hashpass) {
        echo "<script>alert('비밀번호가 확인되었습니다');";
        echo "window.location.href='change_info.php';</script>";
    } else {
        echo "<script>alert('비밀번호가 틀렸습니다');";
        echo "window.history.back();</script>";
    }
?>