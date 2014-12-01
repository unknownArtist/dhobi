<?php 
require_once('curl.php');
ob_start();
/*error_reporting(0);*/
session_start();
	$user = [
		'username' 		=>	$_POST['username'],
		'password'		=>	$_POST['password'],
		'firstName'		=>	$_POST['firstName'],
		'lastName'		=>	$_POST['lastName'],
		'phoneNumber'	=>	$_POST['phoneNumber']
	];

	$email_regex = "/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/"; 

	if(!$user['username'])
		{
			
			echo json_encode("Please insert your email"); return;

		}else if(!(preg_match($email_regex, $user['username'])))
				{
					echo json_encode("Invalid email"); return;
				}

	if(!$user['password'])
		{
			
			echo json_encode("Please insert your password"); return;

		}

	if(!$user['firstName'])
		{
			
			echo json_encode("Please insert first name"); return;

		}else if(!(preg_match('/^[-a-zA-Z .]+$/', $user['firstName'])))
				{
					echo json_encode("Invalid character inserted in first name field"); return;
				}

	if(!$user['lastName'])
		{
			
			echo json_encode("Please insert last name"); return;

		}else if(!(preg_match('/^[-a-zA-Z .]+$/', $user['lastName'])))
				{
					echo json_encode("Invalid character inserted in last name field"); return;
				}

	if(!$user['phoneNumber'])
		{
			
			echo json_encode("Please insert phone number"); return;

		}else if(!(preg_match('/^[-0-9.]+$/', $user['phoneNumber'])))
				{
					echo json_encode("Only numbers allowed in phone number field"); return;
				}


	/*if ( preg_match( $regex, $user['username'] ) ) {
	     echo $user['username'] . " is an invalid email. Please try again";
	} */


	if(empty($user['password']))
	{
		unset($user['password']);
	}
	$update = updateUser($_SESSION['objectId'], $user,$_SESSION['sessionToken']);

	if($update)
	{
		header('location:who_am_i.php');
	}
	
 ?>