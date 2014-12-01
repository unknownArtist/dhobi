<?php include("header.php");
//session_start();
require_once('curl.php');

if (isset($_SESSION['logined']))
{
    if(isset($_SESSION['sessionToken']))
    {
        //header('location:index.php');

    }
    $order = json_decode(getObjectsInClass('Order', json_encode(array('userID'=>$_SESSION['objectId']))));
    $creditCard = json_decode(getObjectsInClass('CreditCard', json_encode(["userID" => $_SESSION['objectId'] ])));

    $zipcode = json_decode(getObjectsInClass('ZipCode', json_encode(["zipcode" => $creditCard->results[0]->billingZipCode ])));

}   

?>



            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Order Confirmation

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 
                   
                    <div id="text-address">

                    <div class="where-set">
                        <div class="bs-example">
                            <table class="table table-striped">
                             
                              <tbody>

                                <tr id="fields">
                                  <td>Totalcost</td>
                                  <td><?php echo $order->results[0]->totalcost ?></td>
                                </tr>
                                
                                <tr>
                                <td>Discount</td>
                                <td>
                                  <?php 

                                  if($_SESSION['discount'])
                                    { echo "$".$_SESSION['discount']; }
                                  else
                                    { echo "No Discount"; }

                                  ?>
                                </td>
                                <tr>
                                  
                                  <td>Tax Amount</td>
                                  <td> % <?php echo $zipcode->results[0]->tax ?></td>
                                </tr>
                                  <tr>
                                  <td>Select Your Credit Card</td>
                                  <td>
                                  <form method="POST" action="place_order_confirmation_action.php">
                                  <select name="creditcard">
                                              <?php for($i = 0; $i < count($creditCard->results); $i++) { ?>
                                                <option value="<?php echo $creditCard->results[0]->objectId ?>"><?php echo $creditCard->results[0]->cvc ?></option>
                                              <?php } ?>
                                  </select></td>
                                </tr>
                                <tr>
                                  <td>Total </td>
                                  <td><?php 
                                   
                                      $newprice = explode('$',$order->results[0]->totalcost) ;
                                      $finaPrice = $newprice[1] - ($newprice[1] * ($zipcode->results[0]->tax/100));
                                      $discounted = $finaPrice - $_SESSION['discount'];
                                      echo $discounted;
                                   ?>
                                  </td>

                                </tr>

                                    
                                </tr>
                              </tbody>
                            </table>
                            
                                <input name="totalcost" type="hidden" value="<?php echo $discounted ?>" />
                                <button class="btn btn-primary"> Place Order</button>
                            </form>
                          </div><!-- /example -->
                       
                        
                        </div>
                        <h3></h3>
                        </a>
                    </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->

   
<?php
include("footer.php");

