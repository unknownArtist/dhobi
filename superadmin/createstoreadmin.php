<?php
include 'header.php';
include 'navigation.php';
$success = 0;

if (isset($_POST['email']))
{
$result = json_decode(getObjectsInClass('StoreAdmin', '{"$or":[{"username":"' . addslashes($_POST['email']) . '"},{"storeID":"'. $_POST['storeID'] .'"}]}'), true);

if (isset($result['results']) && sizeof($result['results']) == 0)
{
createObjectInClass('StoreAdmin', array('username' => $_POST['email'], 'fullname' => $_POST['fullname'], 'password'  => $_POST['password'], 
	storeID => $_POST['storeID']));
createObjectInClass('Store', array('name' => $_POST['storeName'], 'address' => $_POST['storeAddress'], 'city' => $_POST['storeCity'], 'zipCode' => $_POST['storeZipCode'], 
			'state' => $_POST['storeState'], 'uniqueCode' => $_POST['storeID']));
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
				
				<h4 class="innerAll margin-none border-bottom text-center bg-primary"><i class="fa fa-pencil"></i> Create a new Account(Store Admin)</h4>

				<!-- col-table-row -->
				<div class="col-table-row">

					<!-- col-app -->
					<div class="col-app col-unscrollable">

						<!-- col-app -->
						<div class="col-app">

							<div class="login">
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  		<form action="createstoreadmin.php" method= 'post'>
									  		<div class="form-group">
									    		<label for="fullname">Full Name</label>
									    		<input type="text" name = 'fullname' id = 'fullname' class="form-control"  placeholder="Your full name">
									  		</div>
								  	  		<div class="form-group">
									    		<label for="email">Email address</label>
									    		<input type="email" id = 'email' name = 'email' class="form-control" placeholder="Enter email">
									  		</div>
									  		<div class="form-group">
									    		<label for="">Password</label>
									    		<input type="password" name = 'password' id = 'password' class="form-control" placeholder="Password">
									  		</div>
								    		<div class="form-group">
									    		<label for="">Confirm Password</label>
									    		<input type="password"  id = 'confirmpassword' name = 'confirmpassword' class="form-control"  placeholder="Retype Password">
									  		</div>
											<div class="form-group">
									    		<label for="">Store Code</label>
									    		<input type="text"  id = 'storeID' name = 'storeID' class="form-control"  placeholder="Enter Store ID">
									  		</div>
											<div class="form-group">
									    		<label for="">Store Name</label>
									    		<input type="text"  id = 'storeName' name = 'storeName' class="form-control"  placeholder="Enter Store Name">
									  		</div>
											<div class="form-group">
									    		<label for="">Zip Code</label>
									    		<input type="text"  id = 'storeZipCode' name = 'storeZipCode' class="form-control"  placeholder="Enter Zip Code">
									  		</div>
											<div class="form-group">
									    		<label for="">Store Address</label>
									    		<input type="text"  id = 'storeAddress' name = 'storeAddress' class="form-control"  placeholder="Enter Store Address">
									  		</div>
											<div class="form-group">
									    		<label for="">City</label>
									    		<input type="text"  id = 'storeCity' name = 'storeCity' class="form-control"  placeholder="Enter City">
									  		</div>
											<div class="form-group">
									    		<label for="">State</label>
									    		<input type="text"  id = 'storeState' name = 'storeState' class="form-control"  placeholder="Enter State">
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
if (document.getElementById('fullname').value.replace(/ /gi, '') == '')
{
alert("Empty name!"); return false;
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