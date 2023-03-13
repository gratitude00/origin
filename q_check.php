<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+KR:wght@700&display=swap" rel="stylesheet">
    <style>
        * {font-family: 'IBM Plex Sans KR', sans-serif;}
        body {
          background-color: black;
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
        .read_content {
            justify-content: center;
            padding: 20px;
            border-top: 1px solid #444444;
            border-bottom: 2px dashed #A9A9F5;
            height: 500px;
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
        .center{
            text-align: center;
        }
        .textbox {
          height: 30px ;
          display: inline-block;
          border: 3px solid #3B82F6;
          border-radius: 5px;
          height: 30px;
          color: #282828;
          width: 150px;
          user-select: auto;
          font-size: 18px;
          padding: 0 6px;
          padding-left: 7px;
          margin-top: 40px;
        }
        .textbox:focus{
          border: 3px solid #5551ff;
        }
        .a_btn {
          font-size: 15px;
          flex-direction: column;
          align-items: center;
          padding: 6px 14px;
          border-radius: 6px;
          border: none;
          background: #6E6D70;
          box-shadow: 0px 0.5px 1px rgba(0, 0, 0, 0.1), inset 0px 0.5px 0.5px rgba(255, 255, 255, 0.5), 0px 0px 0px 0.5px rgba(0, 0, 0, 0.12);
          color: #DFDEDF;
          user-select: none;
          -webkit-user-select: none;
          touch-action: manipulation;
        }
        .a_btn:focus {
          box-shadow: inset 0px 0.8px 0px -0.25px rgba(255, 255, 255, 0.2), 0px 0.5px 1px rgba(0, 0, 0, 0.1), 0px 0px 0px 3.5px rgba(58, 108, 217, 0.5);
          outline: 0;
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
    session_start();

    $conn = mysqli_connect('localhost', 'root', 'mysql', 'logindb');
    $idx= $_GET["idx"];
    $sql= "SELECT * FROM q_board where idx='$idx'";
    $res = mysqli_fetch_array(mysqli_query($conn, $sql));

    if($_SESSION['username']=='admin') { ?>
        <script>
            document.location.href='q_read.php?idx=<?=$res['idx']?>';
        </script>
    <?php } ?>
    <table class="read_table" align=center width=auto border=0 cellpadding=2>
        <tr>
            <td colspan="4" class="read_title" style="font-size: 27px; height: 50px; float:center; background: linear-gradient(to right, blue, pink);"><?php echo $res['title']?></td>
        </tr>
        <tr>
            <td class="read_id" style="font-size: 23px;">작성자</td>
            <td class="read_id2" style="font-size: 23px;"><?php echo $res['name'] ?></td>
            <td class="read_hit" style="font-size: 23px;">조회수</td>
            <td class="read_hit2" style="font-size: 23px;"><?php echo $res['hit'] ?></td>
        </tr>
    </table>
    <form method = "post" action = "q_read.php?idx=<?=$res['idx']?>">
        <div class="center">
        <?php    
            if($_SESSION['username']!='admin') { ?>
                <input class = "textbox" name = "email" type = "text" placeholder="Email" autocomplete="off" style="margin-right: 10px; margin-left: 20px;" />
                <span style="color: white; font-size: 20px;margin-right: 10px"> & </span>
                <input class = "textbox" name = "pw" type = "password" placeholder="게시글 비밀번호" autocomplete="new-password" style="margin-right: 10px;" />
                <input class = "a_btn" type = "submit" value = "입력" />
        <?php   } else {
                    echo "<script>alert('잘못된 접근입니다');
                        history.back();</script>";
                    } ?>
        </div>
    </form>
    <div class="read_btn">
        <button class="read_btn1" style="margin-right: 20px" onclick="location.href='qna.php'">목록</button>&nbsp;&nbsp;
    </div>
</body>
</html>