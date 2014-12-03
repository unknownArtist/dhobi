<?php
session_start();
require_once('curl.php');
include_once('facebook_auth.php');

$facebook = new Facebook(array(
        'appId' => '1577721512451197',
        'secret' => '5b3e7ec9861d1c2198adefa9795a5086'
    ));

$loginUrl =$facebook->getLoginUrl(); 

$uid = $facebook->getUser();

/*if($uid) {
    header('location:logined_by_facebook_action.php');
}*/

if($uid) {
    $user = $facebook->api('/me');

    $userinfo = [
        'facebookID'    =>  $user['id'],
        'email'         =>  $user['email'],
        'password'      =>  'dumy',
        'username'      =>  $user['name'],
        'firstName'     =>  $user['first_name'],
        'lastName'      =>  $user['last_name'],
    ];
    
    $_SESSION['facebookID'] = $userinfo['facebookID'];

    
    $findUser = getObjectsInClass('_User', json_encode(array('email'=>$userinfo['email'])));
    $findUser = json_decode($findUser)->results[0];

    if($findUser != null ){
        header('location:index.php'); die(); 
    } else {
        $created = createObjectInClass('_User', $userinfo);
        header('location:index.php'); die(); 
    }


}

if (isset($_SESSION['logined']))
{   
    if(isset($_SESSION['sessionToken']))
    {  
        header('location:index.php');
        die();
    }
}

?>


<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Log in | The Dhobi</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!---Favicon--->
        <link href="img/favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header"><img src="img/logo.png" alt="logo"></div>
            <form action="login_action.php" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Email"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <!--div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div-->
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign in</button>  
                    
                    <p><a href="forgot.php">Forgot your password?</a></p>
                    
                    <a href="register.php" class="text-center">Create new Account</a>
                </div>
            </form>

            <div class="margin text-center">
                <span>Connect with</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><a href="<?php echo $loginUrl; ?>"><i class="fa fa-facebook"></i></a></button>
            </div>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>