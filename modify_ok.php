<?php
    $connect = mysqli_connect('localhost', 'root', 'mysql', 'logindb');

    $idx = $_POST['idx'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $query = "update board set title='$title', content='$content', udate=now() where idx='$idx'";
    $result = $connect->query($query);
    if ($result) {
    ?>
        <script>
            alert("수정되었습니다.");
            location.replace("read.php?idx=<?=$idx?>");
        </script>
    <?php } else {
        echo "다시 시도해주세요.";
    }
?>