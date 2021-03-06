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
                <?php /* <li class="nav-item <?=  $page_name == 'admin_home' ? 'active' : ''  ?>">    */ ?>
                <li class="nav-item">
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

                <li class="nav-item">
                    <a class="nav-link" href="./forum.php">國家機器</a>
                </li>

            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['loginok'])) : ?>
                    <li class="nav-item ">
                        <a class="nav-link"><?= $_SESSION['loginok']['nickname'] ?></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="f-logout.php">登出</a>
                    </li>

            </ul>
        <?php else : ?>
            <ul class="navbar-nav">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
                    登入
                </button>

                <!-- Modal -->
                <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">登入入入</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" name="check_form" onsubmit="checkAccount(); return false;">
                                    <div class="form-group">
                                        <label for="account">Account</label>
                                        <input type="email" class="form-control" id="account" name="account" placeholder="使用email地址登入你的帳號">
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="buttons d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary" style="margin-right: 5px;">登入</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">不登</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        <?php endif;  ?>
        </div>
    </div>

</nav>

<style>
    .active {
        background-color: lightseagreen;
        border-radius: 5px;
    }
</style>
<script>
    function checkAccount() {
        const check_login = new FormData(document.check_form);
        fetch('f-login-api.php', {
                method: 'POST',
                body: check_login
            })
            .then(r => r.json())
            .then(obj => {
                console.log(obj);
                if (obj.authority) {
                    alert('登入成功');
                    location.href = 'forum.php';
                } else if (obj.success) {
                    alert('登入成功');
                    location.href = 'user_index.php';
                } else {
                    alert('登入失敗');
                }
            });
    }
</script>