<?php
require_once('curl.php');

$pickup = $_REQUEST['DATA'];

$id = $_REQUEST['ID'];
//var_dump(new DateTime($pickup));
$result = json_decode(updateObjectByIdInClass('Driver', $id, array('userCode' => ($pickup))), true);

if (isset($result['error'])) echo $result['error'];
else echo 'success';