<h1>學生管理系統</h1>
<?php
include "./layouts/class_nav.php";
if (isset($_GET['code'])) {
  // code 班級 假設是101班 就顯示101班所有人的資料 無限制LIMIT
  $sql = "SELECT `students`.`id`,
                `students`.`school_num` as '學號',
                 `students`.`name` as '姓名',
                 `students`.`uni_id` as '身份證字號',
                 `students`.`birthday` as '生日',
                 `students`.`graduate_at` as '畢業國中'
          FROM `class_student`,`students` 
          WHERE `class_student`.`school_num`=`students`.`school_num` && 
                `class_student`.`class_code`='{$_GET['code']}'";
  $sql_total = "SELECT count(`students`.`id`)
        FROM `class_student`,`students` 
        WHERE `class_student`.`school_num`=`students`.`school_num` && 
              `class_student`.`class_code`='{$_GET['code']}'";
} else {
  //建立撈取學生資料的語法，限制只撈取前20筆
  $sql = "SELECT `students`.`id`,
                 `students`.`school_num` as '學號',
                 `students`.`name` as '姓名',
                 `students`.`uni_id` as '身份證字號',
                 `students`.`birthday` as '生日',
                 `students`.`graduate_at` as '畢業國中'
          FROM `students`";
  $sql_total = "SELECT count(`students`.`id`)
        FROM `students`";
}

$div = 15;
$total = $pdo->query($sql_total)->fetchColumn();
// echo "總筆數為:" . $total;
$pages = ceil($total / $div);
// echo "總頁數為:" . $pages;
$now = (isset($_GET['page'])) ? $_GET['page'] : 1;
// echo "當前頁為:" . $now;
$start = ($now - 1) * $div;

$sql = $sql . " LIMIT $start,$div";



//執行SQL語法，並從資料庫取回全部符合的資料，加上PDO::FETCH_ASSOC表示只需回傳帶有欄位名的資料
$rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="pages">
  <?php
  //上一頁
  //當前頁碼-1,可是不能小於0,最小是1,如果是0,不顯示
  if (($now - 1) >= 1) {
    $prev = $now - 1;
    if (isset($_GET['code'])) {
      echo "<a class='text-white' href='?do=students_list&page=$prev&code={$_GET['code']}'> ";
      echo "&lt; ";
      echo " </a>";
    } else {

      echo "<a class='text-white' href='?do=students_list&page=$prev'> ";
      echo "&lt; ";
      echo " </a>";
    }
  } else {
    echo "<a class='noshow'>&nbsp;</a>";
  }

  ?>
  <div>
    <?php
    //顯示第一頁
    if ($now > 4) {
      if (isset($_GET['code'])) {
        echo "<a class='text-white' href='?do=students_list&page=1&code={$_GET['code']}'> ";
        echo "1 ";
        echo " </a>...";
      } else {

        echo "<a class='text-white' href='?do=students_list&page=1'> ";
        echo "1 ";
        echo " </a>...";
      }
    }
    ?>
    <?php
    // 頁碼區
    // 只顯示前後四個頁碼
    if ($now >= 3 && $now <= ($pages - 2)) {
      $startPage = $now - 2;
    } else if ($now - 2 < 3) {
      $startPage = 1;
    } else {
      $startPage = $pages - 4;
    }


    if ($pages < 5) {
      for ($i = 1; $i <= $pages; $i++) {
        $nowPage = ($i == $now) ? 'now' : '';
        if (isset($_GET['code'])) {
          echo "<a href='?do=students_list&page=$i&code={$_GET['code']}' class='$nowPage text-white'> ";
          echo $i;
          echo " </a>";
        } else {

          echo "<a href='?do=students_list&page=$i' class='$nowPage text-white'> ";
          echo $i;
          echo " </a>";
        }
      }
    } else {

      for ($i = $startPage; $i <= ($startPage + 4); $i++) {
        $nowPage = ($i == $now) ? 'now' : '';
        if (isset($_GET['code'])) {
          echo "<a href='?do=students_list&page=$i&code={$_GET['code']}' class='$nowPage text-white'> ";
          echo $i;
          echo " </a>";
        } else {

          echo "<a href='?do=students_list&page=$i' class='$nowPage text-white'> ";
          echo $i;
          echo " </a>";
        }
      }
    }

    ?>
    <?php
    //顯示第最後一頁
    if ($now < ($pages - 3)) {
      if (isset($_GET['code'])) {
        echo "...<a class='text-white' href='?do=students_list&page=$pages&code={$_GET['code']}'> ";
        echo "$pages";
        echo " </a>";
      } else {

        echo "...<a class='text-white' href='?do=students_list&page=$pages'> ";
        echo "$pages";
        echo " </a>";
      }
    }
    ?>
  </div>
  <?php
  //下一頁
  //當前頁碼+1,可是不能超過總頁數,最大是總頁數,如果超過總頁數,不顯示
  if (($now + 1) <= $pages) {
    $next = $now + 1;
    if (isset($_GET['code'])) {
      echo "<a class='text-white' href='?do=students_list&page=$next&code={$_GET['code']}'> ";
      //echo "< ";
      echo "&gt; ";
      echo " </a>";
    } else {
      echo "<a class='text-white' href='?do=students_list&page=$next'> ";
      //echo " >";
      echo "&gt; ";
      echo " </a>";
    }
  } else {
    echo "<a class='noshow'>&nbsp;</a>";
  }

  ?>
</div>
<!--建立顯示學生列表的表格html語法-->
<table class='list-students'>
  <tr>
    <td>學號</td>
    <td>姓名</td>
    <td>身份證字號</td>
    <td>生日</td>
    <td>畢業國中</td>
    <td>年齡</td>
  </tr>
  <?php
  //使用迴圈來顯示每一位學生的資料
  foreach ($rows as $row) {
    $age = round((strtotime('now') - strtotime($row['生日'])) / (60 * 60 * 24 * 365), 1);

    echo "<tr>";
    echo "<td>{$row['學號']}&nbsp;</td>";
    echo "<td>{$row['姓名']}</td>";
    echo "<td>{$row['身份證字號']}</td>";
    echo "<td>{$row['生日']}</td>";
    echo "<td>{$row['畢業國中']}</td>";
    echo "<td>&nbsp$age</td>";
    echo "</tr>";
  }
  ?>
</table>
<?php
if (isset($_GET['page']) && !isset($_GET['code']) || !isset($_GET['page']) && !isset($_GET['code'])) {
?>
  <div class="BackHome1"><a href="<?= '?page=1' ?>&do=students_list">BACKALL</a></div>
<?php
} else {;
?>
  <div class="BackHome2"><a href="<?= '?page=1' ?>&do=students_list">BACKALL</a></div>
<?php
};
?>