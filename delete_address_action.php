<?php 
require_once('curl.php');
ob_start();
error_reporting(0);
session_start();

$objectID = $_GET['id'];
if($objectID)
{
	$deleted = deleteObjectByIdInClass('Address', $objectID);

	if($deleted)
	{
		header('location:where_am_i.php');
	}
}
