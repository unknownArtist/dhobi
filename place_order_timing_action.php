<?php 
require_once('curl.php');
ob_start();
error_reporting(0);
session_start();

$retrievaltime = explode("-", $_POST['retrievaltime']);
$delievertime = explode("-", $_POST['delievertime']);

$retrievalAtFrom = $retrievaltime[0]; 
$retrievalAtTo = $retrievaltime[1]; 


$delievertimeFrom = $delievertime[0];
$delievertimeTo = $delievertime[1];

$retrievalFrom =  $_POST["retrievalDate"]." ".$retrievalAtFrom; 
$retrievalTo = $_POST["retrievalDate"]." ".$retrievalAtTo;

$deliverFrom = $_POST["delieverDate"]." ".$delievertimeFrom; 
$deliverTo = $_POST["delieverDate"]." ".$delievertimeTo;



$userOrder = [
		'addressID' 		=>	$_POST['address'],
		'retrievalAtFrom'	=>  $retrievalFrom,
		'retrievalAtTo'		=>	$retrievalTo,

		'delieverAtFrom'	=>	$deliverFrom,
		'deliverAtTo'		=>  $deliverTo,

		'userID'			=>  $_SESSION['objectId'],
		'personalRequest'	=>	$_POST['personalRequest']
	];

	$orderPlaced = createObjectInClass('Order', $userOrder);
	if($orderPlaced)
	{	

		header('location:place_order_items.php');
	}