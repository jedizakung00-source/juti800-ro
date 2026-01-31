<?php
/* Web design and coded by https://www.eddga-studio.com */
/*
* ระบบนี้จัดทำโดย eddga-studio ห้ามจำหน่ายโดยเด็ดขาด
* หากแก้ไข ถือว่าเป็นการละเมิดลิขสิทธิ์ซอฟท์แวร์ มีโทษปรับตั้งแต่ 10,000 บาท จนถึง 200,000 บาท จำคุก 3-6 เดือน หรือทั้งจำทั้งปรับ
* https://www.facebook.com/eddgastudio.official
*/
//===============================================================
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
date_default_timezone_set('Asia/Bangkok');
//===============================================================
// Database Ragnarok (PDO Configuration)
//===============================================================
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'ragnarok';
$port = '3306';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>