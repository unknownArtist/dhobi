<?php
include 'header.php';
include 'navigation.php';

$stores = array();
$users = json_decode(getObjectsInClass('Driver', '{}'), true);
$users = $users['results'];
foreach ($users as $user)
{
if (isset($user['uniqueCode']) && strlen($user['uniqueCode']) > 0)
	$users[$user['uniqueCode']] = $user;
}
if ($_SESSION['userRole'] == 0) {

	$result = json_decode(getObjectsInClass('Driver', '{}'), true);

	$result = $result['results'];

	$stores = $result;
	
	for ($i = 0; $i < sizeof ($stores); $i++)
		for ($j = $i + 1; $j < sizeof($stores); $j++)
			if (strcmp('a' . $stores[$i]['storeCode'], 'a' . $stores[$j]['storeCode']) == 1)
			{
				$t = $stores[$i]; $stores[$i] = $stores[$j]; $stores[$j] = $t;
			}
	$drivers = $stores;
	
}
else if ($_SESSION['userRole'] == 1)
{
	$result = json_decode(getObjectsInClass('Driver', '{"storeCode":"' . $_SESSION['storeID'] .  '"}'), true);
	$stores = $result['results'];
	$drivers	=	$stores;
}
else
{
	$result = json_decode(getObjectsInClass('Driver', '{"storeCode":"' . $_SESSION['storeID'] .  '"}'), true);
	$stores = $result['results'];
	
}
if(isset($_POST['submit']))
{
	$driver	=	createObjectInClass('Driver', array('firstName'=> $_POST['firstName'], 'lastName' => $_POST['lastName'] , 'storeCode' => $_POST['store'], 'userCode'=>$_POST['uniquecode']));
	?>
     <script>
		
			alert("Sucessfully Update");
	window.location.href = 'http://thedhobi.com/superadmin/createuniquecodefordriver.php?id=0';
				
		
	</script>
    <?php
}
?>
<div id="content">
<center><h2>Set Unique Code for Driver</h2></center>	
<div>

<table class="table table-bordered table-striped table-white" style = 'width:100%;'>
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td>No.</td><td style = 'cursor:pointer' onclick = 'sort_column(0);'>First Name</td><td  style = 'cursor:pointer' onclick = 'sort_column(1);'>Last Name</td><td style = 'cursor:pointer' onclick = 'sort_column(2);'>Store Code</td><td  style = 'cursor:pointer' onclick = 'sort_column(3);'>Unique Code</td><td/>
</thead>
<tbody id = 'tbody'>
<?php 
$ct = 0;

foreach ($drivers as $store) { $ct++;
?>
<tr id = '<?php echo 'tr_' . $ct; ?>'>
<?php 	

	echo "<td>$ct</td><td id='{$ct}_0'>{$store['firstName']}</td><td  id='{$ct}_1'>{$store['lastName']}</td><td  id='{$ct}_2'>{$store['storeCode']}</td>";
	echo "<td id='{$ct}_3'><input type= text id = 'uniquecode_{$store['objectId']}' value = '{$store['userCode']}'></td> ";
	echo "<td id = 'td_{$store['objectId']}'><input type = button value = 'Save' onclick = 'onSave(\"{$store['objectId']}\");'></td>"; 
	?>
</tr>
<?php } ?>
</tbody>
</table>
<div align = 'right'><input type = button value = 'Add New Driver' onclick = 'onNew();'>&nbsp;&nbsp;</div>

<div>
<div class="col-app" style="display:none">

							<div class="login">
								
								<div class="panel panel-default col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

								  	<div class="panel-body">
								  		<form action="" method= 'post'>
											<input type="hidden" name='objectId' value = '<?php echo $_REQUEST['id']; ?>'>
											
											<div class="form-group">
									    		<label for="">First Name</label>
									    		<input type="text"  id = 'firstName' name = 'firstName' class="form-control"  placeholder="Enter First Name Here">
									  		</div>
											<div class="form-group">
									    		<label for="">Last Name</label>
									    		<input type="text"  id = 'lastName' name = 'lastName' class="form-control"  placeholder="Enter Last Name Here">
									  		</div>
											
                                            
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
                                            <div class="form-group">
									    		<label for="">Unique Code</label>
									    		<input type="text"  id = 'uniquecode' name = 'uniquecode' class="form-control"  placeholder="Enter Unique Code Here">
									  		</div>
											
									  		<input type="submit" name="submit" class="btn btn-primary btn-block" value="ADD Driver" >
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
function onSave(id)
{
document.getElementById('td_' + id).innerHTML = "Saving...";
dt1 = (document.getElementById('uniquecode_' + id).value);
 $.post('saveuniquecodefordriver.php', { ID: id, DATA:  dt1},
 function(a,b)
 {
	if (a == b && b == 'success')
	{
		alert ("Successfully updated!");
	}
	else alert (a);
	document.getElementById('td_' + id).innerHTML = "<input type = button value = 'Save' onclick = 'onSave(\"" + id + "\");'>";
 });
}
function onNew()
{

$(".col-app").show();

}
</script>
  
<?php include 'footer.php'; ?>