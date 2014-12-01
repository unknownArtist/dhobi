<?php include("header.php");
//session_start();
require_once('curl.php');

if (isset($_SESSION['logined']))
{
    if(isset($_SESSION['sessionToken']))
    {
        //header('location:index.php');

    }
    $user = json_decode(getObjectByIdInClass('Address', $_GET['id']));

   }
?>

	
    
    
     <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        View Address

                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> View Address</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
               
                    <div class="box box-primary">
                                <div class="box-header">

                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" method="POST" action="add_address_action.php?id=<?php echo $_GET['id'] ?>">
                                    <div class="box-body">
                                        
                                        <div class="form-group">
											<p><label>Address</label>
                                            <input name="address" type="text" class="form-control input-lg"  placeholder="Address"  value="<?php echo $user->address; ?>" ></p>
                                        </div>
                                       
                                        <div class="form-group">
										<p><label>Apt Number</label>
                                            <input name="aptNumber" type="text" class="form-control input-lg" id="exampleInputPassword1" placeholder="Apt Number" value="<?php echo $user->aptNumber ?>" ></p>
                                        </div>
                                       
                                        <div class="form-group">
										<p><label>Zip Code</label>
                                            <input name="zipCode" type="text" class="form-control input-lg" id="exampleInputFirstName"  placeholder="Zip Code" value="<?php echo $user->zipCode ?>" ></p>
                                        </div>
                                       
                                        <div class="form-group">
                                        <p><label>Location</label>
                                        <span class="setsel">
                                        	<select name="location" class="form-control input-lg">
											  <option value="home" <?php if($user->category == "home") echo "selected"; ?>>Home</option>
											  <option value="office" <?php if($user->category == "office") echo "selected" ?>>Office</option>
											  <option value="other" <?php if($user->category == "other") echo "selected"; ?>>Other</option>
											</select></span></p>
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                        <p><label>Notes</label>
                                            <input name="notes" type="text" class="form-control input-lg" id="exampleInputNotes" placeholder="Note (Optional)" value="<?php echo $user->notes ?>" ></p>
                                        </div>
                                        
                                        
                                        
                                    </div><!-- /.box-body -->

                                    <div class="box-footer">
                                    <p>
                                        <button type="submit" class="btn btn-primary">Save</button>&emsp;
                                    <a class="btn btn-danger" href="delete_address_action.php?id=<?php echo $_GET['id'] ?>">Delete</a>
                                        </p>
                                    </div>
                                </form>
                            </div><!-- /.box -->
                     

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

<?php include("footer.php"); ?>

