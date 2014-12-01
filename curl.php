<?php
$systemAdminID = '6hd7KrPlpm';
function curl_postt($url)
{	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	if (substr($_SERVER['HTTP_HOST'], 0, 8) == '192.168.'
		|| strtolower(substr($_SERVER['HTTP_HOST'], 0, 9)) == 'localhost')
	curl_setopt($ch, CURLOPT_PROXY, '192.168.3.3:808');  
	curl_setopt($ch, CURLOPT_REFERER, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	if ($params) curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
	$result = curl_exec($ch);
	if ($result === false) echo 'xml';
	curl_close($ch);
	
	return $result;
}
function curl_post($url, $method='get', $params = false, $post_count = 1, $sessionString = null)
{	
	$ch = curl_init();
	$MyApplicationId = 'S5u8GnGMn7VHYXcuzilLb3Jj5JbpDyn232kwXy1H';
	$MyParseRestAPIKey = '8IsQa3Ax0yvIfwYfMyLrA0KbkcS8g0840sFLnSYS';
	//$sessionString	=	'pnktnjyb996sj4p156gjtp4im';
	$ch = curl_init();
	$headers = array(
	    "Content-Type: application/json",
	    "X-Parse-Application-Id: " . $MyApplicationId,
	    "X-Parse-REST-API-Key: " . $MyParseRestAPIKey
	);
	if ($sessionString) 
		$headers[]= 'X-Parse-Session-Token: ' . $sessionString;
		
				
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_URL, $url);
	
	/*if (substr($_SERVER['HTTP_HOST'], 0, 8) == '192.168.'
		|| strtolower(substr($_SERVER['HTTP_HOST'], 0, 9)) == 'localhost')
	curl_setopt($ch, CURLOPT_PROXY, '192.168.3.43:808');  */
	
	curl_setopt($ch, CURLOPT_REFERER, $url);
	//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	if ($params) {
		curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
		curl_setopt($ch, CURLOPT_POST, $post_count);
	}
	    $result = curl_exec($ch);
	if ($result === false){
	var_dump(curl_error($ch));
	return 'etu';
	}
	curl_close($ch);
	
	return $result;
}
//curl_post('https://api.parse.com/1/classes/Cloth/Ndv4deyDyW', 	'GET'));
function getAllObjectsInClass($className)
{
	return (curl_post("https://api.parse.com/1/classes/$className", 'GET'));
}
function getObjectByIdInClass($className, $objectID)
{
	return (curl_post("https://api.parse.com/1/classes/$className/$objectID", 	'GET'));
}
function createObjectInClass($className, $object)
{
	return curl_post("https://api.parse.com/1/classes/$className", 	'POST', json_encode($object));
}
function updateObjectByIdInClass($className, $objectID, $newObject)
{
	return curl_post("https://api.parse.com/1/classes/$className/$objectID",'PUT', json_encode($newObject));
}
function deleteObjectByIdInClass($className, $objectID)
{
	return curl_post("https://api.parse.com/1/classes/$className/$objectID", 	'DELETE');
}
function batchStatements($className, $data)
{
	return curl_post("https://api.parse.com/1/batch", 	'POST', json_encode($data));
}
function getObjectsInClass($className, $where)
{
	return curl_post("https://api.parse.com/1/classes/$className?where=" . urlencode($where));
}
function addUser($obj)
{
	return curl_post("https://api.parse.com/1/users", 'POST', json_encode($obj));
}
function getUsers($objectID)
{
	return curl_post("https://api.parse.com/1/users/$objectID", 'GET');
}
function requestPasswordReset($email)
{
	return curl_post("https://api.parse.com/1/requestPasswordReset", 'POST', json_encode(array('email' => $email)));
}
function login($username, $password) 
{
	$data = array(
		'username' => urlencode($username),
		'password' => urlencode($password)
	);
	$fields_string = '';
	// URL-IFY
	foreach($data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
	rtrim($fields_string, '&');

	$result = curl_post('https://api.parse.com/1/login?' . $fields_string, 'GET');
	return $result;
}

function updateUser($userID, $obj,$session)
{  
	return curl_post("https://api.parse.com/1/users/$userID", "PUT", json_encode($obj), 1, $session);
}
function loadClassFromParse($className)
{
	$result = json_decode(getObjectsInClass($className, '{}'), true);
	$id = ($className == 'PromoCode' ? 'code' : 'objectId');
	$b = array();
	foreach ($result['results'] as $a)
		$b[$a[$id]] = $a;
	return $b;
}

function push_notification($message)
{
return curl_post("https://api.parse.com/1/push", 'POST', json_encode(array('where' => array('deviceType' => 'ios'), 'data' => array('alert'=>$message))));
}

/*function push_notification($message)
{
return curl_post("https://api.parse.com/1/push", 'POST', json_encode(array('where' => array('channels' => array(), 'deviceType' => array('ios','android')), 'data' => array('alert'=>$message))));
}
*/
