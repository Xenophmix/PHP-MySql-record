<?php
//使用PDO方式建立資料庫連線物件
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');


date_default_timezone_set("Asia/Taipei");
