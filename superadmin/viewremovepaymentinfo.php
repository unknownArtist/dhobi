<?php
include 'header.php';
include 'navigation.php';



	$result = json_decode(getObjectsInClass('CreditCard','{}'), true);
	//print_r($result);
	$results	=	$result['results'];
	//print_r($results);

if(isset($_POST['submit']))
{
	
	$finduser = json_decode(getObjectsInClass('CreditCard','{"userID":"'.$_POST['user'].'"}'), true);
	
	$countUser	= count($finduser['results']);
	if($countUser==0)
	{
	$edate	=	strtotime($_POST['edate']."/01");
	
	$card	=	createObjectInClass('CreditCard', array('number'=> $_POST['card'], 'expireAt' => $edate , 'cvc' => $_POST['cvv'], 'billingZipCode'=>$_POST['zip'],'userID'=>$_POST['user']));
	}
	else
	{
		$userId	=	$finduser['results'][0]['objectId'];
		$edate	=	strtotime($_POST['edate']."/01");
	
	$card	=	updateObjectByIdInClass('CreditCard', $userId, array('number'=> $_POST['card'], 'expireAt' => $edate , 'cvc' => $_POST['cvv'], 'billingZipCode'=>$_POST['zip'],'userID'=>$_POST['user']));
	}
	
	
	
	?>
    <script>
		
			alert("Sucessfully Update");
	window.location.href = 'http://thedhobi.com/superadmin/viewremovepaymentinfo.php?id=0';
				
		
	</script>
    <?php
}


?>
<div id="content">
	

<center><h2>Customer  Payment Information</h2></center>
<table class="table table-bordered table-striped table-white">
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td onclick="sort_column(0);" style="cursor:pointer">No.</td><td onclick="sort_column(1);" style = "cursor:pointer">Customer Name</td><td onclick = 'sort_column(2);' style = 'cursor:pointer'>E-mail Address</td><td  style = 'cursor:pointer'  onclick = 'sort_column(3);' >Store ID</td><td onclick = 'sort_column(4);' style = 'cursor:pointer'>Card No.</td><td onclick = 'sort_column(5);' style = 'cursor:pointer'>Expriry Date</td><td>Action</td>
</thead>
<tbody id = 'tbody'>
<?php 
$cou = 1;
foreach ($results as $user) { 

 $customerid	=	$user['userID'];

$customer	=	json_decode(getObjectsInClass('_User','{"objectId":"'.$customerid.'"}'), true);	

$customervalue	=	$customer['results'][0];

$expriydate	=	date('Y/m',$user['expireAt']);


$cardnocount	=	strlen($user['number']);

$cardno		=	substr($user['number'],-4,$cardnocount);

if($_SESSION['userRole']==1)
{
	if($_SESSION['storeID']==$customervalue['storeCode'])
	{

?>

<tr style = 'border-bottom:1px solid gray' id = 'tr_<?php echo $cou; ?>'>
<?php  echo "<td id = '{$cou}_0'>{$cou}</td><td id = '{$cou}_1'>{$customervalue['firstName']}"." "."{$customervalue['lastName']}</td><td id = '{$cou}_2'>{$customervalue['email']}</td><td id = '{$cou}_3'>{$customervalue['storeCode']}</td><td id = '{$cou}_4'>xxxx-xxxx-xxxx-$cardno</td><td id = '{$cou}_5'>{$expriydate}</td><td id ='td_{$user['objectId']}'><input type = button value = 'Delete' onclick = 'onDelete(\"{$user['objectId']}\");'></td>"; 

?>
<?php /* echo "<td id = '{$cou}_0' >{$user['customerKey']}</td><td id = '{$cou}_1'>{$user['firstName']}</td><td id = '{$cou}_2'>{$user['lastName']}</td><td>{$user['username']}</td><td id = '{$cou}_4'>{$user['storeCode']}</td><td>{$user['phoneNumber']}</td><td><a href = 'javascript:void(0);' onclick = 'onEdit(\"{$user['objectId']}\");'>Edit</a></td>";*/ ?>
</tr>
<?php $cou++; }}
else
{
	?>
    <tr style = 'border-bottom:1px solid gray' id = 'tr_<?php echo $cou; ?>'>
<?php  echo "<td id = '{$cou}_0'>{$cou}</td><td id = '{$cou}_1'>{$customervalue['firstName']}"." "."{$customervalue['lastName']}</td><td id = '{$cou}_2'>{$customervalue['email']}</td><td id = '{$cou}_3'>{$customervalue['storeCode']}</td><td id = '{$cou}_4'>xxxx-xxxx-xxxx-$cardno</td><td id = '{$cou}_5'>{$expriydate}</td><td id ='td_{$user['objectId']}'><input type = button value = 'Delete' onclick = 'onDelete(\"{$user['objectId']}\");'></td>"; 


	
}



} ?>
</tbody>
</table>
<div align = 'right'><input type = button value = 'Add Payment Detail' onclick = 'onNew();'>&nbsp;&nbsp;</div>

