<!DOCTYPE html>
<html lang="en">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@500&display=swap" rel="stylesheet">

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
        $sql = "SELECT `students`.`id` as 'id' ,
                `students`.`school_num` as '學號',
                 `students`.`name` as '姓名',
                 `students`.`uni_id` as '身份證字號',
                 `students`.`birthday` as '生日',
                 `students`.`graduate_at` as '畢業國中'
          FROM `class_student`,`students` 
          WHERE `class_student`.`school_num`=`students`.`school_num` && 
                `class_student`.`class_code`='{$_GET['code']}'";
    } else {
        //建立撈取學生資料的語法，限制只撈取前20筆
        $sql = "SELECT `students`.`id` as 'id' ,
                 `students`.`school_num` as '學號',
                 `students`.`name` as '姓名',
                 `students`.`uni_id` as '身份證字號',
                 `students`.`birthday` as '生日',
                 `students`.`graduate_at` as '畢業國中'
          FROM `students` LIMIT 20";
    }
    //執行SQL語法，並從資料庫取回全部符合的資料，加上PDO::FETCH_ASSOC表示只需回傳帶有欄位名的資料
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    ?>

<body>
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
            echo "<a class='AUS' href='./api/del_student.php?id={$row['id']}' onclick=del_sure()>刪除</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
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
    var confirmIt = function (stopall) {
        if (!confirm('你真的確定要刪除嗎?')) stopall.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>

</body>

</html>