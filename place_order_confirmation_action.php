<?php 
require_once('curl.php');
ob_start();
error_reporting(0);
session_start();

$PlaceOrder = [

		'totalcost'			=>	$_POST['totalcost'],
		'creditCardIndex'	=> $_POST['creditcard']

	];
$userId = getObjectsInClass('Order', json_encode(array('userID'=>$_SESSION['objectId'])));
$getUserId = json_decode($userId);

	$updated = updateObjectByIdInClass('Order', $getUserId->results[0]->objectId, $PlaceOrder);

	if($updated)
	{	
		header('location:placed_order_status.php');
	}
