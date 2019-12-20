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
