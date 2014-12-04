<?php
require_once('curl.php');

$email = $_GET['email'];
$token = $_GET['token'];

$user = json_decode(getObjectsInClass('_User', json_encode(array('email'=>$email))));

if($user) {
	
	if($user->results[0]->email == $email && $user->results[0]->token == $token) {

		/*if($user->results[0]->emailVerified) {
			
			header('location:login.php');
		} else {*/    
					
					$emailVerified = $user->results[0]->emailVerified = 1;
					if($emailVerified) {
						header('location:login.php');
					}else echo 'Email not verified';
				/*}*/
	}
	else {
		echo 'Problem with the link';
	}
}