<?php
include 'header.php';
include 'navigation.php';
if (isset($_POST['item_1']))
{
for ($i = 1; isset($_POST['item_' . $i]); $i++)
{
  createObjectInClass('AddedCloth', array('clothIndex' => $_POST["item_$i"], 'count' => (int)$_POST['count_' . $i], 'orderIndex' => $_REQUEST['id']));
}

}

if (isset($_POST['status_combo']))
{
updateObjectByIdInClass('Order', $_REQUEST['id'], array('progress' => (int)$_POST['status_combo']));

/*$msg	=	"Order Status Change";

$push	=		json_decode(push_notification($msg,$_POST['status_combo']),true);*/


}
$resultCloth = json_decode(getObjectsInClass('AddedCloth', '{"orderIndex":"'.$_REQUEST['id'].'"}'), true);
$addedClothes	=	$resultCloth['results'];
$addresses = loadClassFromParse('Address');
$clothes = loadClassFromParse('Cloth');
$orders = json_decode(getObjectByIdInClass('Order', $_REQUEST['id']), true);
$orders[$_REQUEST['id']] = $orders;
$promoCodes = loadClassFromParse('PromoCode');



$orderTypes = array("Placed",
 "Retrieved",
 "Cleaning",
 "En Route",
 "Hand-Delivered",
 "Confirmed");
$status = $orderTypes[$orders[$_REQUEST['id']]['progress']];
$address = $addresses[$orders[$_REQUEST['id']]['addressID']];
$zipCode = $address['zipCode'];
$taxA = json_decode(getObjectsInClass('ZipCode', '{"zipcode" : "' . $zipCode . '"}'), true);
$taxA = $taxA['results'][0]['tax'];
$rows = array();
$orderDate = $orders[$_REQUEST['id']]['createdAt'];
$sum = 0;

$k=	1;
$n=1;
$asd = '';


$ele = array();



foreach ($addedClothes as $item)
{
		
	$ele['count'] = $item['count'];
	$ele['price'] = $clothes[$item['clothIndex']]['price'];
	$ele['name'] = $clothes[$item['clothIndex']]['name'];
	$ele['shortName'] = $clothes[$item['clothIndex']]['shortName'];
	//if($asd == $ele['shortName'].$n)
	if($asd == $clothes[$item['clothIndex']]['shortName'].$n)
	{ 
		$n++;
		$ele['shortName'] = $clothes[$item['clothIndex']]['shortName'].$n;
		$asd = $ele['shortName'];
	}
	else {
		$ele['shortName'] = $clothes[$item['clothIndex']]['shortName'].'1';
		$asd = $ele['shortName'];
	}
	
	
$ele['orderItemID'] = $clothes[$item['clothIndex']]['orderItemID'];
	$rows[] = $ele;
	$sum += $ele['price'] * $ele['count'];
	$k++;
	
}


$tax = $taxA * $sum / 100.0;

 $discount = $promoCodes[$orders[$_REQUEST['id']]['promoMatched']]['discount'];
 
 $tt	=	$sum+$tax;
 if($tt < $discount)
 {
	 $discount	=	$sum + $tax;
 }
 else
 {
	 $discount	=	$discount;

 }
 
$total = $sum + $tax - $discount;

?>

<div id="content">
<input type = button value = 'Back' onclick = 'window.location.href = "viewordersbycustomer.php";'>

<center><h2>Order Details</h2>	</center>

<div>
<form method = 'post' action = ''>
<div align = 'left'>Order No: <?php echo $_REQUEST['orderNo']; ?></div>
<table class="table table-bordered table-striped table-white" id = 'mainTable'>
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td>SKU</td><td>Order Item ID</td><td>Name</td><td>Count</td><td>Price</td>
</thead>
<tbody>
<?php 
$ct = 0;



foreach ($rows as $row) { $ct++;



?>
<tr style = 'border-bottom:1px solid gray; cursor:pointer' >
<?php 
$t = sprintf("$%0.2f", $row['price']);
echo "<td>{$row['shortName']}</td><td>{$ct}</td><td>{$row['name']}</td><td>{$row['count']}</td><td>{$t}</td>"; ?>
</tr>

<?php } ?></tbody>
</table>

<div align = 'right'>
<?php if ($orders[$_REQUEST['id']]['progress'] < 14) { ?>
<input type = 'button' id = 'addbutton' value = 'Add New Item' onclick = 'addNewItem();'>
<input type = 'submit' id = 'savebutton' value = 'Save' >
<input type = 'button'  id = 'cancelbutton' value = 'Discard changes' onclick = 'cancelNewItems();' disabled='disabled'><br>
<br>
<?php } ?>
<table  border = '0px' width = "350px,400px">
<tr><td align = 'right' style = 'padding-right:20px'>Status</td><td align = 'right' style = 'padding-right:20px'><select name = 'status_combo' style="color:#000">
<?php foreach ($orderTypes as $key => $orderType) {
if ($orderType == $status) echo "<option value = '$key' selected>$orderType</option>";
else  echo "<option value = '$key'>$orderType</option>";
}  ?></select> </tr>
<tr><td align = 'right' style = 'padding-right:20px'>SubTotal</td><td align = 'right' style = 'padding-right:20px'><?php echo sprintf("$%0.2f", $sum); ?> </tr>
<tr><td align = 'right' style = 'padding-right:20px'>Tax</td><td align = 'right' style = 'padding-right:20px'><?php echo sprintf("$%0.2f", $tax); ?> </tr>
<tr><td align = 'right' style = 'padding-right:20px'>Promotion Amount</td><td align = 'right' style = 'padding-right:20px'><?php echo  sprintf("-$%0.2f",$discount); ?> </tr>
</table>
<hr/>
<table  border = '0px' width = "350px,400px">
<tr><td align = 'right' style = 'padding-right:20px'>Total</td><td align = 'right' style = 'padding-right:20px'><?php echo  sprintf("$%0.2f",$total); ?> </tr>
</table>
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
$("#mainTable tbody").append('<tr><td>' + ($("#mainTable tbody tr").length + 1) + '</td><td/><td><select name = "item_' + count + '">' + itemList + '</select></td><td><input type = text name = "count_' + count + '"></td><td/></tr>');
}
function cancelNewItems()
{
document.getElementById('addbutton').disabled =document.getElementById('cancelbutton').disabled = document.getElementById('savebutton').disabled= false;
window.location.href = window.location.href;
}
</script>
<?php include 'footer.php'; ?>