<header class="mb-5">
    <div class="myHeader">
        <?php
        if($do == 'add' || $do == 'edit' || $do == 'add_news'){
            echo "<a href='admin_center.php'>回首頁</a>";
        }else{

            if (($do == 'login') || ($do == 'reg')) {
                echo "<a href='index.php'>回首頁</a>";
            } else {
                
                if (isset($_SESSION['login'])) {
                    echo "歡迎您!&nbsp";
                    echo $_SESSION['login']['name'];
                    ?>
                <nav>
                    <?php
                    echo "<a href='index.php'>回首頁</a>";
                    echo "<a href='admin_center.php?do=news'>管理新聞</a>";
                    echo "<a href='admin_center.php?do=students_list'>學生列表</a>";
                    echo "<a href='admin_center.php?do=add'>新增學生</a>";
                    echo "<a href='admin_center.php?do=logout'>教師登出</a>";
                    ?>
                </nav>
                <?php
            } else {
            ?>
                <nav>
                    <?php
                    echo "<a href='index.php'>回首頁</a>";
                    echo "<a href='index.php?do=students_list'>學生列表</a>";
                    echo "<a href='index.php?do=reg'>教師註冊</a>";
                    echo "<a href='index.php?do=login'>教師登入</a>";
                    echo "&nbsp;&nbsp;&nbsp;你沒有登入!";
                    ?>
                </nav>
                <?php
            }
        }
    }
        ?>

    </div>
</header>

<!-- 以下是老師的寫法，很有趣 -->
<!-- <header>
    <nav>
        <pre style="text-align:left!important"> -->
        <?php //print_r($_SERVER);?>
        <!-- </pre> -->
        <?php
        // $local=str_replace(['/','.php'],'',$_SERVER['PHP_SELF']) ;
            // switch($local){
                // case "index":
                    // echo "<a href='reg.php'>教師註冊</a>";
                    // echo "<a href='login.php'>教師登入</a>";
                // break;
                // case "admin_center":
                    // echo "<a href='admin_center.php?do=add'>新增學生</a>";
                    // <!-- <a href="?do=add">新增學生</a> -->
                    // echo "<a href='logout.php'>教師登出</a>";
                // break;
            // }
        ?>
    <!-- </nav> -->
<!-- </header> --> 