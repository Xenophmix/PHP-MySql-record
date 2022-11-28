<?php


$news = $pdo->query("SELECT * FROM `news` WHERE `id` = '{$_GET['id']}'")
  ->fetc();


?>
<main class="container">
  <h2 class="text-center">編輯消息</h2>
  <form action="./api/add_news.php" method="POST">
    <div class="form-group row mt-3">
      <label class="col-form-label col-md-2 text-end">主題</label>
      <div class="col-md-8">
        <input type="text" class="form-control" name="subject" value="<?= $news['subject']; ?>">
      </div>
    </div>
    <div class="form-group row mt-3">
      <label style="line-height: 10;" class="col-form-label col-md-2 text-end">內容</label>
      <div class="col-md-8">
        <textarea class="form-control" name="content" style="height:200px"></textarea>
      </div>
    </div>
    <div class="form-group row mt-3">
      <label class="col-form-label col-md-2 text-end">類別</label>
      <div class="col-md-8">
        <input type="text" class="form-control" name="type">
      </div>
    </div>
    <div class="form-group row mt-3">
      <div class="text-end text-info col-md-10">現在時間:<?= date("Y-m-d H:i:s"); ?></div>
    </div>
    <div class="text-center">
      <input class="btn btn-primary mx-2" type="submit" value="確定新增">
      <input class="btn btn-warning mx-2" type="reset" value="清空">
    </div>
  </form>
</main>
</form>