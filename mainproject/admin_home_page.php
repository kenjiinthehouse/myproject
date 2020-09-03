<?php
$page_title = '管理後臺首頁';
$page_name = 'admin_home';
require __DIR__ . '/parts/__connect_db.php';
?>

<?php include __DIR__ . '/parts/__head_page.php'; ?>
<?php include __DIR__ . '/parts/__navbar_page.php'; ?>
<div class="content container">
    <h1>管理者你好~</h1>
</div>
<?php include __DIR__ . '/parts/__script_page.php'; ?>
<?php include __DIR__ . '/parts/__foot_page.php'; ?>