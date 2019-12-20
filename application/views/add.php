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
