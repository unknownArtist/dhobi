<?php
include 'header.php';
include 'navigation.php';


$success = 0;
//$user = "";
if (isset($_POST['submit']))
{
	 $re	= json_decode(updateUser($_POST['objectId'], array('firstName' => $_POST['firstName'],'lastName' => $_POST['lastName'],'phoneNumber' => $_POST['phoneNumber'],'storeCode'=>$_POST['store']),$_POST['tokan']));
	 
	header('location:vieweditcustomercontactinfo1.php?success=100');

}
?>


	
<div id="content">
<div class="row row-app">
		<!-- col-separator.box -->
		<div class="col-separator col-unscrollable box">
			
			<!-- col-table -->
			<div class="col-table">
				
				<h4 class="innerAll margin-none border-bottom text-center bg-primary"><i class="fa fa-pencil"></i>Edit Customer Contact Info</h4>

				<!-- col-table-row -->
				<div class="col-table-row">

					<!-- col-app -->
					<div class="col-app col-unscrollable">

						<!-- col-app -->
						<div class="col-app">

							<div class="login">
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  		<form action="editcustomerinfo.php" method= 'post'>
											<input type="hidden" name='objectId' value = '<?php echo $_REQUEST['id']; ?>'>
                                            <input type="hidden" name="tokan" value="<?php echo $_REQUEST['tokan']; ?>" />
											
											<div class="form-group">
									    		<label for="">First Name</label>
									    		<input type="text"  id = 'firstName' name = 'firstName' class="form-control"  placeholder="Enter First Name Here">
									  		</div>
											<div class="form-group">
									    		<label for="">Last Name</label>
									    		<input type="text"  id = 'lastName' name = 'lastName' class="form-control"  placeholder="Enter Last Name Here">
									  		</div>
											<div class="form-group">
									    		<label for="">Phone Number</label>
									    		<input type="text"  id = 'phoneNumber' name = 'phoneNumber' class="form-control"  placeholder="Enter Phone No. Here">
									  		</div>
                                            <?php
												if($_SESSION['userRole']==1)
												{
											?>
                                            	<input type="hidden" name="store" value="<?php echo $_SESSION['storeID']; ?>" />
                                            <?php } else {?>
                                            <div class="form-group">
									    		<label for="">Store Name</label>
									    		<select name="store">
                                                	<?php 
														$store	=	json_decode(getObjectsInClass('Store', '{}'), true);
														$storename	=	$store['results'];
														foreach($storename as $val)
														{
													?>
                                                    <option value="<?php echo $val['uniqueCode']; ?>"><?php echo $val['name']; ?></option>
                                                    <?php } ?>
                                                    
                                                </select>
									  		</div>
                                            <?php } ?>
											
									  		<input type="submit" name="submit" class="btn btn-primary btn-block" value="Update Customer Info" >
										</form>
							  		</div>
								
								</div>
								<div class="clearfix"></div>					

							</div>
							
						</div>
						<!-- // END col-app -->

					</div>
					<!-- // END col-app.col-unscrollable -->

				</div>
				<!-- // END col-table-row -->
			
			</div>
			<!-- // END col-table -->
			
		</div>
		<!-- // END col-separator.box -->


</div>
</div>
<script>
$("form").submit(function() {

if (document.getElementById('password').value == document.getElementById('confirmpassword').value)
{

return true;
}

alert ("Passwords don't match!");
return false;
});
</script>
<?php include 'footer.php'; ?>