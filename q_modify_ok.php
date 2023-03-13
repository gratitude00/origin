<?php
    $connect = mysqli_connect('localhost', 'root', 'mysql', 'logindb');

    $idx = $_POST['idx'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $hash = md5($pass);

    $query = "update q_board set title='$title', content='$content', name = '$name', pw='$hash', email='$email', udate=now() where idx='$idx'";
    $result = $connect->query($query);
    if ($result) {
    ?>
        <script>
            alert("수정되었습니다.");
            location.replace("qna.php?idx=<?=$idx?>");
        </script>
    <?php } else {
        echo "다시 시도해주세요.";
    }
?>