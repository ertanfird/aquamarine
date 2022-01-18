<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
require './PHPMailer/src/OAuth.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'phpmailer/language/');
$mail->isHTML(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;                  //Enable verbose debug output
$mail->isSMTP();                                        //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
$mail->SMTPAuth   = true;                               //Enable SMTP authentication
$mail->Username   = '@gmail.com';                     	//SMTP username
$mail->Password   = '';                               	//SMTP password
$mail->SMTPSecure = 'tls';            					//Enable implicit TLS encryption
$mail->Port       = 587;    

$mail->setFrom('@gmail.com');
$mail->addAddress('prohorovtula1@gmail.com');
$mail->Subject = "Контакты";

$body = '<h1>Контакты</h1>';

if(trim(!empty($_POST['name']))) {
	$body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
}
if(trim(!empty($_POST['tel']))) {
	$body.='<p><strong>Tel:</strong> '.$_POST['tel'].'</p>';
}

$mail->Body = $body;



if (!$mail->send()) {
	$message = 'Error';
} else {
	$message = 'Данные отправленны!';
}


$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);

$mail->smtpClose();

?>
