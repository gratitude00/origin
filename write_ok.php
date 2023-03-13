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
<?php 
    if(!isset($_SESSION['username'])) {
        echo "<script>alert('비회원입니다');";
        echo "window.location.replace('main.php');</script>";
    }

    $conn = mysqli_connect('localhost', 'root', 'mysql', 'logindb');
    $login_id = $_SESSION['username'];
    $uname = $_SESSION['name']; //작성자
    $title = $_POST['title']; //타이틀
    $content = $_POST['content']; //내용

    //변수
    $error = $_FILES['file']['error'];
    $tmpfile = $_FILES['file']['tmp_name'];
    $filename = $_FILES['file']['name'];
    $folder = "./file/uploads/".$filename;

    if( $error != UPLOAD_ERR_OK ){ //오류 확인 
    switch( $error ) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "<script>alert('파일이 너무 큽니다.');";
                echo "window.history.back()</script>";
                exit;
        }
    }
    move_uploaded_file($tmpfile, $folder);

    //데이터를 board 테이블의 각 컬럼에 추가한다
    $sql = "INSERT INTO board(name, login_id, title, content, udate, file, hit, liked) VALUES ('$uname','$login_id','$title', '$content', now(), '$filename', 0, 0);";

    $res = mysqli_query($conn, $sql);

    if($res) {
        echo "<script>alert('게시글이 작성되었습니다.');";
        echo "window.location.replace('list.php');</script>";
    } else {
        echo mysqli_error($conn);
    }
?>