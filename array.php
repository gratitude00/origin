<?php
	session_start();
	if(!isset($_SESSION['name'])) {
        echo "<script>alert('비회원입니다!');</script>";
        echo "<script>window.location.replace('main.php');</script>";
    }
	$conn = mysqli_connect('localhost','root','mysql','logindb');

	$array = $_POST['array'];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8"/>
    <title>Board</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+KR:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="liststyle.css">
    <script>
      function info() {
        var option = document.getElementById("search");
        var opt_value = option.options[option.selectedIndex].value;
        var info =""
        if(opt_value == 'title'){
          info="제목을 입력하세요";
        } else if(opt_value == 'name') {
          info = "작성자를 입력하세요";
        } else if(opt_value == 'content') {
          info = "내용을 입력하세요";
        }
        document.getElementById("search_box").placeholder = info;
      }
    </script>
</head>
<body>
	<p class="hh"><b>Board</b></p>
    <div style="text-align: center; margin-bottom: 10px; font-size: 30px">
      <form action="search_result.php" method="get">
        <select name="category" id="search" onchange="info()">
          <option value="title"> 제목 </option>
          <option value="name"> 작성자 </option>
          <option value="content"> 내용 </option>
        </select>
        <input type="text" class="search_box" name="search" id="search_box" autocomplete="off" />
        <button type="submit" class="s_btn">검색</button>
        <div>
          🗓️
          <input type = date name="date1">
          <span style="color: white;">-</span>
          🗓️
          <input type = date name="date2">
        </div>
      </form>
    </div>
    <div style="text-align: center; position: relative; left: 400px; margin-bottom: 20px; font-size: 20px">
      <form method="post" action="array.php">
        <select name = "array" style="width: 100px;height: 30px; padding-top: 1px; padding-left: 3px; margin-right: 5px;">
          <option value="udate">오래된 순</option>
          <option value="title">제목 순</option>
          <option value="hit">조회수 순</option>
          <option value="liked">좋아요 순</option>
        </select>
        <input type="submit" style="weight: 20px; text-align: center; display: inline-block;" class="a_btn" value="정렬"/>
      </form>
    </div>
	<table align=center>
        <thead align="center">
            <tr style="background: #33373B; opacity:0.9; font-size: 23px">
                <th width=70>번호</th>
                <th width=300>제목</th>
                <th width=120>작성자</th>
                <th width=120>작성일</th>
                <th width=70>조회수</th>
                <th width=70>좋아요</th>
            </tr>
       </thead>
        <?php
            $n_sql = "SELECT count(*) FROM board";
            $n_result = mysqli_query($conn,$n_sql);
            $row = mysqli_fetch_row($n_result);
            $num = $row[0];

            $list_num=5; //한 페이지에 보여줄 개수
            $page_num=3; //블록 당 보여줄 페이지 개수
            $page=isset($_GET['page'])? $_GET['page'] :1;

            $total_page = ceil($num/$list_num); //전체 페이지 수
            $now_block = ceil($page/$page_num); //현재 블록 번호

            $block_start=(($now_block-1)*$page_num)+1;// 블록의 시작 번호
            if($block_start <= 0){
              $block_start =1;
            }

            $block_end=$now_block*$page_num; //블록의 마지막 번호
            if($block_end>$total_page){
              $block_end=$total_page;
            }

            $page_start=($page-1) * $list_num;

            if($array) {
            	$sql2 = "SELECT * FROM board ORDER BY $array DESC LIMIT $page_start, $list_num";
            }

            $result = mysqli_query($conn, $sql2);
            $cnt = $page_start+1;

            while($row = mysqli_fetch_array($result)){
        ?>
            <tbody>
                <tr align=center style="background: #ffffff;font-size:20px; color: black;">
                    <td><?php echo $cnt;?></td>
                    <td width="500" align="center"><a href="read.php?idx=<?=$row['idx']?>"><?php echo $row['title'];?></a></td>
                    <td width="100" align="center"><?php echo $row['name'];?></td>
                    <td width="200" align="center"><?php echo $row['udate'];?></td>
                    <td><?php echo $row['hit'];?></td>
                    <td><?php echo $row['liked'];?></td>
                </tr>
                <?php
                $cnt++;
                ?>
            </tbody>
        <?php } ?>
    </table>
     <div style="text-align: center; margin-top: 15px; font-size: 20px">
      <?php
      if($page <= 1){?>
        <a href='list.php?page=1'> ◀ 이전 </a>
      <?php } else { ?>
        <a href='list.php?page=<?php echo ($page-1); ?>'> ◀ 이전 </a>
      <?php }; ?>

      <?php
      for($print_page=$block_start; $print_page <= $block_end ; $print_page++) {
      ?>
      <a href='list.php?page=<?php echo $print_page; ?>'><?php echo $print_page; ?></a>
      <?php }; ?>

      <?php
      if($page >= $total_page){?>
        <a href='list.php?page=<?php echo $total_page; ?>'> 다음 ▶ </a>
      <?php } else { ?>
        <a href='list.php?page=<?php echo ($page+1); ?>'> 다음 ▶ </a>
      <?php }; ?>
    </div>
    <div class="read_btn">
      <button class="read_btn1" style="margin-right: 15px" onclick="window.location.href='write.php'">글쓰기</button>&nbsp;&nbsp;
      <button class="read_btn1" onclick="window.location.href='main.php'">메인으로</button>
    </div>
</body>
</html>