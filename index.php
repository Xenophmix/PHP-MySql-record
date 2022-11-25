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
  include "./db/base.php";
  ?>

<body>
  <?php
  include_once "./layouts/header.php";
  ?>
  <h1>學生管理系統</h1>
  <nav>
    <a href="reg.php">教師註冊</a>
    <a href="login.php">教師登入</a>
  </nav>
  <?php
  include "./layouts/class_nav.php"

  ?>
  <?php
  include "./front/main.php"
  ?>
</body>

</html>