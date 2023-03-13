<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>Address</title>
</head>
<body>
<?php
    $conn = mysqli_connect('localhost','root','mysql','logindb');

    $address = $_GET['address'];
    $arr = explode(" ", $address);

    if($arr[1]){
        $sql = "SELECT * FROM ZIPCODE WHERE DORO='$arr[0]' AND BUILD_NO1='$arr[1]'";
    } else {
        $sql = "SELECT * FROM ZIPCODE WHERE DORO='$arr[0]' ORDER BY BUILD_NO1 ASC";
    }

    $res = mysqli_query($conn, $sql);
?>
    <ul>
<?php
    if(mysqli_num_rows($res)) {
        while($row = mysqli_fetch_array($res)){
            $full = $row['SIDO']." ".$row['SIGUNGU']." ".$row['DORO']." ".$row['BUILD_NO1']." ".$row['BUILD_NM']; ?>
            <li><a href = "detail.php?full=<?=$full?>"><?=$full?></li>
        <?php }
    } ?>
    </ul>
</body>
</html>
