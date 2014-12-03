<?php 
require_once('curl.php');
ob_start();
error_reporting(0);
session_start();

$expiryDate = strtotime("28-".$_POST['expiryAt']);

$userCreditCardInfo = [
		'number' 			=>	$_POST['number'],
		'expireAt'			=>  $expiryDate,
		'cvc'				=>	$_POST['cvc'],
		'userID'			=>  $_SESSION['objectId'],
		'billingZipCode'	=>	$_POST['billingZipCode']
	];	
$delId = $_GET['delId'];
	if($delId)
	{ 
		$deleted = deleteObjectByIdInClass('CreditCard', $delId);
		if($deleted)
		{
			header('location:how_do_i_pay.php');
		}
	} 

	if(!$userCreditCardInfo['number'])
		{
			
			echo json_encode("Please insert your number"); return;

		}else if(!(preg_match('/^[-0-9.]+$/', $userCreditCardInfo['number'])))
				{
					echo json_encode("Invalid number"); return;
				}

	if(!$userCreditCardInfo['expireAt'])
		{
			
			echo json_encode("Please insert expiry date"); return;

		}

	if(!$userCreditCardInfo['cvc'])
		{
			
			echo json_encode("Please insert cvc"); return;

		}else if(!(preg_match('/^[-0-9.]+$/', $userCreditCardInfo['cvc'])))
				{
					echo json_encode("Invalid character inserted in cvc field"); return;
				}


	if(!$userCreditCardInfo['billingZipCode'])
		{
			
			echo json_encode("Please insert billing zip code"); return;

		}else if(!(preg_match('/^[-0-9.]+$/', $userCreditCardInfo['billingZipCode'])))
				{
					echo json_encode("Invalid characters inserted in billing zip code field"); return;
				}




	$objectID = $_POST['objectId']; 
	
	if($objectID)
	{
		$updated = updateObjectByIdInClass('CreditCard', $objectID, $userCreditCardInfo);
		if($updated)
		{   
			header('location:how_do_i_pay.php');
		}
	}else
		{ 

			$created = createObjectInClass('CreditCard', $userCreditCardInfo); 
			if($created)
			{
				header('location:how_do_i_pay.php');
				die();
			}
		}

	