<?php
if (!isset($page_name)) $page_name = '';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">管理後台</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= $page_name == 'admin_home' ? 'active' : '' ?>">
                    <a class="nav-link" href="./admin_home_page.php">首頁</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Podcast相關管理
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./podcast_channel_info.php">Podcast頻道編輯</a>
                        <a class="dropdown-item" href="#">Podcast音檔管理</a>
                    </div>
                </li>

            </ul>
            <?php if (isset($_SESSION['admin'])) : ?>
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link"><?= $_SESSION['admin']['admin_nickname'] ?></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./logoutsql.php">登出</a>
                    </li>
                </ul>
            <?php else : ?>
                <ul class="navbar-nav">
                    <li class="nav-item <?= $page_name == 'loginSqlPage' ? 'active' : '' ?>">
                        <a class="nav-link" href="./loginsql.php">登入</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>

</nav>

<style>
    .active {
        background-color: lightseagreen;
        border-radius: 5px;
    }
</style>