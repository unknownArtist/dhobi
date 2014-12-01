<?php
require_once('curl.php');

$uniquecode = $_REQUEST['uniquecode'];
$storeCode = $_REQUEST['storeCode'];
$discount = $_REQUEST['discount'];

$id = $_REQUEST['id'];
//var_dump(new DateTime($pickup));
$resultpromo = json_decode(updateObjectByIdInClass('PromoCode', $id, array('code' => ($uniquecode),'storeCode'=>($storeCode),'discount' =>($discount))), true);


if (isset($resultpromo['error']))

{
 header('location:createpromocode.php?msg=1');
}
else
{
 header('location:createpromocode.php?msg=2');
}