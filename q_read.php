<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="ko">
<head>
    <meta charset="UTF-8">
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
    $conn = mysqli_connect('localhost', 'root', 'mysql', 'logindb');
    $idx= $_GET["idx"];
    $email = $_POST['email'];
    $pw = $_POST['pw'];
    $hash = md5($pw);

    $sql_hit = "UPDATE q_board SET hit=hit+1 WHERE idx=$idx";
    $res_hit = mysqli_query($conn, $sql_hit);

    $sql= "SELECT * FROM q_board where idx='$idx'";
    $res = mysqli_fetch_array(mysqli_query($conn, $sql));

    if($_SESSION['username'] =='admin') {
        echo "<script>alert('관리자 권한으로 조회합니다.');</script>";
    } else if ($res['email'] == $email && $res['pw'] == $hash) {
    	echo "<script>alert('작성자 권한으로 조회합니다.');</script>";
    } else {
    	echo "<script>alert('게시글 조회 권한이 없습니다');";
        echo "window.location.href=\"q_check.php?idx=$idx\"</script>";
    }
?>
    <table class="read_table" align=center>
        <tr>
            <td colspan="4" class="read_title" style="font-size: 27px; height: 50px; float:center; background: linear-gradient(to right, blue, pink);"><?php echo $res['title'] ?></td>
        </tr>
        <tr>
            <td class="read_id" style="font-size: 23px;">작성자</td>
            <td class="read_id2" style="font-size: 23px;"><?php echo $res['name'] ?></td>
            <td class="read_hit" style="font-size: 23px;">조회수</td>
            <td class="read_hit2" style="font-size: 23px;"><?php echo $res['hit'] ?></td>
        </tr>
        <tr>
        	<td class="read_hit" style="font-size: 23px;  border-top: 1px solid #444444;">연락처</td>
            <td colspan="4" class="read_hit2" valign="top" style="font-size: 23px; border-top: 1px solid #444444;">
                <?php echo $res['email'] ?></td>
        </tr>
        <tr>
            <td colspan="4" class="read_content" valign="top" style="font-size: 25px;">
                <?php echo $res['content'] ?></td>
        </tr>
        <tr>
            <td class="read_file" style="font-size: 23px;">첨부파일</td>
            <td class = "read_file2" style="font-size: 23px;">
                <?php 
                if($res['file']) { ?>
                <a href='./download.php?file=<?=$res['file'];?>&target_Dir=./file/uploads'>다운로드</a>
           <?php } else { ?>
           <?php } ?>
            </td>
        </tr>
    </table>
    <div class="read_btn">
    	<button class="read_btn1" style="margin-right: 20px" onclick="location.href='qna.php'">목록</button>&nbsp;&nbsp;
        <input type="hidden" name="pw" id="pw">
    	<button class="read_btn1" style="margin-right: 20px" onclick="pw_check();">수정</button>&nbsp;&nbsp;
        <script>
            function pw_check(){
                document.getElementById('pw').value = prompt('게시글 비밀번호를 입력해주세요.', '비밀번호')
                var pw = document.getElementById('pw').value;
                if(pw){
                    window.location = "q_modify.php?idx=<?=$idx?>&pw="+pw;
                }
            }
        </script>
    	<button class="read_btn1" onclick="ask();">삭제</button>
        <script>
            function ask() {
                document.getElementById('pw').value = prompt('게시글 비밀번호를 입력해주세요.', '비밀번호')
                var pw = document.getElementById('pw').value;
                if(pw){
                    window.location = "q_delete.php?idx=<?=$idx?>&pw="+pw;
                }
            }
        </script>
    </div>
</body>
</html>