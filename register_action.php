<?php 



require_once('curl.php');

error_reporting(0);
	$userinfo = [
		'email' 		=>	$_POST['email'],
		'password'		=>	sha1($_POST['password']),
		'password2'		=>	sha1($_POST['password2']),
		'username'		=>  $_POST['username'],
		'firstName'			=>  $_POST['fname'],
		'LastName'			=>	$_POST['lname'],
		'phoneNumber'			=>  $_POST['phone']
	];

	$userinfo['token'] = substr(md5(uniqid(rand(), true)), 16, 16);

	if($userinfo[password] === $userinfo[password2]) {
		$created = createObjectInClass('_User', $userinfo);
			if($created)
			{
				$to      = $userinfo['email'];
				$token   = $userinfo['token'];
				$subject = 'Confirm your account';
				$link = "http://localhost:3000/verify_email.php?email=".$to."&token=".$token;
				$message = "<a href='". $link. "'>" .'Conform your email'. "</a>\n\n";
				$from = "dhubi.com";
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From:' . $from;

				$m = mail($to, $subject, $message, $headers);

				header('location:login.php');
			}
	}else {
		echo "Password mismatch"; die();
	}
	

