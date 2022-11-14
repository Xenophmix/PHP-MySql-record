<!DOCTYPE html>
<html lang="en">

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

    <table class="list-students">

        <tr">
            <td>學號</td>
            <td>姓名</td>
            <td>身份證字號</td>
            <td>生日</td>
            <td>畢業國中</td>
            <td>年齡</td>
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
            echo "</tr>";
        }
        ?>
    </table>


</body>

</html>