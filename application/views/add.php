<<<<<<< HEAD
<script src="/static/lib/ckeditor/ckeditor.js"></script>
<form action="/index.php/write/add" method="post">
  <input type="text" name="add_title" placeholder="제목">
  <br>
  <textarea name="add_body" placeholder="설명" class="span12"></textarea>
  <input type="submit" value="등록" name="an_submit"/>
</form>
<script>
  CKEDITOR.replace("add_body");
</script>
=======
<form action="/index.php/fm/add" method="post" class="col-md-5">
  <input type="text" name="name" placeholder="제목" />
  <br>
  <input type="text" name="image" placeholder="사진url"/>
  <textarea name="body" placeholder="설명" class="span12"></textarea>
  <input type="submit" value="등록" name="an_submit"/>
</form>
>>>>>>> 1186f238d84f76f8b7ea54ae9bcbbe0449bd8b12
