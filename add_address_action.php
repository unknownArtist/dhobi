<?php 
require_once('curl.php');
ob_start();
error_reporting(0);
session_start();
	$userinfo = [
		'address' 		=>	$_POST['address'],
		'aptNumber'		=>	$_POST['aptNumber'],
		'zipCode'		=>	$_POST['zipCode'],
		'userID'		=>  $_SESSION['objectId'],
		'category'		=>  $_POST['location']
	];
// form validation

	if(!$userinfo['address'])
		{
			
			echo json_encode("Please insert address"); return;

		}else if(!(preg_match('/^[-a-zA-Z0-9 .]+$/', $userinfo['address'])))
				{
					echo json_encode("Invalid character inserted"); return;
				}
				
			

	if(!$userinfo['aptNumber'])
		{
			echo json_encode("Please insert APT Number"); return;

		}else if(!(preg_match('/^[-0-9.]+$/', $userinfo['aptNumber'])))
				{
					echo json_encode("Only numbers allowed in ATP number field"); return;
				}
				
			

	if(!$userinfo['zipCode'])
		{
			echo json_encode("Please insert Zip Code"); return;
		}else if(!(preg_match('/^[-0-9 .]+$/', $userinfo['zipCode'])))
				{
					echo json_encode("Only numbers allowed in Zip Code field"); return;
				}

	if(!$userinfo['category'])
		{
			echo json_encode("Please select category"); return;
		}else if(!(preg_match('/^[-a-zA-Z .]+$/', $userinfo['location'])))
				{
					echo json_encode("Invalid location name"); return;
				}
					



	$objectID = $_GET['id'];
	if($objectID)
	{
		$updated = updateObjectByIdInClass('Address', $objectID, $userinfo);
			if($updated)
			{
				header('location:where_am_i.php');
			}
	}else
		{
			$created = createObjectInClass('Address', $userinfo);
			if($created)
			{

				header('location:where_am_i.php');
			}
		}
	
 ?>