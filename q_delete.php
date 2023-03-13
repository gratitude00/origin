<?php
    session_start();
    $conn = mysqli_connect('localhost', 'root', 'mysql', 'logindb');
    $idx = $_GET['idx'];
    $sql= "SELECT * FROM q_board where idx='$idx'";
    $res = mysqli_fetch_array(mysqli_query($conn, $sql));

    $pw = $_GET['pw'];
    $hash = md5($pw);

    $sql_check = "SELECT * FROM q_board WHERE idx=$idx";
    $res_check = mysqli_fetch_array(mysqli_query($conn, $sql_check));

    if($_SESSION['username']=='admin') {
        echo "<script>alert('관리자 권한으로 삭제합니다!');</script>";
    } else if ($res_check['pw']==$hash){
        echo "<script>alert('게시글이 삭제되었습니다.');</script>";
    } else if ($res_check['pw']!=$hash) {
        echo "<script>alert('비밀번호가 틀렸습니다.');";
        echo "window.location.href=\"qna.php\"</script>";
        exit;
    }

    $sql = "DELETE FROM q_board WHERE idx=$idx;";
    $res = mysqli_query($conn, $sql);
    echo "<script>window.location.replace('qna.php');</script>";
?>