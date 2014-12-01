<?php
require_once('curl.php');

$pickup = $_REQUEST['unicode'];

$id = $_REQUEST['id'];
//var_dump(new DateTime($pickup));
$result = json_decode(updateObjectByIdInClass('Store', $id, array('minimumOrderValue' => ((float)$pickup))), true);
if (isset($result['error']))
{
 header('location:setorderminimum.php?msg=1');
}
else
{
 header('location:setorderminimum.php?msg=2');
}