<?php

require __DIR__ . './../parts/__connect_db.php';


header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
];

$sql = "INSERT INTO `forum`
(`sid`, `member_id`, `content`, `add_points`, `lose_points`, `accuse_points`, `post_time`) 
VALUES ( NULL, ?, ?, default, default, default, now())";


$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['member_id'],
    $_POST['forum-content'],
]);


// echo $stmt->rowCount();
// echo 'ok';
// if ($stmt->rowCount()) {
//     $output['success'] = true;
// }


// echo json_encode($output, JSON_UNESCAPED_UNICODE);
