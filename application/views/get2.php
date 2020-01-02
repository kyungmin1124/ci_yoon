<div class="span12" style="margin-left:auto;margin-right:auto;">
  <article style="text-align:center;">
    <br/><br/>
    <h3 style="font-family:'Jeju Hallasan', serif;font-weight:bold;"><?=$board->title?></h3>
    <br/><br/>
    <div>
      <div><?=$board->created?></div>
      <div><?=$board->body?></div>
    </div>
  </article>
  <br/>
</div>
<h5>댓글</h5>
<?php

foreach ($reply as $re) {
  if($re->post_id == $board->post_id){
  // code...
    echo '<div>';
    echo '<table>';
    echo '<tr>';
    echo '<td><p style="font-size:5px;padding:0;">'.$re->name.':</p></td>';
    echo '<td><p style="font-size:5px;padding:0;">'.$re->content.'//</td></p>';
    echo '<td><p style="font-size:5px;padding:0;">'.$re->date.'</td></p>';
    echo '</tr>';
    echo '</table>';
    echo '</div>';
  } else {
    echo "no any commnets yet";
  }
}
?>
<h5>댓글 작성</h5>
<div>
  <form action="/index.php/write/add_comment" method="post" id="comment_form">
    <div class="form-group">
      <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="이름"/>
    </div>
    <div class="form-group">
      <textarea name="comment_content" id="comment_content" class="form-control" placeholder="내용" rows="5"></textarea>
    </div>
    <input type="hidden" name="comment_id" id="comment_id" value="<?=$board->post_id?>"/>
    <div class="form-group">
      <input type="submit" name="submit" id="submit" class="btn btn-info" value="제출"/>
    </div>
  </form>
</div>
<div style="text-align:center;">
  <a class="btn btn-dark" href="/index.php/write/update/<?=$board->post_id?>">수정</a>
  <a class="btn btn-dark" href="/index.php/board/delete/<?=$board->post_id?>">삭제</a>
  <a class="btn btn-dark" href="/index.php/board">목록</a>
</div>
