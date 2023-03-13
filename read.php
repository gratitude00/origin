<?php 
	session_start(); 
	if(!isset($_SESSION['username'])) {
        echo "<script>alert('비회원입니다!');</script>";
        echo "<script>window.history.back() </script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+KR:wght@700&display=swap" rel="stylesheet">
    <style>
        * {font-family: 'IBM Plex Sans KR', sans-serif;}
        body {
          background: black;
          background-size: cover;
          overflow: auto;
        }
        .read_table {
            border: 1px solid #444444;
            margin-top: 30px;
            background-color: #F7F7F8;
        }
        .read_title {
            font-size: 23.5px;
            text-align: center;
            background-color: rgb(179, 170, 197);
            color: white;
            width: 900px;
        }

        .read_id {
            text-align: center;
            background-color: #EEEEEE;
            width: 30px;
            height: 33px;
        }

        .read_id2 {
            background-color: white;
            width: 60px;
            height: 33px;
            padding-left: 10px;
        }

        .read_hit {
            background-color: #EEEEEE;
            width: 30px;
            text-align: center;
            height: 33px;
        }

        .read_hit2 {
            background-color: white;
            width: 60px;
            height: 33px;
            padding-left: 10px;
        }

        .read_content {
            padding: 20px;
            border-top: 1px solid #444444;
            border-bottom: 2px dashed #A9A9F5;
            height: 500px;
        }

        .read_file {
            text-align: center;
            padding: 10px;
            width: 20px;
            height: 25px;
            border-right: 2px dashed #A9A9F5;
        }
        .read_file2 {
            padding: 10px;
            width: 50px;
            height: 25px;
        }
        .likes {
            position: relative;
            padding-left: 10px;
            left: 350px;
            border-left: 2px solid #A9A9F5;
            height: 25px;
        }

        .read_btn {
            width: 700px;
            height: 200px;
            text-align: center;
            margin: auto;
            margin-top: 20px;
        }
        .read_btn1 {
          display: inline-block;
          outline: 0;
          border: 0;
          cursor: pointer;
          will-change: box-shadow,transform;
          background: radial-gradient( 100% 100% at 100% 0%, #89E5FF 0%, #5468FF 100% );
          box-shadow: 0px 2px 4px rgb(45 35 66 / 40%), 0px 7px 13px -3px rgb(45 35 66 / 30%), inset 0px -3px 0px rgb(58 65 111 / 50%);
          padding: 0 32px;
          border-radius: 6px;
          color: #fff;
          height: 48px;
          font-size: 20px;
          text-shadow: 0 1px 0 rgb(0 0 0 / 40%);
          transition: box-shadow 0.15s ease,transform 0.15s ease;
        }
        .read_btn1:hover {
          box-shadow: 0px 4px 8px rgb(45 35 66 / 40%), 0px 7px 13px -3px rgb(45 35 66 / 30%), inset 0px -3px 0px #3c4fe0;
          transform: translateY(-2px);
        }
        .read_btn1:active{
          box-shadow: inset 0px 3px 7px #3c4fe0;
          transform: translateY(2px);
        }
    </style>
</head>
<body>
    <?php
    $connect = mysqli_connect('localhost', 'root', 'mysql', 'logindb');
    $idx = $_GET['idx'];  // GET 방식 사용
    session_start();
    $hit="update board set hit=hit+1 where idx=$idx";
    $connect->query($hit);
    $query = "select name, title, content, udate, file, hit, liked from board where idx = $idx";
    $result = $connect->query($query);
    $rows = mysqli_fetch_assoc($result);
    ?>

    <table class="read_table" align=center>
        <tr>
            <td colspan="4" class="read_title" style="font-size: 27px; height: 50px; float:center; background: linear-gradient(to right, blue, pink);"><?php echo $rows['title'] ?></td>
        </tr>
        <tr>
            <td class="read_id" style="font-size: 23px;">작성자</td>
            <td class="read_id2" style="font-size: 23px;"><?php echo $rows['name'] ?></td>
            <td class="read_hit" style="font-size: 23px;">조회수</td>
            <td class="read_hit2" style="font-size: 23px;"><?php echo $rows['hit'] ?></td>
        </tr>
        <tr>
            <td colspan="4" class="read_content" valign="top" style="font-size: 25px;">
                <?php echo $rows['content'] ?></td>
        </tr>
        <tr>

            <td class="read_file" style="font-size: 23px;">첨부파일</td>
            <td class = "read_file2" style="font-size: 23px;">
                <?php 
                if($rows['file']) { ?>
                <a href='./download.php?file=<?=$rows['file'];?>&target_Dir=./file/uploads'>다운로드</a>
           <?php } else { ?>
           <?php } ?>
            </td>
            <td class = "likes" style="font-size: 23px;">
                <?php
                    session_start();
                    $connect = mysqli_connect('localhost', 'root', 'mysql', 'logindb');
                    $idx = $_GET['idx'];
                    $username = $_SESSION['username'];

                    $sql = "SELECT * FROM likedb WHERE like_post_id='$idx' AND like_user='$username'";
                    $res = mysqli_fetch_array(mysqli_query($connect, $sql));

                    $sql2 = "SELECT * FROM likedb WHERE like_post_id ='$idx'";
                    $rows = mysqli_num_rows(mysqli_query($connect,$sql2));

                    if(!$res) {
                ?>
                            <span class="material-icons" style="color: darkred; cursor: pointer;" onclick="location.href='like.php?idx=<?=$idx?>'">
                                favorite_border
                            </span>
                            <span><?php echo $rows;?></span>
                 <?php }  else  { ?>
                            <span class="material-icons" style="color: red; cursor: pointer;" onclick="location.href='like.php?idx=<?=$idx?>'">
                                favorite
                            </span>
                            <span><?php echo $rows;?></span>
                <?php } ?>
            </td>
        </tr>
    </table>
    <div class="read_btn">
    	<button class="read_btn1" style="margin-right: 20px" onclick="location.href='list.php'">목록</button>&nbsp;&nbsp;
    	<button class="read_btn1" style="margin-right: 20px" onclick="location.href='modify.php?idx=<?= $idx ?>&name=<?= $_SESSION['name'] ?>'">수정</button>&nbsp;&nbsp;
    	<button class="read_btn1" onclick="ask();">삭제</button>
        <script>
            function ask() {
                if (confirm("게시글을 삭제하시겠습니까?")) {
                    window.location = "delete.php?idx=<?=$idx?>"
                }
            }
        </script>
    </div>
</body>
</html>