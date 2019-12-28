<div class="container">
<form action="/index.php/board/update/<?=$id?>" method="post">
  게시물 수정 <input type="text" name="mod_title" placeholder="제목">
  <br>
  <textarea name="mod_body" placeholder="설명" class="span12"></textarea>
  <script type="text/javascript">
    CKEDITOR.replace("mod_body", {
      'filebrowserUploadUrl': '/index.php/write/upload_receive_from_ck'
    });
  </script>
  <input type="submit" value="등록" name="mod_submit"/>
</form>
</div>
