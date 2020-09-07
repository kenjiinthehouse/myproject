<?php
require __DIR__ . './../parts/__connect_db.php';

header('Content-Type: application/json');

$output = [
    'success' => false,
    'authority' => '',
    'postData' => $_POST,
    'code' => 0,
    'error' => ''

];

$account = isset($_POST['account']) ? $_POST['account'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';


$sql = "SELECT * 
FROM `forum_testaccount` 
WHERE `account`=? AND `password`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $account,
    $password,
]);




$authoritycheck =  "SELECT `authority` 
FROM `forum_testaccount` 
WHERE `account`='$account' AND `password`='$password'";

$adminstmt = $pdo->query($authoritycheck)->fetch();
$authority = filter_var($adminstmt['authority'], FILTER_VALIDATE_BOOLEAN);


$output['authority'] = $authority;



if ($stmt->rowCount()) {
    $output['success'] = true;
    $_SESSION['loginok'] = $stmt->fetch();
}





echo json_encode($output, JSON_UNESCAPED_UNICODE);
