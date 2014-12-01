<?php
include 'header.php';
include 'navigation.php';
function gettime($t)
{
	$str = new DateTime($t['iso']);
	return $str->format("m/d/Y H:i");
}


$stores = array();

$orders = json_decode(getObjectsInClass('Order', '{}'), true);
$orders = $orders['results'];
$timesArr = array();
foreach ($orders as $order)
{
	if (!isset($timesArr[$order['driverCode']])) $timesArr[$order['driverCode']] = array();
	$timesArr[$order['driverCode']][] = $order;
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
}

?>
<div id="content">
<center><h2>Driver Statistics</h2></center>	
<div>

<table class="table table-bordered table-striped table-white" style = 'width:100%'>
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td>No.</td><td onclick = 'sort_column(0);' style = 'cursor:pointer'>First Name</td><td onclick = 'sort_column(1);'  style = 'cursor:pointer'>Last Name</td><td onclick = 'sort_column(2);'  style = 'cursor:pointer'>Store Code</td><td onclick = 'sort_column(3);'  style = 'cursor:pointer'>Unique Code</td><td onclick = 'sort_column(4);'  style = 'cursor:pointer'>Count of pickup/delivery</td><td>Pickup/Delivery Times</td>
</thead>
<tbody id = 'tbody'>
<?php 
$ct = 0;

foreach ($drivers as $store) { $ct++;
?>
<tr  id = 'tr_<?php echo $ct; ?>'>
<?php 	
	$count = sizeof($timesArr[$store['userCode']]);
	$times = '';
//var_dump($timesArr);
//	foreach ($timesArr[$store['userCode']] as $t)
//		$times .= gettime($t['updatedAt']) . '<br>';

$times=  (new DateTime($store['updatedAt']))->format('m/d/Y H:i');
	echo "<td>$ct</td><td id = '{$ct}_0'>{$store['firstName']}</td><td id = '{$ct}_1'>{$store['lastName']}</td><td id = '{$ct}_2'>{$store['storeCode']}</td>";
	echo "<td id = '{$ct}_3'>{$store['userCode']}</td> ";
	echo "<td id = '{$ct}_4'>{$count}</td> ";
	echo "<td>{$times}</td> ";	
	?>
</tr>
<?php } ?>
</tbody>
</table>
</div>	
</div>
<script>
var sortFlag = [1,1,1,1,1,1];
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
<?php include 'footer.php'; ?>