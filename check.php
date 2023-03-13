<?php 

$conn = mysqli_connect('localhost','root','mysql','logindb');
$uid=$_GET["userid"];
$sql = "select * from login where login_id='$uid'";
$result = mysqli_fetch_array(mysqli_query($conn, $sql));

if($result){
	echo "해당 아이디<span style='color:red;'>($uid)</span>가 이미 존재합니다";
?>	<p><input type=button value="다른 ID 사용" onclick="opener.parent.change(); window.close();"></p>
	<?php
} else {
	echo "해당 아이디<span style='color:blue;'>($uid)</span>는 사용할 수 있는 아이디입니다";
?>  <p><input type=button value="이 ID 사용" onclick="opener.parent.decide(); window.close()"></p>
	<?php
}
?>
