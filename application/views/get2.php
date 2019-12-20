<div class="span12" style="margin-left:auto;margin-right:auto;">
  <article style="text-align:center;">
    <br><br>
    <h3 style="font-family:'Jeju Hallasan', serif;font-weight:bold;"><?=$people->title?></h3>
    <br><br>
    <div>
      <div><?=$people->created?></div>
      <?=auto_link($people->body)?>
    </div>
  </article>
  <br>
</div>
<a class="btn btn-dark" href="/index.php/board" style="float:right;">목록</a>
</div>
</div>
