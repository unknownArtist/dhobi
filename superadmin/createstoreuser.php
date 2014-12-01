<?php
include 'header.php';
include 'navigation.php';
$success = 0;
$result = json_decode(getObjectsInClass('StoreAdmin', '{}'), true);
$result = isset($result['results']) ? $result['results'] : null;
$storeCodes = array();
if ($result)
{
	foreach ($result as $r)
	{
		$storeCodes[] = $r['storeID'];
	}
	$storeCodes = array_unique($storeCodes);
}

if (isset($_POST['email']))
{
	$result = json_decode(getObjectsInClass('User', '{"$or":[{"username":"' . addslashes($_POST['email']) . '"}]}'), true);

	if (isset($result['results']) && sizeof($result['results']) == 0)
	{
	$add	=	json_decode(addUser(array('username' => $_POST['email'], 'email'=> $_POST['email'], 'phoneNumber' => $_POST['phoneNumber'],'storeCode' => $_POST['storeCode'], 'firstName' => $_POST['firstName'], 'lastName' => $_POST['lastName'], 'password'  => $_POST['password'])));
	
	
	
	$see	=	 $add->sessionToken;
	$obj	=	$add->objectId;
		updateUser($obj, array('tokan' => $see),$see);
		$success = 100;	
	}
	else {
		$result = $result['results'][0];

		if ($result['username'] == $_POST['email'])
			$success = 101;
		else $success = 102;
	}
	
}
?>

<script>
var success = <?php echo $success; ?>;
if (success == 100) alert("Successfully created!");
else if (success == 101) alert("Same username already exists!");
else if (success == 102) alert("Same Store Code already exists!");
</script>	
<div id="content">
<div class="row row-app">
		<!-- col-separator.box -->
		<div class="col-separator col-unscrollable box">
			
			<!-- col-table -->
			<div class="col-table">
				
				<h4 class="innerAll margin-none border-bottom text-center bg-primary"><i class="fa fa-pencil"></i>Create a new Account(Customer)</h4>

				<!-- col-table-row -->
				<div class="col-table-row">

					<!-- col-app -->
					<div class="col-app col-unscrollable">

						<!-- col-app -->
						<div class="col-app">

							<div class="login">
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  		<form action="createstoreuser.php" method= 'post'>
									  		
											<div class="form-group">
									    		<label for="">E-Mail Address</label>
									    		<input type="email"  id = 'email' name = 'email' class="form-control"  placeholder="Enter E-Mail Address">
									  		</div>
											
											<div class="form-group">
									    		<label for="">Password</label>
									    		<input type="password"  id = 'password' name = 'password' class="form-control"  placeholder="Enter Password">
									  		</div>
											<div class="form-group">
									    		<label for="">Confirm Password</label>
									    		<input type="password"  id = 'confirmpassword' name = 'confirmpassword' class="form-control"  placeholder="Confirm Password">
									  		</div>
											<div class="form-group">
									    		<label for="">First Name</label>
									    		<input type="text"  id = 'firstName' name = 'firstName' class="form-control"  placeholder="Enter first name">
									  		</div>
											<div class="form-group">
									    		<label for="">Last Name</label>
									    		<input type="text"  id = 'lastName' name = 'lastName' class="form-control"  placeholder="Enter last name">
									  		</div>
											<div class="form-group">
									    		<label for="">Phone Number</label>
									    		<input type="text"  id = 'phoneNumber' name = 'phoneNumber' class="form-control"  placeholder="Enter Phone Number">
									  		</div>
											<div class="form-group">
									    		<label for="">Store Code</label>
									    		<select id = 'storeCode' name = 'storeCode' style = 'width:200px'>
												<?php foreach ($storeCodes as $storeCode) echo "<option value = '$storeCode'>$storeCode</option>"; ?>
												</select>
									  		</div>
											
									  		<button type="submit" class="btn btn-primary btn-block">Create Account</button>
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
if (document.getElementById('firstName').value.replace(/ /gi, '') == '')
{
alert("Empty first name!"); return false;
}
if (document.getElementById('lastName').value.replace(/ /gi, '') == '')
{
alert("Empty last name!"); return false;
}

if (document.getElementById('email').value.replace(/ /gi, '') == '')
{
alert("Empty E-mail Address!"); return false;
}
if (document.getElementById('password').value == document.getElementById('confirmpassword').value)
{
if (document.getElementById('storeID').value.replace(/ /gi, '') == '')
{
alert("Empty Store ID!"); return false;
}
return true;
}

alert ("Passwords don't match!");
return false;
});
</script>
<?php include 'footer.php'; ?>