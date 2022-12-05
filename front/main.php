<h1 class="text-center">最新消息</h1>
<main class="container">

  <ul class="list-group">
    <li class='list-group-item list-group-item-action d-flex text-center bg-info text-white'>
      <div class='col-md-10'>標題</div>
      <div class='col-md-2'>人氣</div>
    </li>
    <?php
    // $all_news = "SELECT * FROM `news` ORDER BY `top` desc,`readed` desc ";
    $rows = all('news', "ORDER BY `top` desc,`readed` desc ");
    // $hot = $pdo->query("SELECT `id` FROM `news` ORDER BY `readed` desc")->fetchColumn();
    $hot = q("SELECT `id` FROM `news` ORDER BY `readed` desc")[0][0];

    foreach ($rows as $row) {
      echo "<li class='list-group-item list-group-item-action d-flex'>";
      echo "<div class='col-md-10 text-center'>";
      echo ($row['top']==1)?"top!!!&nbsp;&nbsp;&nbsp;":'';
      echo ($row['id']==$hot)?"hot!!!&nbsp;&nbsp;&nbsp;":'';
      echo "<a class='text-dark' href='index.php?do=news_detail&id={$row['id']}'>";
      echo $row['subject'];
      echo "</a>";
      echo "</div>";
      echo "<div class='col-md-2 text-center'>";
      echo $row['readed'];
      echo "</div>";
      echo "</li>";
    }

    ?>

  </ul>

</main>