<?php
function gettime($t)
{

$s = new DateTime($t['iso']);
return $s->format('Y-m-d H:i');
}
require_once('curl.php');
session_start();
error_reporting(0);
if (isset($_POST['item_1']))
{
for ($i = 1; isset($_POST['item_' . $i]); $i++)
{
$_POST['startDate_'. $i] = ("{$_POST['startDate_'. $i]} {$_POST['startTime_'. $i]}");
$_POST['stopDate_'. $i] = "{$_POST['stopDate_'. $i]} {$_POST['stopTime_'. $i]}";
$_POST['startDate_'. $i] = (new DateTime($_POST['startDate_'. $i]))->format('c');
$_POST['stopDate_'. $i] = (new DateTime($_POST['stopDate_'. $i]))->format('c');

(createObjectInClass('PromoCode', array('code' => $_POST["item_$i"], 'startDate' => array('__type'=>'Date', 'iso' => $_POST['startDate_' . $i]), 'stopDate' => array('__type'=>'Date', 'iso' => $_POST['stopDate_' . $i]), 'discount' => $_POST['discount_' . $i])));
}
}

$promoCodes = loadClassFromParse('PromoCode');

?>
<div id="content">
<input type = button value = 'Back' onclick = 'window.location.href = "viewordersbycustomer.php";'>
<center><h2>Order Details</h2>	</center>
<div>
<form method = 'post' action = ''>
<table class="table table-bordered table-striped table-white" id = 'mainTable'>
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td>No.</td><td>Code</td><td>Start Date</td><td>End Date</td><td>Discount</td>
</thead>
<tbody>
<?php 
$ct = 0;
foreach ($promoCodes as $row) { $ct++;
?>
<tr style = 'border-bottom:1px solid gray; cursor:pointer' >
<?php 
$row['startDate'] = gettime($row['startDate']);
$row['stopDate'] = gettime($row['stopDate']);
echo "<td>$ct</td><td>{$row['code']}</td><td>{$row['startDate']}</td><td>{$row['stopDate']}</td><td>{$row['discount']}</td>"; ?>
</tr>

<?php } ?></tbody>
</table>

<div align = 'right'>
<?php if ($orders[$_REQUEST['id']]['progress'] < 14) { ?>
<input type = 'button' id = 'addbutton' value = 'Add New Item' onclick = 'addNewItem();'>
<input type = 'submit' id = 'savebutton' value = 'Save' onclick = 'saveNewItems();'>
<input type = 'button'  id = 'cancelbutton' value = 'Discard changes' onclick = 'cancelNewItems();' disabled='disabled'><br>
<br>
<?php } ?>

<hr/>
</div>
</form>
</div>
</div>	

<script>
var count = 0;
function addNewItem()
{
count++;
var itemList = "<?php foreach($clothes as $cloth) { echo "<option value = '{$cloth['objectId']}'>{$cloth['name']}</option>"; }?>";
document.getElementById('cancelbutton').disabled = document.getElementById('savebutton').disabled= false;
$("#mainTable tbody").append('<tr><td>' + ($("#mainTable tbody tr").length + 1) + '</td><td><input type = text name = "item_' + count + '"></td><td><input type = date name = "startDate_' + count + '"><input type = time name = "startTime_' + count + '"></td><td><input type = date name = "stopDate_' + count + '"><input type = time name = "stopTime_' + count + '"></td><td><input type = text name = "discount_' + count + '"></td></tr>');
}
function cancelNewItems()
{
document.getElementById('addbutton').disabled =document.getElementById('cancelbutton').disabled = document.getElementById('savebutton').disabled= false;
window.location.href = window.location.href;
}
</script>