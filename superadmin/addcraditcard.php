<?php
include 'header.php';
include 'navigation.php';

if(isset($_POST['submit']))
{
	
	$finduser = json_decode(getObjectsInClass('CreditCard','{"userID":"'.$_POST['objectId'].'"}'), true);
	
	$countUser	= count($finduser['results']);
	if($countUser==0)
	{
	$edate	=	strtotime($_POST['edate']."/01");
	
	$card	=	createObjectInClass('CreditCard', array('number'=> $_POST['card'], 'expireAt' => $edate , 'cvc' => $_POST['cvv'], 'billingZipCode'=>$_POST['zip'],'userID'=>$_POST['objectId']));
	}
	else
	{
		$userId	=	$finduser['results'][0]['objectId'];
		$edate	=	strtotime($_POST['edate']."/01");
	
	$card	=	updateObjectByIdInClass('CreditCard', $userId, array('number'=> $_POST['card'], 'expireAt' => $edate , 'cvc' => $_POST['cvv'], 'billingZipCode'=>$_POST['zip'],'userID'=>$_POST['objectId']));
	}
	
	?>
    <script>
		
			window.location.href('index.php');
				
		
	</script>
    <?php
}


?>

	
<div id="content">
<center><h2>Add  Payment Information</h2></center>

<div>
<div class="col-app" >

							<div class="login">
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  		<form action="" method= 'post'>
											<input type="hidden" name='objectId' value = '<?php echo $_SESSION['objectId']; ?>'>
											
											<div class="form-group">
									    		<label for="">Card No.</label>
									    		<input type="text"  id = 'card' name = 'card' class="form-control"  placeholder="Enter Cradit Card No. Here">
									  		</div>
                                            <div class="form-group">
									    		<label for="">Expiry Date</label>
									    		<input type="text"  id = 'edate' name = 'edate' class="form-control" placeholder="Enter Expiry Date Here" >(YYYY/mm)
									  		</div>
											<div class="form-group">
									    		<label for="">Cvv No.</label>
									    		<input type="text"  id = 'cvv' name = 'cvv' class="form-control"  placeholder="Enter Cvv No. Here" >
									  		</div>
                                            <div class="form-group">
									    		<label for=""> Zip Code.</label>
									    		<input type="text"  id = 'zip' name = 'zip' class="form-control"  placeholder="Enter Billing Zip Code Here" >
									  		</div>
                                            
                                            
											
									  		<input type="submit" name="submit" class="btn btn-primary btn-block" value="ADD Payment Info" >
										</form>
							  		</div>
								
								</div>
								<div class="clearfix"></div>					

							</div>
							
						</div>


</div>
</div>
<?php include 'footer.php'; ?>
