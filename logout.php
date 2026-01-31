<?php
/* Web design and coded by https://www.eddga-studio.com */
/*   
* ระบบนี้จัดทำโดย eddga-studio ห้ามจำหน่ายโดยเด็ดขาด
* หากแก้ไข ถือว่าเป็นการละเมิดลิขสิทธิ์ซอฟท์แวร์ มีโทษปรับตั้งแต่ 10,000 บาท จนถึง 200,000 บาท จำคุก 3-6 เดือน หรือทั้งจำทั้งปรับ
* https://www.facebook.com/eddgastudio.official
*/
session_start();
ob_start();
$_SESSION = array();
session_destroy();

header("location: login.php");

ob_end_flush();
exit;
?>