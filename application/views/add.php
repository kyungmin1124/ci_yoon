<div class="container">
<form action="/index.php/write/add" method="post">
  게시물 작성 <input type="text" name="add_title" placeholder="제목">
  <br>
  <textarea name="add_body" placeholder="설명" class="span12"></textarea>
  <div class="form_control">
    <input type="submit" value="등록" name="an_submit"/>
  </div>
  <script type="text/javascript">
    CKEDITOR.replace("add_body", {
      'filebrowserUploadUrl': '/index.php/write/upload_receive_from_ck'
    });
  </script>
</form>
</div>
