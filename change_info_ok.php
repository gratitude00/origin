<?php
    session_start();

    if(!isset($_SESSION['username'])) {
        echo "<script>alert('비회원입니다!');</script>";
        echo "<script>window.location.replace('main.php');</script>";
    }
    $connect = mysqli_connect('localhost', 'root', 'mysql', 'logindb');

    $login_id = $_SESSION['username'];
    $pw = $_POST['pw'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $hashpass = md5($pw);
    $sql = "SELECT * FROM login where login_id = '$login_id' ";

    if($res = mysqli_fetch_array(mysqli_query($connect, $sql))) {
        if($_POST['pw'] != NULL) {
            $new_pw = $hashpass;
        } else {
            $pw_sql = "SELECT login_pw FROM login WHERE login_id = '$login_id'";
            $row = mysqli_fetch_array(mysqli_query($connect, $pw_sql));
            $new_pw = $row[0];
        }
        if($_POST['name'] != NULL) {
            $new_name = $_POST['name'];
        } else {
            $name_sql = "SELECT name FROM login WHERE login_id = '$login_id'";
            $row = mysqli_fetch_array(mysqli_query($connect, $name_sql));
            $new_name = $row[0];
        }
        if($_POST['address'] != NULL) {
            $new_address = $_POST['address'];
        } else {
            $address_sql = "SELECT address FROM login WHERE login_id = '$login_id'";
            $row = mysqli_fetch_array(mysqli_query($connect, $address_sql));
            $new_address = $row[0];
        }
    }
    $sql1 = "UPDATE `login` SET `login_pw` ='$new_pw', `name` = '$new_name', `address` = '$new_address' WHERE `login_id`='$login_id'";
    $res1 = mysqli_query($connect, $sql1);

    if($res1){
        echo "<script>alert('내 정보를 변경했습니다!');";
        echo "window.location.href='mypage.php';</script>";
    }
?>