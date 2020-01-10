    <div class="span12" style="margin-left:auto;margin-right:auto;">
      <article style="text-align:center;">
        <img style="width:300px;height:300px;" src="<?=$person->image?>"/>
        <br><br>
        <h1 style="font-family:'Jeju Hallasan', serif;font-weight:bold;"><?=$person->name?></h1>
        <div>
          <div><?=$person->created?></div>
          <?=auto_link($person->body)?>
        </div>
      </article>
      <br>
      <a class="btn btn-dark" href="/index.php/fm2" style="float:right;">전체목록</a>
    </div>
  </div>
</div>
 ===get2 뷰 백업===
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
