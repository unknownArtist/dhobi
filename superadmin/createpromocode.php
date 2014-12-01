<?php
include 'header.php';
include 'navigation.php';

foreach ($_POST as $key => $value)
{
	if (substr($key,0,10) == 'uniquecode')
	{
		$objectID = substr($key, 11);

		if (strlen($objectID) > 5)
		{
			var_dump(updateObjectByIdInClass('PromoCode', $objectID, array('code'=> $value, 'discount' => $_POST['discount_' . $objectID], 'storeCode' => $_POST['storeCode_' . $objectID])));
		}
		else createObjectInClass('PromoCode', array('code'=> $value, 'discount' => $_POST['discount_' . $objectID] , 'storeCode' => $_POST['storeCode_' . $objectID]));
	}
}
$stores = array();
$optionList = '';
if ($_SESSION['userRole'] == 0) {

	$result = json_decode(getObjectsInClass('PromoCode', '{}'), true);

	$result = $result['results'];

	$promocodes = $result;
	$storeList = json_decode(getObjectsInClass('Store', '{}'), true);
$storeList = $storeList['results'];

/*	for ($i = 0; $i < sizeof ($stores); $i++)
		for ($j = $i + 1; $j < sizeof($stores); $j++)
			if (strcmp('a' . $stores[$i]['storeCode'], 'a' . $stores[$j]['storeCode']) == 1)
			{
				$t = $stores[$i]; $stores[$i] = $stores[$j]; $stores[$j] = $t;
			} */	
}
else if ($_SESSION['userRole'] == 1)
{

	$result = json_decode(getObjectsInClass('PromoCode', '{"storeCode":"' . $_SESSION['storeID'] .  '"}'), true);
	$promocodes = $result['results'];
	$storeList = json_decode(getObjectsInClass('Store', '{"uniqueCode" : "' . $_SESSION['storeID'] . '"}'), true);
$storeList = $storeList['results'];
}

if(isset($_POST['addPromoCode']))
{
	
	$today	=	date('Y/m/d h:i');
	if($_POST['startdate']>=$today)
	{
		$startdate	=	date('Y-m-d',strtotime($_POST['startdate']));
		$starttime	=	date('h:i',strtotime($_POST['startdate']));
		$start	=	$startdate."T".$starttime.":00.000Z";
	}
	else
	{
		$startdate	=	date('Y-m-d');
		$starttime	=	date('h:i');
		$start	=	$startdate."T".$starttime.":00.000Z";
	}
	if($_POST['stopdate']>=$_POST['startdate'])
	{
		$stopdate	=	date('Y-m-d',strtotime($_POST['stopdate']));
		$stoptime	=	date('h:i',strtotime($_POST['stopdate']));
		$stop	=	$stopdate."T".$stoptime.":00.000Z";
	}
	else
	{
		$stopdate	=	date('Y-m-d');
		$stoptime	=	date('h:i');
		$stop	=	$stopdate."T".$stoptime.":00.000Z";
	}
	
	
	
		$driver	=	createObjectInClass('PromoCode', array('code'=> $_POST['promocode'], 'storeCode' => $_POST['store'] , 'discount' => $_POST['amount'] ,'startDate' => array('__type'=>'Date', 'iso' => $start), 'stopDate' => array('__type'=>'Date', 'iso' => $stop)));
		?>
       <script>
    alert("Sucessfully Add Promocode");
	window.location.href = 'http://thedhobi.com/superadmin/createpromocode.php';	
    </script>
<?php		
		
	}
	
if($_REQUEST['msg']==2)
{
	?>
    <script>
    alert("Sucessfully Update");
	window.location.href = 'http://thedhobi.com/superadmin/createpromocode.php';	
    </script>
    
 <?php   
}
?>


<div id="content">
<center><h2>Set Unique Promo Code for Store</h2></center>	
<div>

