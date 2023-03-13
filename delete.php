<?php
    $connect = mysqli_connect('localhost', 'root', 'mysql', 'logindb');
    $idx = $_GET['idx'];
    $query = "select login_id from board where idx = $idx";
    $result = $connect->query($query);
    $rows = mysqli_fetch_assoc($result);

    $name = $rows['login_id'];

    session_start();
    $url = "list.php";
    
    if (!isset($_SESSION['username'])) {
?> <script>
        alert("비회원입니다.");
        location.replace("<?php echo $url ?>");
    </script>

<?php } else if ($_SESSION['username'] == $name) {
    $query1 = "delete from board where idx = $idx";
    $result1 = $connect->query($query1); ?>
    <script>
        alert("게시글이 삭제되었습니다.");
        location.replace("<?php echo $url ?>");
    </script>

<?php } else { ?>
    <script>
        alert("권한이 없습니다.");
        location.replace("<?php echo $url ?>");
    </script>
<?php }
?>