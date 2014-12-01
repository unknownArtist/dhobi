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

	$result = json_decode(getObjectsInClass('Driver', '{"storeCode":"' . $_SESSION['storeID'] .  '"}'), true);
	$stores = $result['results'];
	$storeList = json_decode(getObjectsInClass('Store', '{"uniqueCode" : "' . $_SESSION['storeID'] . '"}'), true);
$storeList = $storeList['results'];
}

?>
<div id="content">
<center><h2>Set Unique Promo Code for Store</h2></center>	
<div>
<form method = post action = ''>
<table class="table table-bordered table-striped table-white" style = 'width:100%' id = 'mainTable'>
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td>No.</td><td>Promo Code</td><td>Store</td><td>Discount Amount($)</td>
</thead>
<?php 
$ct = 0;

foreach ($promocodes as $store) { $ct++;
$optionList = '';
?>
<tr>
<?php 	
	echo "<td>$ct</td>";
	echo "<td><input type= text id = 'uniquecode_{$store['objectId']}' name ='uniquecode_{$store['objectId']}'  value = '{$store['code']}'></td> ";
	echo "<td><select id = 'storeCode_{$store['objectId']}'  name = 'storeCode_{$store['objectId']}'>";
foreach ($storeList as $storev)
{
$str = ($storev['uniqueCode'] == $store['storeCode'] ? 'selected' : '');
$optionList .= "<option value = '{$storev['uniqueCode']}'  $str >{$storev['name']}</option>";
}
echo "$optionList</select></td> ";
	echo "<td><input type= text id = 'discount_{$store['objectId']}'  name = 'discount_{$store['objectId']}' value = '{$store['discount']}'></td> ";

	?>
</tr>
<?php } ?>
</table>
<div align = 'right'><input type = button value = 'Add New Code' onclick = 'onNew();'>&nbsp;&nbsp;<input type = submit value = 'Save'></div>
</form>
</div>
</div>	
<script>
var count = 0;

function onNew()
{
count++;
$("#mainTable tbody").append('<tr><td>' + ($("#mainTable tbody tr").length + 1) + '</td><td><input type = text name= "uniquecode_' + count + '" id = "uniquecode_' + count + '"></td><td><input type = text id = "discount_' + count + '" name = "discount_' + count + '"></td></tr>');

}
function onSave(id)
{
document.getElementById('td_' + id).innerHTML = "Saving..";
dt1 = (document.getElementById('uniquecode_' + id).value);
dt2 = (document.getElementById('discount_' + id).value);
 $.post('saveuniquecodefordriver.php', { ID: id, DATA:  dt1, DISCOUNT: dt2},
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
</script>
<?php include 'footer.php'; ?>