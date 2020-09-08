<?php

require __DIR__ . './../parts/__connect_db.php';


header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
];


// UPDATE `forum` SET `content`='6666666', `post_time`=NOW() WHERE `member_id`='S級火槍兵' AND `sid`=167
// $sql = "INSERT INTO `forum`
// (`sid`, `member_id`, `content`, `add_points`, `lose_points`, `accuse_points`, `post_time`) 
// VALUES ( NULL, ?, ?, default, default, default, now())";

$updateSql = "UPDATE `forum` 
SET `content`=?, `post_time`=NOW() 
WHERE `sid`=?";

$updateStmt = $pdo->prepare($updateSql);
$updateStmt->execute([
    $_POST['forum-content2'],
    $_POST['sid'] = $r['sid'],
]);


// echo $stmt->rowCount();
// echo 'ok';
if ($updateStmt->rowCount()) {
    $output['success'] = true;
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
