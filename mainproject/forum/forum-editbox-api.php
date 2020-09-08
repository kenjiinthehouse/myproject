<?php

require __DIR__ . './../parts/__connect_db.php';


header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
];



$editboxsql = "SELECT * FROM `forum` WHERE `sid`=?";



$openboxStmt = $pdo->prepare($editboxsql);
$openboxStmt->execute([
    $_POST['<script>ck</script>'],

]);


// echo $stmt->rowCount();
// echo 'ok';
if ($updateStmt->rowCount()) {
    $output['success'] = true;
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
