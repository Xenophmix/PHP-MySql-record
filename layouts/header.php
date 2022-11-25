<header>
    <div class="nav">
        <?php
        if (isset($_SESSION['login']))
            echo $_SESSION['login']['name'];
        else
            echo "你沒有登入"
        ?>
        這是抬頭區塊,好好玩
    </div>
</header>