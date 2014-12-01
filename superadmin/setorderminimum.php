<?php
include 'header.php';
include 'navigation.php';

$stores = array();
if ($_SESSION['userRole'] == 0) {

	$result = json_decode(getObjectsInClass('Store', '{}'), true);

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
	
	$result = json_decode(getObjectsInClass('Store', '{"uniqueCode":"' . $_SESSION['storeID'] .  '"}'), true);
	$stores = $result['results'];
	$drivers = $stores;
}


if($_REQUEST['msg']==2)
{
	?>
    <script>
    alert("Sucessfully Update");
	window.location.href = 'http://thedhobi.com/superadmin/setorderminimum.php?id=0';	
    </script>
    
 <?php   
}
?>
<div id="content">
<center><h2>Minimum Order Amount Per Store</h2></center>	
<div>

<table class="table table-bordered table-striped table-white" style = 'width:100%'>
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td>No.</td><td style = 'cursor:pointer' onclick = 'sort_column(1);'>Store Name</td><td style = 'cursor:pointer' onclick = 'sort_column(2);'>Address</td><td style = 'cursor:pointer' onclick = 'sort_column(3);'>Store Code</td><td style = 'cursor:pointer' onclick = 'sort_column(4);'>Minimum Order Amount($)</td><td>Action<td/>
</thead>
<tbody id = 'tbody'>
<?php 
$ct = 0;

foreach ($drivers as $store) { $ct++;
?>
<form name="frm" action="saveminimumordervalue.php" method="" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $store['objectId']; ?>"  />
<tr id = '<?php echo 'tr_' . $ct; ?>'>
<?php 	
	echo "<td>$ct</td><td id='{$ct}_1'>{$store['name']}</td><td id='{$ct}_2'>{$store['address']}</td><td id='{$ct}_3'>{$store['uniqueCode']}</td>";
	echo "<td id='{$ct}_4'><input type='currency' name='unicode' value = '{$store['minimumOrderValue']}'></td> ";
	echo "<td id = 'td_{$store['objectId']}'><input type ='submit' name='submit' value = 'Save' ></td>"; 
	?>
</tr>
</form>
<?php } ?>
</tbody>
</table>
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

<?php include 'footer.php'; ?>