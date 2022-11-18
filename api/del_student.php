<?php
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');

$sql = "DELETE FROM `students` WHERE `name`='廖添丁'";

//$pdo->query($sql);
$res = $pdo->exec($sql);
echo "刪除成功:" . $res;
