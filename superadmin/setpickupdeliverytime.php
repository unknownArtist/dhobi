<?php
include 'header.php';
include 'navigation.php';

$stores = array();
if ($_SESSION['userRole'] == 0) {

	$result = json_decode(getObjectsInClass('Store', '{}'), true);

	$result = $result['results'];

	$stores = $result;
}
else if ($_SESSION['userRole'] == 1)
{
	$result = json_decode(getObjectsInClass('Store', '{"uniqueCode":"' . $_SESSION['storeID'] .  '"}'), true);
	$stores = $result['results'];
}

else
{
	$result = json_decode(getObjectsInClass('Store', '{"uniqueCode":"' . $_SESSION['storeID'] .  '"}'), true);
	$stores = $result['results'];
}
?>
<div id="content">
<center><h2>Set Pickup/Delivery Time</h2></center>	
<div>

<table class="table table-bordered table-striped table-white" style = 'width:100%; margin-bottom:100px;'>
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td>No.</td><td style = 'cursor:pointer' onclick = 'sort_column(1);'>Store Name</td><td style = 'cursor:pointer' onclick = 'sort_column(2);'>Store Address</td><td style = 'cursor:pointer' onclick = 'sort_column(3);'>City</td><td style = 'cursor:pointer' onclick = 'sort_column(4);'>Zip Code</td><td style = 'cursor:pointer' onclick = 'sort_column(5);'>State</td><td style = 'cursor:pointer' onclick = 'sort_column(6);'>Store Code</td><td style = 'cursor:pointer' onclick = 'sort_column(7);'>Pickup Time From</td><td style = 'cursor:pointer' onclick = 'sort_column(8);'>Pickup Time To</td><td style = 'cursor:pointer' onclick = 'sort_column(9);'>Delivery Time From</td><td style = 'cursor:pointer' onclick = 'sort_column(10);'>Delivery Time To</td><td><td/>
</thead>
<tbody id = 'tbody'>
<?php 
$ct = 0;
$orderTypes = array("Placed",
 "Retrieved",
 "Cleaning",
 "OnRoute",
 "HandDelivered",
 "Confirmed");
foreach ($stores as $store) { $ct++;
?>
<tr id = '<?php echo 'tr_' . $ct; ?>'>

<?php 

	$str = $store['pickupTime'];
	if ($str) {
		$str = new DateTime($str);
		$store['pickupTime'] = $str->format('H:i');
		$store['pickupDate'] = $str->format('Y-m-d');
		
	}
	$str12 = $store['pickupTimeto'];
	if ($str12) {
		$str12 = new DateTime($str12);
		$store['pickupTimeTo'] = $str12->format('H:i');
		$store['pickupDateTo'] = $str12->format('Y-m-d');
		
	}
	$str1 = $store['deliveryTime'];
	if ($str1) {
	$str1 = new DateTime($str1);
	$store['deliveryTime'] = $str1->format('H:i');
	$store['deliveryDate'] = $str1->format('Y-m-d');
	}
	$str21 = $store['deliveryTimeto'];
	if ($str21) {
	$str21 = new DateTime($str21);
	$store['deliveryTimeTo'] = $str21->format('H:i');
	$store['deliveryDateTo'] = $str21->format('Y-m-d');
	}
	echo "<td>$ct</td><td id='{$ct}_1'>{$store['name']}</td><td id='{$ct}_2'>{$store['address']}</td><td id='{$ct}_3'>{$store['city']}</td><td id='{$ct}_4'>{$store['zipCode']}</td><td id='{$ct}_5'>{$store['state']}</td><td id='{$ct}_6'>{$store['uniqueCode']}</td>";
	echo "<td id='{$ct}_7'><input type= \"date\" id = 'pickupdate_{$store['objectId']}' value = '{$store['pickupDate']}'><input type= \"time\" id = 'pickuptime_{$store['objectId']}' value = '{$store['pickupTime']}'></td><td id='{$ct}_8'><input type= \"date\" id = 'pickupdateto_{$store['objectId']}' value = '{$store['pickupDateTo']}'><input type= \"time\" id = 'pickuptimeto_{$store['objectId']}' value = '{$store['pickupTimeTo']}'></td><td id='{$ct}_9'><input type= date id = 'deliverydate_{$store['objectId']}' value = '{$store['deliveryDate']}'><input type= \"time\" id = 'deliverytime_{$store['objectId']}' value = '{$store['deliveryTime']}'></td><td id='{$ct}_10'><input type= date id = 'deliverydateto_{$store['objectId']}' value = '{$store['deliveryDateTo']}'><input type= \"time\" id = 'deliverytimeto_{$store['objectId']}' value = '{$store['deliveryTimeTo']}'></td> ";
	/*echo "<td><input type= \"date\" id = 'pickupdate_{$store['objectId']}' value = '{$store['pickupDate']}'><input type= \"time\" id = 'pickuptime_{$store['objectId']}' value = '{$store['pickupTime']}'></td><td><input type= \"time\" id = 'pickuptimeto_{$store['objectId']}' value = '{$store['pickupTimeto']}'></td><td><input type= date id = 'deliverydate_{$store['objectId']}' value = '{$store['deliveryDate']}'><input type= \"time\" id = 'deliverytime_{$store['objectId']}' value = '{$store['deliveryTime']}'></td><td><input type= \"time\" id = 'deliverytimeto_{$store['objectId']}' value = '{$store['deliveryTimeto']}'></td> ";*/
	echo "<td><input type = button value = 'Save' onclick = 'onSave(\"{$store['objectId']}\");'></td>"; 
	?>
</tr>
<?php } ?>
</table>
</div>
</div>	
<script>
function onSave(id)
{
dt1 = document.getElementById('pickuptime_' + id).value;
dt2 = document.getElementById('pickuptimeto_' + id).value;
d1 = document.getElementById('pickupdate_' + id).value;
d2 = document.getElementById('pickupdateto_' + id).value;
d3 = document.getElementById('deliverydate_' + id).value;
d4 = document.getElementById('deliverydateto_' + id).value;
dt3 = document.getElementById('deliverytime_' + id).value;
dt4 = document.getElementById('deliverytimeto_' + id).value;
 $.post('savepickupdeliverytime.php', { ID: id, PICKUP:  dt1, PICKUPTO: dt2, DELIVERY: dt3, DELIVERYTO: dt4,PICKUPDATE:d1,PICKUPDATETO:d2,DELIVERYDATE:d3,DELIVERYDATETO:d4},
 function(a,b)
 {
	if (a == b && b == 'success')
	{
		alert ("Successfully updated!");		
	}
	else alert (a);
 });
}


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
  <?php if($_REQUEST['id']==0){ ?>
      <script>
	  	window.location.reload(true);
		window.location.href = 'http://thedhobi.com/superadmin/setpickupdeliverytime.php?id=1';
	  </script>
     <?php } ?>
<?php include 'footer.php'; ?>