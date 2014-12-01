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
                        Add Address

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Add Address</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
               
                    <div class="box box-primary">
                                <div id = 'slide' class="box-header" style="background:#3C8DBC; color: white; text-align: center" >
                                    <span id="display_errors-wrapper"></span>
                                </div><!-- /.box-header --> 
                                    
                                <!-- form start -->
                                <form role="form" id='myform' method="POST" action="add_address_action.php">
                                    <div class="box-body">
                                        <div class="address_label">
                                            
                                        </div>
                                        <div class="form-group">
                                        <p><label>Address</label>
                                         <input required id="address" name="address" type="text" class="form-control input-lg"  placeholder="Address"></p>
                                        </div>
                                        <div class="address_label">
                                           
                                        </div>
                                        <div class="form-group">
										<p> <label>Apt Number</label>
                                            <input required maxlength="3" name="aptNumber" type="text" class="form-control input-lg" id="exampleInputPassword1" placeholder="Apt Number" ></p>
                                        </div>
                                        <div class="address_label">
                                            
                                        </div>
                                        <div class="form-group">
										<p><label>Zip Code</label>
                                            <input required name="zipCode" type="text" class="form-control input-lg" id="exampleInputFirstName"  placeholder="Zip Code" ></p>
                                        </div>
                                        <div class="address_label">
                                           
                                        </div>
                                        <div class="form-group">
                                        <p> <label>Location</label>
                                        <span class="setsel">
                                        	<select required name="location" class="form-control input-lg" >
											  <option value="home">Home</option>
											  <option value="office">Office</option>
											  <option value="other">Other</option>
											</select></span></p>
                                            
                                        </div>
                                        <div class="address_label">
                                            
                                        </div>
                                        <div class="form-group">
                                        <p><label>Notes</label>
                                            <input name="notes" type="text" class="form-control input-lg" id="exampleInputNotes" placeholder="Note (Optional)" value="" ></p>
                                        </div>
                                        
                                        
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                    <p>
                                        <button type="submit" id = 'submit' class="btn btn-primary">Save</button>
                                        </p>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                     

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

<?php include("footer.php"); ?>

