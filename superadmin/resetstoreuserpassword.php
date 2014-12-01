<?php
include 'header.php';
include 'navigation.php';

$success = 0;


if($_SESSION['userRole'] == 2)
{
	if (isset($_POST['password']))
	{
		
				updateUser($_SESSION['objectId'], array('password' => $_POST['password']), $_SESSION['sessionToken']);
				$success = 100;	
			
	}
		
}

else
{
	if (isset($_POST['password']))
	{
		
		$user_re = json_decode(getUsers(), true);
		$user_res	=	($user_re['results']);
		
		for($s=0; $s < count($user_res); $s++)
		{
			
			if($user_res[$s]['email']==$_POST['email'])
			{
				
				$tokan	=	$user_res[$s]['tokan'];
				$obj	=	$user_res[$s]['objectId'];
			}
		}
		
		if($tokan=='')
		{
			$success	=	101;	
		}
		else
		{
				updateUser($obj, array('password' => $_POST['password']), $tokan);
				$success = 100;	
			
			
		}
		  
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
				
				<h4 class="innerAll margin-none border-bottom text-center bg-primary"><i class="fa fa-pencil"></i>Change Store User Password</h4>

				<!-- col-table-row -->
				<div class="col-table-row">

					<!-- col-app -->
					<div class="col-app col-unscrollable">

						<!-- col-app -->
						<div class="col-app">

							<div class="login">
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  		<form action="resetstoreuserpassword.php" method= 'post'>
											<div class="form-group">
									    		<label for="">Customer E-mail Address</label>
									    		<input type="email" id = 'email' name = 'email' class="form-control"  placeholder="Enter E-Mail Address" >
									  		</div>
                                            
											 <?php if ($_SESSION['userRole'] ==2)
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
											
											
									  		<button type="submit" class="btn btn-primary btn-block" name="submit">Change Password</button>
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