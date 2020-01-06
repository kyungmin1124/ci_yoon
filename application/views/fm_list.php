
<div class="container-fluid">
  <div class="row">
    <div class="span2">
      <ul style="color:#FF0040;">
        <?php
        foreach ($ps as $entry) {
          ?>
          <li><a style="color:#0404B4;font-weight:bold;" href="/index.php/fm2/get/<?=$entry->id?>"><?=$entry->name?></a></li>
          <?php
        }
        ?>
      </ul>
    </div>
