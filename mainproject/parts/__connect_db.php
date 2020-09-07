<?php
// $db_host = '192.168.27.155';
// $db_name = 'mfee09_project';
// $db_user = 'kenji';
// $db_pass = '0000';

$db_host = 'localhost';
$db_name = 'mfee09_project';
$db_user = 'root';
$db_pass = '';

$dns = "mysql:host={$db_host};dbname={$db_name};";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
];

$pdo = new PDO($dns, $db_user, $db_pass, $pdo_options);

if (!isset($_SESSION)) {
    session_start();
};
