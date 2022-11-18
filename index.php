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
</head>
<?php
// $dsn="mysql:host=localhost;charset=utf8;dbname=school";
$db = mysqli_connect('localhost', 'root', '', 'school');
mysqli_set_charset($db, 'utf8');
// SELECT * FROM `students` ORDER BY `id` DESC LIMIT 20 可以改成後到前
$sql = "SELECT * FROM `students` LIMIT 20";
$result = mysqli_query($db, $sql);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);




// $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
// $pdo = new PDO($dsn, 'root', '');

// echo "<pre>";
// print_r($rows);
// echo "</pre>";

?>

<body>
    <h1>學生管理系統</h1>
    <nav>
        <a href="add.php">新增學生</a>
        <a href="reg.php">教師註冊</a>
        <a href="login.php">教師登入</a>
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

            $age = floor((strtotime('now') - strtotime($row['birthday'])) / (60 * 60 * 24 * 365));

            echo "<tr>";
            echo "<td>{$row['school_num']}&nbsp;</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['uni_id']}</td>";
            echo "<td>{$row['birthday']}</td>";
            echo "<td>{$row['graduate_at']}</td>";
            echo "<td>&nbsp$age</td>";
            echo "<td>";
            echo "<a href='edit.php?id={$row['id']}'>編輯</a>";
            echo "<a href='del.php?id={$row['id']}'>刪除</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>


</body>

</html>