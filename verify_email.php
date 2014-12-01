<?php
require_once('curl.php');

$email = $_GET['email'];
$token = $_GET['token'];

$user = json_decode(getObjectsInClass('_User', json_encode(array('email'=>$email))));

if($user) {
	
	if($user->results[0]->email == $email && $user->results[0]->token == $token) {
		if($user->results[0]->emailVerified) {
			echo 'Your email has already been verified';
		} else {
					$emailVerified = $user->results[0]->emailVerified = true;
					if($emailVerified) {
						echo 'Your email has verified';
					}else echo 'Email not verified';
				}
	}
	else {
		echo 'Problem with the link';
	}
}