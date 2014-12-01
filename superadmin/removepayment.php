<?php
require_once('curl.php');

$id = $_REQUEST['ID'];
//var_dump(new DateTime($pickup));
$result = json_decode(deleteObjectByIdInClass('CreditCard', $id), true);
if (isset($result['error'])) echo $result['error'];
else echo 'success';