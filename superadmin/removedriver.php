<?php
require_once('curl.php');

$id = $_REQUEST['id'];
//var_dump(new DateTime($pickup));
$result = json_decode(deleteObjectByIdInClass('Driver', $id), true);
if (isset($result['error']))
{
 header('location:pickupdeliverycounttime.php?msg=1');
}
else
{
 header('location:pickupdeliverycounttime.php?msg=2');
}