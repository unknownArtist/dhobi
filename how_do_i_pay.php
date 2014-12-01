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
                        Where I Am ?

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                <?php if(count($user->results) == 0): ?>
                <h2>You need an address!</h2>

                <h4>Let Dhobi know where you would like your clean clothes delivered</h4>

                <?php else: ?>
                 <div id="view-address">
                    <?php for($i = 0; $i < count($user->results); $i++) { ?>
                   
                    <div id="text-address">
                    <a href="how_do_i_pay_edit.php?id=<?php echo $user->results[$i]->objectId; ?>">
                    <div class="where-set">
                        <h2><?php echo ucfirst($user->results[$i]->category); ?></h2>
                        <p><?php echo $user->results[$i]->billingZipCode; ?></p>
                        </div>
                        <h3>View&emsp;<i class="fa fa-angle-right"></i></h3>
                        </a>
                    </div>
                    <?php } ?>   
                

                <?php endif; ?>
                
                     <div id="add-address-link" ><p>
                        <a style="color:white" class="btn btn-success" href="how_do_i_pay_view.php">Add credit card</a></p>
                    </div>
                      <?php //var_dump($user); ?>
                      </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include("footer.php");

/*function validateUSAZip($zip_code) {
return preg_match(“/^([0-9]{5})(-[0-9]{4})?$/i”,$zip_code);
}*/