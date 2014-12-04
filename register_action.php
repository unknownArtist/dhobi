<?php 
require_once('curl.php');
require_once('swiftmailer-master/lib/swift_required.php');

error_reporting(0);
	$userinfo = [
		'email' 		=>	$_POST['email'],
		'password'		=>	$_POST['password'],
		'password2'		=>	$_POST['password2'],
		'username'		=>  $_POST['username'],
		'firstName'		=>  $_POST['fname'],
		'lastName'		=>	$_POST['lname'],
		'phoneNumber'	=>  $_POST['phone']
	];

	$userinfo['token'] = substr(md5(uniqid(rand(), true)), 16, 16);

	if($userinfo[password] === $userinfo[password2]) {
		$created = createObjectInClass('_User', $userinfo);
			if($created)
			{
				/* USING SWIFT MAIL */

				$to      = $userinfo['email'];
				$token   = $userinfo['token'];
				$link = "http://localhost:3000/verify_email.php?email=".$to."&token=".$token;
				// Create the mail transport configuration
				$transport = Swift_MailTransport::newInstance();
				// Create the message
				
				$message = Swift_Message::newInstance();
				$message->setTo(array($to => "KIFAYAT ULLAH"));
				$message->setSubject("Activate your email!");
				$message->setBody("<a href=".$link.">"."Confirm your account"."</a>",'text/html');
				$message->setFrom("kifayat.1234u@gmail.com");



				// Send the email
				$mailer = Swift_Mailer::newInstance($transport);
				$mailer->send($message);

				/* USING HTML MAIL */
				/*$to      = $userinfo['email'];
				$token   = $userinfo['token'];
				$subject = 'Confirm your account';
				$link = "http://localhost:3000/verify_email.php?email=".$to."&token=".$token;
				$message = "<a href='". $link. "'>" .'Conform your email'. "</a>\n\n";
				$from = "dhubi.com";
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From:' . $from;

				$m = mail($to, $subject, $message, $headers);*/

				header('location:login.php');
			}
	}else {
		echo "Password mismatch"; die();
	}
	

