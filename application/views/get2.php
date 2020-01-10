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

<h5 style="margin-left:200px;padding:0;">댓글</h5>
<button id="open_comment" class="btn btn-danger">펼치기</button>
<table class="table table-bordered table-responsive" style="margin-left:200px;margin-right:auto;">
  <thead>
    <tr>
      <td>이름</td>
      <td>내용</td>
      <td>날짜</td>
    </tr>
  </thead>
  <tbody id="show_comment"></tbody>
</table>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>
  $(function(){
    //callFunction
    $('#comment_form').submit(function(e){
      e.preventDefault();
      var form = $(this);
      var url = form.attr('action');
      $.ajax({
        type: 'post',
        url: url,
        dataType: 'json',
        data: form.serialize(),
        success: function(data){
          $.each(data, function(index,value){
            var html = '';
            var i;
            for(i=0;i<data.length;i++){
              html += '<tr>'+
              '<td>' + data[i].name + '</td>' +
              '<td>' + data[i].content + '</td>' +
              '<td>' + data[i].date + '</td>' +
              '</tr>';
            }
            $('#show_comment').html(html);
          });
        },
        error: function(data){
          alert('무언가 오류가 있습니다');
        }
      });
    }
  )});
</script>

<h5 style="margin-left:200px;padding:0;">댓글 작성</h5>
<div class="comment_form">
  <form action="/index.php/write/add_comment" onsubmit="false" method="post" id="comment_form">
    <div class="form-group">
      <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="이름"/>
    </div>
    <div class="form-group">
      <textarea name="comment_content" id="comment_content" class="form-control" placeholder="내용" rows="5"></textarea>
    </div>
    <input type="hidden" name="comment_id" id="comment_id" value="<?=$board->post_id?>"/>
    <div class="form-group">
      <input type="submit" class="btn btn-success" id="comment_button" value="등록"/>
    </div>
  </form>

</div>

<div style="text-align:center;">
  <a class="btn btn-dark" href="/index.php/write/update/<?=$board->post_id?>">수정</a>
  <a class="btn btn-dark" href="/index.php/board/delete/<?=$board->post_id?>">삭제</a>
  <a class="btn btn-dark" href="/index.php/board">목록</a>
</div>
