<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require_once 'functions/PHPMailer/PHPMailer.php';
require_once 'functions/PHPMailer/Exception.php';
require_once 'functions/PHPMailer/SMTP.php';
$mail = new PHPMailer();
$mail->CharSet = 'UTF-8';
// Настройки SMTP
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPDebug = 0;
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$message = htmlspecialchars($_POST['message']);
$subject = "От гостя сайта kirogazcor.ru - ".$name." (".$email.")";
$subject = "=?utf-8?B?".base64_encode($subject)."?=";
//$mail->Host = 'smtp.yandex.ru';
$mail->Host = '...';
$mail->SMTPSecure = false;
$mail->SMTPAutoTLS = false;
//$mail->SMTPSecure = 'ssl';
$mail->Port = 25;
$mail->Username = '...';
$mail->Password = '...';
// От кого
$mail->setFrom('...', 'сайт (не отвечать)');
// Кому
$mail->addAddress('personal@kirogazcor.ru', 'Кирилл Егоров');
// Тема письма
$mail->Subject = $subject;
// Тело письма
$body = '<p><strong>'.$message.'</strong></p>';
$mail->msgHTML($body);
// Приложение
//$mail->addAttachment(__DIR__ . '/image.jpg');
if($mail->send())
echo "Сообщение отправлено";
else
echo 'Ошибка: '.$mail->ErrorInfo;