<table class="table table-bordered table-striped table-white" style = 'width:100%' id = 'mainTable'>
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td>No.</td><td style = 'cursor:pointer' onclick = 'sort_column(1);'>Promo Code</td><td style = 'cursor:pointer' onclick = 'sort_column(2);'>Store</td><td style = 'cursor:pointer' onclick = 'sort_column(3);'>Discount Amount($)</td><td>Action</td>
</thead>
<tbody id = 'tbody'>
<?php 
$ct = 0;
foreach ($promocodes as $store) { $ct++;
$optionList = '';
?>
<form name="frmpromo" action="savepromocode.php" method="post" enctype="multipart/form-data">
	<tr id = '<?php echo 'tr_' . $ct; ?>'>
 		<td><?php echo $ct; ?></td>
		<td id='<?php echo $ct; ?>_1'><input type="text"  name="uniquecode"  value="<?php echo $store['code'];?>"></td> 
		<td id='<?php echo $ct; ?>_2'><select   name="storeCode">
    	<?php
			foreach ($storeList as $storev)
			{
				$str = ($storev['uniqueCode'] == $store['storeCode'] ? 'selected' : '');
				$optionList .= "<option value = '{$storev['uniqueCode']}'  $str >{$storev['name']}</option>";
			}
			echo $optionList;
		?>
		</select>
       	</td>
	   	<td id='<?php echo $ct; ?>_3'><input type="text"  name="discount" value="<?php echo $store['discount']; ?>"></td>
	   	<td>
    		<input type="submit" value="Save" name="submit">
        	<input type="hidden" name="id" value="<?php echo $store['objectId']; ?>" />
    		<a href="removepromocode.php?id=<?php echo $store['objectId']; ?>"><input type=button value="Delete"></a>
       </td>
	</tr>
</form>
<?php } ?>
</tbody>
</table>
<div align = 'right' id="addCode"><input type = button value = 'Add New Code'>&nbsp;&nbsp;</div>

<div>
<div class="col-app" style="display:none">

							<div class="login">
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  		<form action="" method= 'post'>
											<input type="hidden" name='objectId' value = '<?php echo $_REQUEST['id']; ?>'>
											
											<div class="form-group">
									    		<label for="">Promo Code</label>
									    		<input type="text"  id = 'promocode' name = 'promocode' class="form-control"  placeholder="Enter Promo Code Here">
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
                                            <div class="form-group">
									    		<label for="">Discount Amount($)</label>
									    		<input type="text"  id = 'amount' name = 'amount' class="form-control"  placeholder="Enter Discount Amount Here">
									  		</div>
                                            <div class="form-group">
									    		<label for="">Start Date</label>
									    		<input type="text"  id = 'datetimepicker' name = 'startdate' class="form-control"  placeholder="Enter Start Date  Here">
									  		</div>
                                            <div class="form-group">
									    		<label for="">Stop Date</label>
									    		<input type="text"  id = 'datetimepicker1' name = 'stopdate' class="form-control"  placeholder="Enter Stop Date  Here">
									  		</div>
											
									  		<input type="submit" name="addPromoCode" class="btn btn-primary btn-block" value="ADD Promo Code" >
										</form>
							  		</div>
								
								</div>
								<div class="clearfix"></div>					

							</div>
							
						</div>


</div>

</div>
</div>

<script>
var sortFlag = [1,1,1,1,1,1];
function compare(a,b,c)
{
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
<script>
$(document).ready(function(){
	$("#addCode").click(function(){
		$(".col-app").show();
		});
	});
</script>




<link rel="stylesheet" type="text/css" href="datetimepicker/jquery.datetimepicker.css"/ >
<script src="datetimepicker/jquery.js"></script>
<script src="datetimepicker/jquery.datetimepicker.js"></script>
<script type="text/javascript">

	$('#datetimepicker').datetimepicker();
	$('#datetimepicker1').datetimepicker();

</script>
  
      
<?php include 'footer.php'; ?>