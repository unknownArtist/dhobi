<?php ob_start();
/*error_reporting(0);*/
session_start();
require_once('curl.php');
$emailID	=	$_POST['email'];
$pass		=	$_POST['password'];

$result = json_decode(login($_POST['email'], $_POST['password']), true);

if (isset($result['sessionToken']))
{
      $alert = 'gotonext';
      $_SESSION = $_POST;
      $_SESSION['logined'] = 1;
      $_SESSION['userRole'] = $result['userRole'];
      $_SESSION['sessionToken'] = $result['sessionToken'];
      $_SESSION['objectId'] = $result['objectId'];
      $_SESSION['email'] = $_POST['email'];

      header('location:index.php');
}
else 
{
    $alert = 'wrong';
    $_SESSION['msg'] = 0;
    header('location:login.php?msg=0');
}

		
/*		
if($emailID == 'grugs15@hotmail.com' && $pass == $result['password'])
{
	$result = array('sessionToken' => 'a', 'userRole' => 0);
}
else 
{
	$result = json_decode(getObjectsInClass('StoreAdmin', '{"username": "'. addslashes($_POST['emailaddress']).'","password": "'. $_POST['password'].'"}'), true);
		$i=0;
			foreach($result as $res)
			{
				if(in_array($_POST['emailaddress'],$res[$i]))
				{
					$data['results'][] = $res[$i];
				}
				$i++;
			}
			
			if (isset($data['results']) && sizeof($data['results']) == 1)
			{
				
				$result['sessionToken'] = 'a'; 
				$result['userRole'] = 1;
				 $_POST['storeID'] = $data['results'][0]['storeID'];
				 $_POST['objectId']= $data['results'][0]['objectId'];		
			}
			else 
			{
				$result = json_decode(login($_POST['emailaddress'], $_POST['password']), true);
				$result['userRole'] = 2;
				 $_POST['objectId'] = $result['objectId'];
				 $_POST['storeID'] = $result['storeCode'];	
				
			}
}

		if (isset($result['sessionToken']))
		{
			  $alert = 'gotonext';
			  $_SESSION = $_POST;
			  $_SESSION['logined'] = 1;
			  $_SESSION['userRole'] = $result['userRole'];
		$_SESSION['sessionToken'] = $result['sessionToken'];
			header('location:index.php');
		}
		else 
		{
			$alert = 'wrong';
			$_SESSION['msg'] = 0;
			header('location:login.php?msg=0');
		}
		
		
		*/

	

?>