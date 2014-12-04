<?php include("header.php");
//session_start();
require_once('curl.php');

if (isset($_SESSION['logined']))
{
    if(isset($_SESSION['sessionToken']))
    {
        //header('location:index.php');

    }
    $AllClothsCate = json_decode(getAllObjectsInClass('Cloth'));
    

}   

?>



            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Order

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 
                   
                    <div id="text-order">

                    <div class="where-set">
                        <div class="bs-example">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                <th> Name</th>
                                  <th> Quantity</th>
                                  
                                  <th> Price</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php for($i = 0; $i < count($AllClothsCate->results); $i++) { ?>
                                <tr>
                                  <td><?php echo ucfirst($AllClothsCate->results[$i]->name); ?></td>
                                
                                  <td>
                                  <input data-price="<?php echo $AllClothsCate->results[$i]->price; ?>" id="quantity_price<?php echo $i ?>" type="text" name="quantity" id="quantity" /></td>
                                  <td class="plus-set"><a href="#"><span class="glyphicon glyphicon-plus-sign plus<?php echo $i ?>"></span>
                                  </a>
                                  <a href="#" class="red-minus"><span class="glyphicon glyphicon-minus-sign"></span>
                                  </a>
                                   &emsp; $<?php echo $AllClothsCate->results[$i]->price; ?></td>

                                  </tr>
                               <?php } ?> 
                               <tr>
                               <td>
                                 <h3>Promo Code</h3>
                               </td>
                                  <td>
                                    <form method="POST" action="place_order_items_action.php">
                                    <input type="text" name="promocode" />
                                  </td>
                                  <td></td>
                                  
                                </tr>
                                <tr>
                                <td><h3>Total&emsp;<span id="totalamountdiv"></span></h3>
                                 
                                 </td>
                                <td>
                                <button id="calculate" class="btn btn-success">Calculate</button>
                                    
                                            <input type="hidden" name="totalcost" id="totalamount" />
                                            <input name="storecode" type="hidden" value="<?php echo $AllClothsCate->results[0]->storeid ?>" />
                                            
                                </td>
                                    <td>
                                      <button class="btn btn-primary">Save</button>
                                        </form>
                                        
                                    </td>
                                </tr>

                              </tbody>
                            </table>
                          </div><!-- /example -->
                       
                        
                        </div>
                        <h3></h3>
                     
                    </div>
                    
                </section><!-- /.content -->

            </aside><!-- /.right-side -->

   
<?php
include("footer.php");

