<?php
include 'header.php';
include 'navigation.php';


$optionList = '';

if($_SESSION['userRole']==0)
{
	$result = json_decode(getObjectsInClass('Cloth', '{}'), true);
}
else
{
	$result = json_decode(getObjectsInClass('Cloth', '{"storeid":"'.$_SESSION['storeID'].'"}'), true);
}
	$results = $result['results'];
	
	   $a	=	count($results)-1;
	 
	$storeList = json_decode(getObjectsInClass('Store', '{}'), true);
$storeList = $storeList['results']; 

if(isset($_POST['submit']))
{	
	
	
	   $orderItem	=	$results[$a]['orderItemID']+1;
	
		$addcloth	=	createObjectInClass('Cloth', array('name'=> $_POST['cloth'],'price'=>(int)$_POST['price'], 'shortName' => $_POST['short'],'orderItemID'=>(string)$orderItem,'storeid'=>$_POST['store']));
		
	?>
    <script>
	window.location.reload(true);
	$("#mainTable").show();
	$("#add").show();
	</script>
    	
<?php		
}



if($_REQUEST['msg']==2)
{
	?>
    <script>
    alert("Sucessfully Update");
	window.location.href = 'http://thedhobi.com/superadmin/addedititemlist.php';	
    </script>
    
 <?php   
}
?>
<div id="content">
<center><h2>Cloth Item Information</h2></center>	
<div>
<div align = 'right' id="add"><input type = button value = 'Add New Item' onclick = 'onNew();'>&nbsp;&nbsp;</div>
<div align = 'right' style="display:none" id="back"><a href="addedititemlist.php"><input type = button value = 'Cloth Detail'></a>&nbsp;&nbsp;</div>
<table class="table table-bordered table-striped table-white" style = 'width:100%; margin-bottom:100px;' id = 'mainTable'>
 
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td>No.</td><td style = 'cursor:pointer' onclick = 'sort_column(0);'>Cloth Name</td><td style = 'cursor:pointer' onclick = 'sort_column(1);'>Price($)</td><td style = 'cursor:pointer' onclick = 'sort_column(2);'>ShortName</td>
<?php if($_SESSION['userRole']==0)
	{
		?>
<td style = 'cursor:pointer' onclick = 'sort_column(3);'>Store Name</td>
<?php } ?><td>Action</td>
</thead>
<tbody id = 'tbody'>
<?php 
$ct = 0;

foreach ($results as $cloth) { $ct++;
$optionList = '';


?><form action="saveclothitem.php" name="frm" method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $cloth['objectId']; ?>" />
<tr id = '<?php echo 'tr_' . $ct; ?>'>

<?php 	
	echo "<td>$ct</td>";
	echo "<td id='{$ct}_0'><input type= text id = 'name' name ='name'  value = '{$cloth['name']}'></td> ";
	echo "<td id='{$ct}_1'><input type= text id = 'price' name ='price'  value = '{$cloth['price']}'></td>";
	echo "<td id='{$ct}_2'><input type= text id = 'short'  name = 'short' value = '{$cloth['shortName']}'></td> ";
	if($_SESSION['userRole']==0)
	{
		$storeList = json_decode(getObjectsInClass('Store', '{}'), true);
	$storeList = $storeList['results']; 
	?>
	<td id='<?php echo $ct; ?>_3'><select   name="storeCode">
    	<option value="">Select</option>
    	<?php
			
			foreach ($storeList as $storev)
			{	
					
					$str = ($storev['uniqueCode'] == $cloth['storeid'] ? 'selected' : '');
				
					$optionList .= "<option value = '{$storev['uniqueCode']}'  $str >{$storev['name']}</option>";
			
			
			}
			echo $optionList;
		?>
		</select>
       	</td>
      <?php
	}else{  ?>
	<input type="hidden" name="storeCode" value="<?php echo $_SESSION['storeID']; ?> " />
	<?php
	  }
echo "<td id = 'td_{$cloth['objectId']}'><input type ='submit' name='submit' value = 'Save'>&nbsp;&nbsp;<a href='removeclothitem.php?id={$cloth['objectId']}'><input type = button value = 'Delete'></a></td>";

	?>
</tr>
</form>
<?php } ?>
</tbody>
</table>


<div>
<div class="col-app" style="display:none">

							<div class="login">
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  		<form action="" method= 'post'>
											<input type="hidden" name='oredrItemId' value = '<?php echo $_REQUEST['id']; ?>'>
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
									    		<label for="">Cloth Name</label>
									    		<input type="text"  id = 'cloth' name = 'cloth' class="form-control"  placeholder="Enter Cloth Name Here">
									  		</div>
											<div class="form-group">
									    		<label for="">Price($)</label>
									    		<input type="text"  id = 'price' name = 'price' class="form-control"  placeholder="Enter Cloth Price Here">
									  		</div>
                                            <div class="form-group">
									    		<label for="">Short Name</label>
									    		<input type="text"  id = 'short' name = 'short' class="form-control"  placeholder="Enter Short Name Here">
									  		</div>
                                           
											
									  		<input type="submit" name="submit" class="btn btn-primary btn-block" value="ADD Item" >
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

$(document).ready(function(){
$("#add").click(function(){	
	
	
$(".col-app").show();
$("#mainTable").hide();
$("#add").hide();
$("#back").show();
	
	});
	
	});



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
  
<link rel="stylesheet" type="text/css" href="datetimepicker/jquery.datetimepicker.css"/ >
<script src="datetimepicker/jquery.js"></script>
<script src="datetimepicker/jquery.datetimepicker.js"></script>
<script type="text/javascript">

	$('#datetimepicker').datetimepicker();
	$('#datetimepicker1').datetimepicker();

</script>
<?php include 'footer.php'; ?>