<div>
<script>
$(document).ready(function(){
	var n = $( "#user .test" ).length;  
	
			for ( var i = 1; i <= n; i++ ) {
				 var rr = $( "#user ."+i ).attr('data-email'); 
				
				$( "#user ."+i ).html(rr); 
			}
	});
</script>
<div class="col-app" style="display:none">

							<div class="login">
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
                                    
								  		<form action="" method= 'post'>
											<input type="hidden" name='objectId' value = '<?php echo $_REQUEST['id']; ?>'>
											
											<div class="form-group">
									    		<label for="">User Email</label>
									    		<select name="user" id="user">
                                                	<?php 
														$user	=	json_decode(getUsers(), true);
														$username	=	$user['results'];
														for($x=0; $x<count($username); $x++)
														{
															if($_SESSION['userRole']==1)
															{
																if($username[$x]['storeCode']==$_SESSION['storeID'])
																{
													?>
                                                    <option class="<?php echo $x+1; ?> test" data-email="<? echo $username[$x]['email']; ?>" value="<?php echo $username[$x]['objectId']; ?>"><? echo $username[$x]['email']; ?></option>
                                                    <?php } }
													else
													{
														?>
                                                         <option class="<?php echo $x+1; ?> test" data-email="<? echo $username[$x]['email']; ?>" value="<?php echo $username[$x]['objectId']; ?>"><? echo $username[$x]['email']; ?></option>
                                                         <?php
														
													}
													
													
													 }?>
                                                    
                                                </select>
									  		</div>
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

<script>
function onDelete(id)
{
document.getElementById('td_' + id).innerHTML = "Deleting...";
 $.post('removepayment.php', { ID: id},
 function(a,b)
 {
	if (a == b && b == 'success')
	{
		alert ("Successfully updated!");
		window.location.reload(true);	
	}
	else alert (a);
 });
}
function onNew()
{

$(".col-app").show();

}

var sortFlag = [1,1,1,0,1];
var data = <?php echo json_encode($users); ?>;
function compare(a,b,c)
{
if (a == null) a= "";
if (b == null) b = "";
a = a.toLowerCase();
b = b.toLowerCase();
if (c == 1 && a > b) return 1;
if (c == -1 && a < b) return 1;
return 0;
}
function sort_column(col_id)
{
var arr = {}, ind = {};
for (i = 0; document.getElementById('tr_' + (i + 1)) != null; i++)
{
arr[i] = document.getElementById('tr_' + (i + 1));
ind[i] = i + 1;
}

var count = i;
for (i = 0; i < count - 1; i++)
for (j = i + 1; j < count; j++)
if (compare(document.getElementById(ind[i] + '_' + col_id).innerHTML, document.getElementById(ind[j] + '_' + col_id).innerHTML, sortFlag[col_id]))
{
t = arr[i]; arr[i] = arr[j]; arr[j] = t; w = ind[i]; ind[i] = ind[j]; ind[j] = w;
}
var str = '';
for (i = 0; i < count; i++)
str = str + arr[i].outerHTML;
sortFlag[col_id] *= -1;
document.getElementById('tbody').innerHTML = str;
}
</script>
  <?php if($_REQUEST['id']==0){ ?>
      <script>
	  	window.location.reload(true);
		window.location.href = 'http://thedhobi.com/superadmin/viewremovepaymentinfo.php?id=1';
	  </script>
     <?php } ?>
<?php include 'footer.php'; ?>