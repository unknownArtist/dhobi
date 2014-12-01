<?php
require_once('curl.php');

$id = $_REQUEST['id'];
//var_dump(new DateTime($pickup));
$result = json_decode(deleteObjectByIdInClass('PromoCode', $id), true);


if (isset($result['error']))
{
 header('location:createpromocode.php?msg=1');
}
else
{
 header('location:createpromocode.php?msg=2');
}