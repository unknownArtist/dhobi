<?php
require_once('curl.php');

$cloth = $_REQUEST['name'];
 $price = $_REQUEST['price'];
$short = $_REQUEST['short'];
 $storeCode = $_REQUEST['storeCode'];


$id = $_REQUEST['id'];
//var_dump(new DateTime($pickup));

 $resultcloth = json_decode(updateObjectByIdInClass('Cloth', $id, array('name' =>$cloth,'price'=>(float)$price, 'shortName' =>$short,'storeid'=>$storeCode)), true);


if (isset($resultcloth['error']))
{
 header('location:addedititemlist.php?msg=1');
}
else
{
 header('location:addedititemlist.php?msg=2');
}