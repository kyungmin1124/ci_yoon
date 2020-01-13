 <?php
 echo '<div class="container">';
 echo '<table class="table table-striped">
 <tr>
 <th>제목</th>
 <th style="text-align:right;">작성시간</th>
 </tr>';
 foreach($page as $ent) {
   echo '<tr>';
   echo '<td><a style="color:black;" href="/index.php/board/get/'.$ent->post_id.'">'.$ent->title.'</a></td>';
   echo '<td style="text-align:right;">'.$ent->created.'</td>';
   echo '</tr>';
 }
 echo '</table>';
 echo '</div>';
 echo '<div style="text-align:center;>';
 for($i=$startBlock;$i<=$endBlock;$i++){
   echo '<a style="text-align:center;"href="/board?page='.$i.'&list='.$listNum.'">'.$i.'</a>';
 }
  echo '<span style="text-align:center;">'.$clicks.'</span>';
  echo '</div>';
  echo '<a class="btn btn-dark" href="/index.php/write/add" style="text-align:center; margin-left:120px;">글쓰기</a>';
?>
