<?php
require_once('curl.php');
/*function getProperDateFormat($value)
  {
    $dateFormatString = 'Y-m-d\TH:i:s.u';
    $date = date_format($value, $dateFormatString);
    $date = substr($date, 0, -3) . 'Z';
    return $date;
  }*/
$pickup = $_REQUEST['PICKUP'];
$delivery = $_REQUEST['DELIVERY'];
$pickupto = $_REQUEST['PICKUPTO'];
$deliveryto = $_REQUEST['DELIVERYTO'];
$pickupdate	=	$_REQUEST['PICKUPDATE'];
$pickupdateto	=	$_REQUEST['PICKUPDATETO'];
$deliverydate = $_REQUEST['DELIVERYDATE'];
$deliverydateto = $_REQUEST['DELIVERYDATETO'];

$pickupdatetime		=	$pickupdate." ".$pickup;
$pickupdatetimeto	=	$pickupdateto." ".$pickupto;
$deliverydatetime	=	$deliverydate." ".$delivery;
$deliverydatetimeto	=	$deliverydateto." ".$deliveryto;

$id = $_REQUEST['ID'];
//var_dump(new DateTime($pickup));




$result = json_decode(updateObjectByIdInClass('Store', $id, array('pickupTime' => ($pickupdatetime),'pickupTimeto'=>($pickupdatetimeto), 'deliveryTime' => ($deliverydatetime),'deliveryTimeto' => ($deliverydatetimeto))), true);
if (isset($result['error'])) echo $result['error'];
else echo 'success';