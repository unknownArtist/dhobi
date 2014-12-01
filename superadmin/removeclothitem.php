<?php
require_once('curl.php');

$id = $_REQUEST['id'];
//var_dump(new DateTime($pickup));
$result = json_decode(deleteObjectByIdInClass('Cloth', $id), true);
if (isset($result['error']))
{
 header('location:addedititemlist.php?msg=1');
}
else
{
 header('location:addedititemlist.php?msg=2');
}