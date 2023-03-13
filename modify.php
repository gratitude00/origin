<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+KR:wght@700&display=swap" rel="stylesheet">
    <style>
        * {font-family: 'IBM Plex Sans KR', sans-serif;}
        body {
          background-color: black;
          background-size: cover;
          overflow: auto;
        }
        table.table2 {
            border-collapse: separate;
            border-spacing: 1px;
            text-align: left;
            line-height: 1.5;
            border-top: 1px solid #ccc;
            margin: 20px 10px;
        }
        table.table2 tr {
            width: 50px;
            padding: 10px;
            font-weight: bold;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
        }

        table.table2 td {
            width: 100px;
            padding: 10px;
            vertical-align: top;
            border-bottom: 1px solid #ccc;
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
        .t_box {
            border-radius: 5px;
            background: rgb(249, 250, 250);
            border: 1px solid rgb(181, 189, 196);
            font-size: 15px;
            line-height: 24px;
            padding: 7px 8px;
            color: rgb(8, 9, 10);
            box-shadow: none;
        }
        .t_box:focus{
            background-color: #fff;
            border-color: #3b49df;
            box-shadow: 1px 1px 0 #3b49df;
        }
    </style>
</head>
<body>
    <?php
    $connect = mysqli_connect('localhost', 'root', 'mysql', 'logindb');
    $idx = $_GET['idx'];
    $query = "select name, login_id, title, content, udate, hit, liked from board where idx = $idx";
    $result = $connect->query($query);
    $rows = mysqli_fetch_assoc($result);

    $title = $rows['title'];
    $content=$rows['content'];
    $login_id=$rows['login_id'];

    session_start();

    $url ="list.php";

    if (!isset($_SESSION['username'])) {
    ?> <script>
            alert("비회원입니다.");
            location.replace("<?php echo $url ?>");
        </script>
    <?php   } else if($_SESSION['username'] == $login_id) {
    ?>
        <form method="POST" action="modify_ok.php">
            <table style="margin-top: 50px; padding-bottom: 10px; padding-top:5px; background-color: #FFFFFF; " align=center width=auto border=0 cellpadding=2>
            <tr>
                <td style="height:40; float:center; background: linear-gradient(to right, blue, pink); ">
                    <p style="font-size:30px; font-style: oblique; text-align: center; color:white; margin-top:10px; margin-bottom:10px"><b>Rewrite</b></p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor=white>
                        <table class="table2">
                            <tr>
                                <td style="font-size: 25px;">제목</td>
                                <td><input type=text class="t_box" name=title style="font-size: 20px;" cols=25 size=40  value="<?=$title?>"></td>
                            </tr>

                            <tr>
                                <td style="font-size: 25px;">내용</td>
                                <td><textarea name=content class="t_box" style="font-size: 20px;" cols=40 rows=15 required><?=$content?></textarea></td>
                            </tr>
                            <tr>
                                <td style="font-size: 25px;">첨부파일</td>
                                <td style="font-size: 25px;"><input type="file" name="file" style="font-size: 17px;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div class="read_btn">
                <input type="hidden" name="idx" value="<?=$idx?>">
                 <button class="read_btn1" type="submit">작성</button>&nbsp;&nbsp;
            </div>
        </form>
         <?php   } else {
    ?> <script>
            alert("권한이 없습니다.");
            location.replace("<?php echo $url ?>");
        </script>
    <?php   }
    ?></body>
</html>