<!DOCTYPE html>
<html lang="en">
<!-- 字體1 -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@500&display=swap" rel="stylesheet">
<!-- 字體2 -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kumar+One+Outline&display=swap" rel="stylesheet">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生管理系統</title>
    <link rel="stylesheet" href="style.css">
    <?php
    //使用PDO方式建立資料庫連線物件
    $dsn = "mysql:host=localhost;charset=utf8;dbname=school";
    $pdo = new PDO($dsn, 'root', '');

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
    echo "總筆數為:" . $total;
    $pages = ceil($total / $div);
    echo "總頁數為:" . $pages;
    $now = (isset($_GET['page'])) ? $_GET['page'] : 1;
    echo "當前頁為:" . $now;
    $start = ($now - 1) * $div;

    $sql = $sql . " LIMIT $start,$div";



    //執行SQL語法，並從資料庫取回全部符合的資料，加上PDO::FETCH_ASSOC表示只需回傳帶有欄位名的資料
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    ?>

<body>
    <?php
    if (isset($_GET['del'])) {
        $name=$pdo->query("SELECT `name` FROM `students` WHERE `id` = '{$_GET['del']}'")
                  ->fetchColumn();
        echo "<div class='del-msg'>";
        echo $_GET['del'];
        echo "</div>";
    }


    ?>
    <h1>學生管理系統</h1>
    <nav>
        <a href="add.php">新增學生</a>
        <a href="reg.php">教師註冊</a>
        <a href="login.php">教師登入</a>
    </nav>
    <nav>
        <ul class="class-list">
            <?php
            $sql = "SELECT `id`,`code`,`name` FROM `classes`";
            $classes = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            foreach ($classes as $class) {
                echo "<li><a href='?code={$class['code']}'>{$class['name']}</a></li>";
            }
            ?>
        </ul>
    </nav>
    <?php
    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'add_success';
                echo "<span style='color:green; display:block; text-align: center;'>新增學生成功</span>";
                break;
            case 'add_fail';
                echo "<span style='color:red; display:block; text-align: center;'>新增學生有誤</span>";
            case 'edit_error';
                echo "<span style='color:red; display:block; text-align: center;'>無法編輯，請洽管理員或正操作</span>";
        }
    }

    ?>


    <div class="pages">
        <?php
        // 上一頁
        // 當前頁碼-1，可是不能小於0，最小是1，如果是0，不顯示
        if (($now - 1) >= 1) {
            $prev = $now - 1;
            if (isset($_GET['code'])) {
                echo "<a href='?page=$prev&code={$_GET['code']}'> ";
                echo "&lt ";
                echo " </a>";
            } else {

                echo "<a href='?page=$prev'> ";
                echo "&lt ";
                echo " </a>";
            }
        } else {
            echo "<a class='noshow'>&nbsp;</a>";
        }
        ?>
        <div>
            <?php
            //顯示第一頁
            if ($now >= 4) {
                if (isset($_GET['code'])) {
                    echo "<a href='?page=1&code={$_GET['code']}'> ";
                    echo "1 ";
                    echo " </a>...";
                } else {

                    echo "<a href='?page=1'> ";
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
            for ($i = $startPage; $i <= ($startPage + 4); $i++) {
                $nowPage = ($i == $now) ? 'now' : '';
                if (isset($_GET['code'])) {
                    echo "<a href='?page=$i&code={$_GET['code']}' class='$nowPage'> ";
                    echo $i;
                    echo " </a>";
                } else {

                    echo "<a href='?page=$i' class='$nowPage'> ";
                    echo $i;
                    echo " </a>";
                }
            }

            ?>
            <?php
            //顯示最後一頁
            if ($now <= ($pages - 3)) {
                if (isset($_GET['code'])) {
                    echo "...<a href='?page=$pages&code={$_GET['code']}'> ";
                    echo "$pages";
                    echo " </a>";
                } else {

                    echo "...<a href='?page=$pages'> ";
                    echo "$pages";
                    echo " </a>";
                }
            }
            ?>
        </div>
        <?php
        // 下一頁
        // 當前頁碼+1
        if (($now + 1) <= $pages) {
            $next = $now + 1;
            if (isset($_GET['code'])) {
                echo "<a href='?page=$next&code={$_GET['code']}'> ";
                echo "&gt ";
                echo " </a>";
            } else {

                echo "<a href='?page=$next'> ";
                echo "&gt ";
                echo " </a>";
            }
        } else {
            echo "<a class='noshow'>&nbsp;</a>";
        }


        ?>
    </div>

    <table class="list-students">

        <tr>
            <td>學號</td>
            <td>姓名</td>
            <td>身份證字號</td>
            <td>生日</td>
            <td>畢業國中</td>
            <td>年齡</td>
            <td>操作</td>
        </tr>
        <?php
        foreach ($rows as $row) {

            if (isset($_GET['code'])) {
                $url = "<a class='AUS' href=api/del_student.php?id={$row['id']}&page={$now}&code={$_GET['code']}>刪除</a>";
            } else {
                $url = "<a class='AUS' href=api/del_student.php?id={$row['id']}&page={$now}>刪除</a>";
            }
            $age = floor((strtotime('now') - strtotime($row['生日'])) / (60 * 60 * 24 * 365));

            echo "<tr>";
            echo "<td>{$row['學號']}&nbsp;</td>";
            echo "<td>{$row['姓名']}</td>";
            echo "<td>{$row['身份證字號']}</td>";
            echo "<td>{$row['生日']}</td>";
            echo "<td>{$row['畢業國中']}</td>";
            echo "<td>&nbsp$age</td>";
            echo "<td>";
            echo "<a href='edit.php?id={$row['id']}'>編輯</a>";
            echo  $url;
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php
    if (isset($_GET['page']) && !isset($_GET['code'])) {
    ?>
        <div class="BackHome1"><a href="<?= '?page=1' ?>">BACKHOME</a></div>
    <?php
    } else {;
    ?>
        <div class="BackHome2"><a href="<?= '?page=1' ?>">BACKHOME</a></div>
    <?php
    };
    ?>




    <!-- <script>
        function del_sure() {
            var aus = confirm("你真的確定要刪除嗎?");
            if (aus == true) {
                location.href = "./api/del_student.php?id=del_sure()}"
            } else {
                location.href = "index.php"

            }
        }
    </script> -->
    <script>
        var elems = document.getElementsByClassName('AUS');
        var confirmIt = function(stopall) {
            if (!confirm('你真的確定要刪除嗎?')) stopall.preventDefault();
        };
        for (var i = 0, l = elems.length; i < l; i++) {
            elems[i].addEventListener('click', confirmIt, false);
        }
    </script>

</body>

</html>