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
    $conn = mysqli_connect('localhost', 'root', 'mysql', 'logindb');

    $uname = $_POST['name']; //작성자
    $title = $_POST['title']; //타이틀
    $content = $_POST['content']; //내용
    $email = $_POST['email']; //연락처
    $pass = $_POST['pass']; //비밀번호
    $hash = md5($pass);

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
    $sql = "INSERT INTO q_board(title, content, name, pw, file, email, udate, hit) VALUES ('$title','$content','$uname','$hash','$filename', '$email', now(), 0);";

    $res = mysqli_query($conn, $sql);

    if($res) {
        echo "<script>alert('게시글이 작성되었습니다.');";
        echo "window.location.replace('qna.php');</script>";
    } else {
        echo mysqli_error($conn);
    }
?>