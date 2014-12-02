<?php
ob_start();
/*error_reporting(0);*/
session_start();
require_once('curl.php');

$password = sha1($_POST['password']);

$userInfo = json_decode(getObjectByIdInClass('_User', $_SESSION['objectId']));

if($password == $userInfo->password2)
{
	header('location:who_am_i.php');
}else header('location:conform_identity.php');

?>