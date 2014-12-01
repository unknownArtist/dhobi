<?php 
require_once('curl.php');
ob_start();
error_reporting(0);
session_start();
// $r_date = $_POST['retrievalDate'];
// $r_time = $_POST['retrievaltime'];


$userOrder = [
		'addressID' 		=>	$_POST['address'],
		'retrievalAtFrom'	=>  $retreivalFrom,
		'delieverAtFrom'	=>	$_POST['delieverDate'],
		'userID'			=>  $_SESSION['objectId'],
		'personalRequest'	=>	$_POST['personalRequest']
	];

	$orderPlaced = createObjectInClass('Order', $userOrder);
	if($orderPlaced)
	{
		header('location:place_order_items.php');
	}