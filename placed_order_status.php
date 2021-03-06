<?php include("header.php");
//session_start();
require_once('curl.php');

if (isset($_SESSION['logined']))
{
    if(isset($_SESSION['sessionToken']))
    {
        //header('location:index.php');

    }
    $order = json_decode(getObjectsInClass('Order', json_encode(["userID" => $_SESSION['objectId']])));
    $order = $order->results[0];
}

?>


            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Progress

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="order-status">
                    <h3><?php echo $order->retrievalAtFrom ?> - <?php echo $order->retrievalAtTo ?></h3>
                    <button type="button" class="btn btn-<?php if($order->progress == 1)  echo "primary primaryabc";  else  echo "default";  ?>">Retrieved Time</button>

                    <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->
                    <button type="button" class="btn btn-<?php if($order->progress == 2)  echo "primary primaryabc";  else  echo "default";  ?>"> Cleaning </button>

                    <!-- Indicates a successful or positive action -->
                    <button type="button" class="btn btn-<?php if($order->progress == 3)  echo "primary primaryabc";  else  echo "default";  ?>"> En Route</button>

                    <!-- Contextual button for informational alert messages -->
                    <button type="button" class="btn btn-<?php if($order->progress == 4)  echo "primary primaryabc";  else  echo "default";  ?>"> Hand Delievered</button>
                    <h3>Delivery Time</h3>
                </div>
                </section><!-- /.content -->

            </aside><!-- /.right-side -->
<?php

include("footer.php");
