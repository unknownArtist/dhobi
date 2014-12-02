<?php include("header.php");
//session_start();
require_once('curl.php');

if (isset($_SESSION['logined']))
{
    if(isset($_SESSION['sessionToken']))
    {
        //header('location:index.php');

    }

     $user = json_decode(getObjectsInClass('Address', json_encode(["userID" => $_SESSION['objectId']])));
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

                
                <section class="content">
                    <div class="box box-primary">
                                <div id = 'slide' class="box-header" style="background:#3C8DBC; color: white; text-align: center" >
                                    <span id="display_how_do_i_pay_errors" class = "fadeOut_error_notification"></span>
                                </div><!-- /.box-header --> 
                                <div class="box-header">

                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" id = "how_do_i_pay_form" method="POST" action="place_order_timing_action.php">
                                    <div class="box-body">
                                        <div class="form-group">
                                        <p><label>Location</label>
                                        <span class="setsel">
                                            <select name="address" class="form-control input-lg">
                                            <?php for($i = 0; $i < count($user->results); $i++) { ?>
                                              
                                              <option value="<?php echo $user->results[$i]->objectId; ?>"><?php echo $user->results[$i]->address; ?></option>
                                            <?php } ?>
                                            </select></span></p>
                                            
                                        </div>
                                        <div class="form-group">
										<p><label>Pickup Date:</label>
                                            <input name="retrievalDate"  class="form-control input-lg" data-date-format="mm-dd-yyyy"  id="datepicker" placeholder="Retrival Date"></p>
                                        </div>
                                        <div class="form-group bootstrap-timepicker">
                                        <p><label>Retrival Time:</label>
                                            <input name="retrievaltime" id="timepicker" type="text" class="input-small">
                                            <i class="icon-time"></i></p>
                                        </div>
                                        <div class="form-group">
                                        <p><label>Deliever Date:</label>
                                            <input name="delieverDate"  class="form-control input-lg" id="datepickerDeliever" placeholder="Deliever Date"></p>
                                        </div>
                                        <div class="form-group bootstrap-timepicker">
                                        <p><label>Deliever Time:</label>
                                            <input name="delieverTime" id="timepicker1" type="text" class="input-small">
                                            <i class="icon-time"></i></p>
                                        </div>
                                        <div class="form-group">
										<p><label>Personal Request:</label>
                                            <textarea name="personalRequest" cols="5" class="form-control input-lg date"  id="exampleInputFirstName"  placeholder="Personal Request" ></textarea></p>
                                        </div>
                                        
                                     </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <p>
                                            <button type="submit" id = "how_do_i_pay_submit" class="btn btn-primary">Clean My Clothes</button>
                                        </p>
                                    </div>
                                </form>

                            </div><!-- /.box -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
<?php
include("footer.php");