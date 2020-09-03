<?php
require __DIR__ . '/parts/__connect_db.php';
require __DIR__ . '/parts/__admin_required.php';

$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'podcast_channel_info.php';

if (empty($_GET['id'])) {
    header('Location: ' . $referer);
    exit;
}
$id = intval($_GET['id']) ?? 0;

$pdo->query("DELETE FROM podcast_channel_info WHERE sid=$id ");
header('Location: ' . $referer);
