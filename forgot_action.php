<?php
session_start();

require_once 'curl.php';
require_once('swiftmailer-master/lib/swift_required.php');

$userEmail = $_POST['email'];

$getUser = getObjectsInClass('_User',json_encode(array('username'=>$_POST['email']))); 

$getUser = json_decode($getUser); 

$getUserEmail = $getUser->results[0]->username; 
$getUserPass = $getUser->results[0]->password2; 

if($getUserEmail != null) {

/* USING SWIFT MAIL */

// Create the mail transport configuration
$transport = Swift_MailTransport::newInstance();

// Create the message
$message = Swift_Message::newInstance();
$message->setTo(array($userEmail => "KIFAYAT ULLAH"));
$message->setSubject("Get your password");
$message->setBody("Your password:"." "."<b>".$getUserPass."</b>",'text/html');
$message->setFrom("kifayat.1234u@gmail.com");



// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message);

header('location:login.php'); die();
} else {
	$_SESSION['unregisteredEmail'] = 'This email is not registered!';
	header('location:forgot.php');
}
