<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:index.php");
    exit();
}
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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>學生管理系統</title>
    <link rel="stylesheet" href="style.css">

<body>
    <?php
    if (isset($_GET['del'])) {
        $name = $pdo->query("SELECT `name` FROM `students` WHERE `id` = '{$_GET['del']}'")
            ->fetchColumn();
        echo "<div class='del-msg'>";
        echo $_GET['del'];
        echo "</div>";
    }

    include_once "./layouts/header.php";

    ?>
    <h1>學生管理系統</h1>
    <nav>
        <a href="add.php">新增學生</a>
        <a href="reg.php">教師註冊</a>
        <a href="logout.php">教師登出</a>
    </nav>
    <?php
    include "./layouts/class_nav.php"
    ?>
    <?php
    include "./back/main.php"
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