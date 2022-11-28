<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:index.php");
    exit();
}
?>
<?php
//使用PDO方式建立資料庫連線物件
include "./db/base.php";
?>
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

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生管理系統</title>
    <link rel="stylesheet" href="style.css">

<body>
    <?php
    $do = $_GET['do'] ?? 'main';
    include_once "./layouts/header.php";
    ?>
    <h1>學生管理系統</h1>
    <?php

    $file = './back/' . $do . ".php";
    if (file_exists($file)) {
        include $file;
    } else {
        include "./back/main.php";
    }


    ?>
    <!-- <script>
        function delsure(Number) {
            // const GetName = document.querySelector('main').getElementsByTagName('div')[1].textContent;

            var parentElem = Number.parentElement.parentElement.children[1].textContent;
            // var parentElem1 = parentElem.parentElement;
            var quest = "你確定要刪除" + parentElem + "嗎?";
            if (confirm(quest)) {

            } else {
                return false
            }
        }
    </script>
    <script>
        var elems = document.getElementsByClassName('AUS');
        var targetName = document.getElementsByClassName('AUS')
        var parentElem = elems.parentElement.parentElement.children[1].textContent;
        var quest = "你確定要刪除嗎?";
        var confirmIt = function(stopall) {
            if (!confirm(quest)) stopall.preventDefault();
        };
        for (var i = 0, l = elems.length; i < l; i++) {
            elems[i].addEventListener('click', confirmIt, false);
        }
    </script> -->

</body>

</html>