<div class="span12" style="margin-left:auto;margin-right:auto;">
  <article style="text-align:center;">
    <br><br>
    <h3 style="font-family:'Jeju Hallasan', serif;font-weight:bold;"><?=$people->title?></h3>
    <br><br>
    <div>
      <div><?=$people->created?></div>
      <div><?=($people->body)?></div>
    </div>
  </article>
  <br>
</div>
<a class="btn btn-dark" href="/index.php/write/update/<?=$people->id?>" style="text-align: center;">수정</a>
<a class="btn btn-dark" href="/index.php/board/delete/<?=$people->id?>" style="text-align: center;">삭제</a>
<a class="btn btn-dark" href="/index.php/board" style="text-align: center;">목록</a>
</div>
</div>
