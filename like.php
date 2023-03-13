<?php
	session_start();
	$connect = mysqli_connect('localhost', 'root', 'mysql', 'logindb');
	$idx = $_GET['idx'];
	$username = $_SESSION['username'];

    $sql = "SELECT * FROM likedb WHERE like_post_id='$idx' AND like_user='$username'";
    $res = mysqli_fetch_array(mysqli_query($connect, $sql));
    if($res){
    	$sql2 = "
            UPDATE board SET liked = liked - 1 WHERE idx = $idx;
            DELETE FROM likedb WHERE like_post_id = '$idx' AND like_user = '$username';
            ";
        $res2 = mysqli_multi_query($connect, $sql2);
        echo "<script>alert('좋아요를 취소했습니다');";
        echo "window.history.back()</script>";
    } else {
        $sql3 = "
        UPDATE board SET liked=liked+1 WHERE idx=$idx;
        INSERT INTO likedb(like_post_id, like_user) VALUES ('$idx', '$username');
        ";
        $res3 = mysqli_multi_query($connect, $sql3);
        echo "<script>alert('이 글을 좋아합니다');";
        echo "window.history.back()</script>"; 
    }
?>
