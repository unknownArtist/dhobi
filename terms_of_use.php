<?php include("header.php");
//session_start();
require_once('curl.php');

if (isset($_SESSION['logined']))
{
    if(isset($_SESSION['sessionToken']))
    {
        //header('location:index.php');

    }
    $user = json_decode(getObjectsInClass('CreditCard', json_encode(["userID" => $_SESSION['objectId']])));
}

?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Terms of Use ?

                    </h1>
                    
                </section>

                <!-- Main content -->
                <section class="content">
                
                    <h2>Terms of Use!</h2>

                    <h4>The following paragraph describes our terms and conditions to use this website, so it is highly 
                    recommended that you first take a look on our terms and conditions.</h4>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include("footer.php");

/*function validateUSAZip($zip_code) {
return preg_match(“/^([0-9]{5})(-[0-9]{4})?$/i”,$zip_code);
}*/