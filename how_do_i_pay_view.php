<?php include("header.php");
//session_start();
require_once('curl.php');

if (isset($_SESSION['logined']))
{
    if(isset($_SESSION['sessionToken']))
    {
        //header('location:index.php');

    }

}


?>





            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        How Do I Pay ?

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                
                <section class="content">
                    <div class="box box-primary">
                                <div id = 'slide' class="box-header" style="background:#3C8DBC; color: white; text-align: center" >
                                    <span id="display_how_do_i_pay_errors" class = "fadeOut_error_notification"></span>
                                </div><!-- /.box-header --> 
                                <div class="box-header">

                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" id = "how_do_i_pay_form" method="POST" action="how_do_i_pay_action.php">
                                    <div class="box-body">
                                        <div class="form-group">
										<p><label>Number:</label>
                                            <input name="number" maxLength = "16" type="text" class="form-control input-lg"  placeholder="Card Number"></p>
                                        </div>
                                        <div class="form-group">
										<p><label>Expiration Info:</label>
                                            <input name="expiryAt"  class="form-control input-lg"  id="datepickerhowdoipay" placeholder="Expiration Info"></p>
                                        </div>
                                        <div class="form-group">
										<p><label>CVC:</label>
                                            <input name="cvc" maxLength = "3" type="text" class="form-control input-lg date"  id="exampleInputFirstName"  placeholder="CVC" ></p>
                                        </div>
                                        <div class="form-group">
                                        <p><label>Billing Zip:</label>
                                            <input name="billingZipCode" maxLength = "3"  type="text" class="form-control input-lg" id="exampleInputNotes" placeholder="Billing Zip" value="" ></p>
                                        </div>
                                     </div><!-- /.box-body -->

                                    <div class="box-footer">
                                    <p>
                                        <input name="objectId" type="hidden" value="<?php echo $userInfo->results[0]->objectId; ?>" />
                                        <button type="submit" id = "how_do_i_pay_submit" class="btn btn-primary">Save</button>

                                        </p>
                                    </div>
                                </form>
                            </div><!-- /.box -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include("footer.php");