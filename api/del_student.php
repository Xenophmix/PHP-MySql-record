<?php
include "../db/base.php";


$student = $pdo->query("SELECT * FROM `students` WHERE `id` = '{$_GET['id']}'")
  ->fetch(PDO::FETCH_ASSOC);
$sql_class = "DELETE FROM `class_student` WHERE `school_num` = '{$student['school_num']}'";
$sql_student = "DELETE FROM `students` WHERE `id` = '{$_GET['id']}'";

echo $sql_class;
echo "<br>";
echo $sql_student;
echo "<br>";


if (isset($_GET['code'])) {
  $url = "location:../admin_center.php?del=已成功刪除學生{$student['name']}的所有資料!!&page={$_GET['page']}&code={$_GET['code']}&do=students_list";
} else {
  $url = "location:../admin_center.php?del=已成功刪除學生{$student['name']}的所有資料!!&page={$_GET['page']}&do=students_list";
}
// header($url);
$res_class = $pdo->exec($sql_class);
$res_student = $pdo->exec($sql_student);
echo $res_class;
echo "<br>";
echo $res_student;
echo "刪除成功:";

header($url);
//