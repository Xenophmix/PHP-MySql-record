<?php
$sql = "SELECT * FROM `news` WHERE `id`='{$_GET['id']}'";
$news = $pdo->query($sql)->fetch();

?>
<h3 class="text-left font-weight-bolder text-white"><?= $news['subject']; ?></h3>
<div class="text-right text-info">
  發佈時間：<?= $news['created_at']; ?>
</div>
<div class="text-left text-warning">[<?= $news['type']; ?>]</div>
<div class="text-white" style='font-size:1.2rem'><?= nl2br($news['content']); ?></div>