
<?php
echo '<div class="container">';
echo '<table class="table table-striped">
<tr>
<th>제목</th>
<th style="text-align:right;">작성시간</th>
</tr>';
foreach($bs as $ent) {
  echo '<tr>';
  echo '<td><a style="color:black;" href="/index.php/board/get/'.$ent->post_id.'">'.$ent->title.'</a></td>';
  echo '<td style="text-align:right;">'.$ent->created.'</td>';
  echo '</tr>';
}
echo '</table>';
echo '</div>';
echo '<a class="btn btn-dark" href="/index.php/write/add" style="text-align:center; margin-left:120px;">글쓰기</a>';
?>

<?php

$num = "SELECT count(title) FROM board";
if(isset($_GET['page'])) {
  $page = ($_GET['page'])?$_GET['page']:1;
} else {
  $page = 'index';
}
$list = 10;
$block = 3;

$pagenum = ceil($num/$list); //총 페이지
$blocknum = ceil($pagenum/$block); //블록으로 나누기
$nowblock = ceil($page/$block);

$s_page = ($nowblock * $block) - 2;
if ($s_page <=1) {
  $s_page = 1;
}

$e_page = $nowblock * $block;
if ($pagenum <= $e_page) {
  $e_page = $pagenum;
}
for($p = $s_page; $p<=$e_page; $p++) {
?>
<a style="color:black;" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$p?>"><?=$p?></a>
<?php
}
?>
<div style="text-align:center;">
  <a style="color:black;" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$s_page-1?>">이전</a>
  <a style="color:black;" href="<?=$_SERVER['PHP_SELF']?>?page=<?=$e_page+1?>">다음</a>
</div>

<?php
$s_point = ($page-1) * $list;
$link = mysqli_connect("localhost","root","554545","fm2019");


$real_data = mysqli_query($link,"SELECT * FROM board ORDER BY created DESC LIMIT $s_point,$list");

for ($i=1; $i<=$num; $i++) {
$fetch = mysql_fetch_array($real_data);
?>

<div>
<?= $fetch['list_no'] ?>
</div>

<?php
if ($fetch == false) {
break;
}
}
?>
