<?php 
require_once('curl.php');
ob_start();
error_reporting(0);
session_start();

$orderInfo = [

		'totalcost'			=>	'$ '.$_POST['totalcost'],
		'storeCode'			=>   $_POST['storecode'],
	
	];

if($_POST['promocode'])
{
	$promoCode = json_decode(getObjectsInClass('PromoCode', json_encode(array('code'=>$_POST['promocode']))));

	if($promoCode->results[0]->code == $_POST['promocode'])
	{
		$orderInfo['promoMatched'] = 'YES';
		$_SESSION['discount'] = $promoCode->results[0]->discount;
	}else 
		{
			$orderInfo['promoMatched'] = 'NO';
		}
	
}

$order = getObjectsInClass('Order', json_encode(array('userID'=>$_SESSION['objectId'])));
$order = json_decode($order);

	$updated = updateObjectByIdInClass('Order', $order->results[0]->objectId, $orderInfo);

	if($updated)
	{	
		header('location:place_order_confirmation.php');
	}
