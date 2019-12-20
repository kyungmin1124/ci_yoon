<?php
echo '<div class="container">';
echo '<table class="table table-striped">
<tr>
<th>제목</th>
<th style="text-align:right;">작성시간</th>
</tr>';
foreach($bs as $entry) {
  echo '<tr>';
  echo '<td><a style="color:black;" href="/index.php/board/get/<?=$entry->id?>">'.$entry->title.'</a></td>';
  echo '<td style="text-align:right;">'.$entry->created.'</td>';
  echo '</tr>';
}
echo '</table>';
echo '<a class="btn btn-dark" href="/index.php/write/add" style="float:under;">글쓰기</a>';
echo '</div>';
?>
