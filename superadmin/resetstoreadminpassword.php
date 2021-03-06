<?php
include 'header.php';
include 'navigation.php';
$success = 0;


if($_SESSION['userRole']==0)
{
  if (isset($_POST['email']))
  {
	  $result = json_decode(getObjectsInClass('StoreAdmin', '{"username" : "' . $_POST['email'] . '"}'), true);
  
	  if (isset($result['results']) && sizeof($result['results']) == 1)
	  {
		  updateObjectByIdInClass('StoreAdmin', $result['results'][0]['objectId'], array('password' => $_POST['password']));
		  $success = 100;	
	  }
	  else {
		  $success = 101;
	  }
  }
}
else
{
	if (isset($_POST['email']))
	{
		updateObjectByIdInClass('StoreAdmin', $_SESSION['objectId'], array('password' => $_POST['password']));
		$success = 100;	
	}
}
?>

<script>
var success = <?php echo $success; ?>;
if (success == 100) alert("Successfully updated!");
else if (success == 101) alert("Invalid Username and Password!");

</script>	

<div id="content">
<div class="row row-app">
		<!-- col-separator.box -->
		<div class="col-separator col-unscrollable box">
			
			<!-- col-table -->
			<div class="col-table">
				
				<h4 class="innerAll margin-none border-bottom text-center bg-primary"><i class="fa fa-pencil"></i>Change Store Admin Password</h4>

				<!-- col-table-row -->
				<div class="col-table-row">

					<!-- col-app -->
					<div class="col-app col-unscrollable">

						<!-- col-app -->
						<div class="col-app">

							<div class="login">
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  		<form action="resetstoreadminpassword.php" method= 'post'>
									  		
											<div class="form-group">
									    		<label for="">E-Mail Address</label>
									    		<input type="email"  id = 'email' name = 'email' class="form-control"  placeholder="Enter E-Mail Address" <?php if ($_SESSION['userRole'] == 1) echo 'readonly value = "' . $_SESSION['emailaddress'] . '"'; ?> >
									  		</div>
                                            <?php if ($_SESSION['userRole'] == 1)
											{
												?>
											<div class="form-group">
									    		<label for="">Old Password</label>
									    		<input type="password"  id = 'oldpassword' name = 'oldpassword' class="form-control"  placeholder="Enter Old Password">
									  		</div>
                                            <?php } ?>

											<div class="form-group">
									    		<label for="">New Password</label>
									    		<input type="password"  id = 'password' name = 'password' class="form-control"  placeholder="Enter New Password">
									  		</div>
											<div class="form-group">
									    		<label for="">Confirm Password</label>
									    		<input type="password"  id = 'confirmpassword' name = 'confirmpassword' class="form-control"  placeholder="Confirm Password">
									  		</div>
											
											
									  		<button type="submit" class="btn btn-primary btn-block">Change Password</button>
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

if (document.getElementById('email').value.replace(/ /gi, '') == '')
{
alert("Empty E-mail Address!"); return false;
}
if (document.getElementById('password').value == document.getElementById('confirmpassword').value)
{

return true;
}

alert ("Passwords don't match!");
return false;
});
</script>
<?php include 'footer.php'; ?>