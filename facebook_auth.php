
	<?php 

	try{
		include_once "facebook_auth/src/facebook.php";
	   }
		catch(Exception $e){
			error_log($e);
		}

	$facebook = new Facebook(array(
		'appId' => '1577721512451197',
		'secret' => '5b3e7ec9861d1c2198adefa9795a5086'
	));
    



	// if ($user) {
 //  	try {
	// 	    // Proceed knowing you have a logged in user who's authenticated.
	// 	    $user_profile = $facebook->api('/me');
 //  	  	} catch (FacebookApiException $e) {
	// 	    error_log($e);
	// 	    $user = null;
 //  		}
 //    }

	// if(!$user)
	// {
	// 	$loginUrl =$facebook->getLoginUrl();
	// }
	// else
	// {
		
	// 	echo "<a href='$loginUrl'>Login</a>";
	// }

	?>

