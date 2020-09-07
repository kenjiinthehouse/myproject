<?php
session_start();

unset($_SESSION['loginok']);

# session_destroy(); // 清掉所有 session 資料

header('Location: user_index.php'); // redirect // 轉向
