<?php
function gettime($t)
{
$s = new DateTime($t);
return $s->format('Y-m-d H:i');
}
require_once('curl.php');
session_start();
error_reporting(0);
$users = array();

if($_SESSION['userRole']==2)
{
	$result = json_decode(getObjectsInClass('Order', '{"userID":"'.$_SESSION['objectId'].'"}'), true);
}
else
{
	$result = json_decode(getObjectsInClass('Order', '{}'), true);
}
$result = $result['results'];

for ($i = 0; $i < sizeof($result); $i++)
for ($j = $i + 1; $j < sizeof($result); $j++)
if($result[$i]['createdAt']['iso'] > $result[$j]['createdAt']['iso'])
{
$temp = $result[$i]; $result[$i] = $result[$j]; $result[$j] = $temp;
}
for ($i = 0; $i < sizeof($result); $i++)
$result[$i]['orderNo'] = 100000 + $i + 1;

if ($_SESSION['userRole'] == 0) $users = $result;
else if ($_SESSION['userRole'] == 1) 
{
	foreach ($result as $user)
	{
		if ($user['storeCode'] == $_SESSION['storeID']) $users[] = $user;
	}
}
else if ($_SESSION['userRole'] == 2)
{
	foreach ($result as $user)
	{
		if ($user['userID'] == $_SESSION['objectId']) $users[] = $user;
	}
}
$count = sizeof($users);
/*for ($i = 0; $i < $count - 1; $i++)
	for ($j = $i + 1; $j < $count; $j ++)
		if (strcmp('a' . $users[$i]['userID'], 'a' . $users[$j]['userID']) == 1)
		{
			$t = $users[$i]; $users[$i] = $users[$j]; $users[$j] = $t;
		}*/
$addresses = json_decode(getObjectsInClass('Address', '{}'), true);
$addresses = $addresses['results'];

$t = array();
foreach ($addresses as $address)
	$t[$address['objectId']] = $address;
$addresses = json_decode(getObjectsInClass('CreditCard', '{}'), true);
$addresses = $addresses['results'];
$t1 = array();
foreach ($addresses as $address)
	$t1[$address['objectId']] = $address;
$addresses = $t;
$creditCards = $t1;
$realUsers = json_decode(getUsers(), true);
$realUsers = $realUsers['results'];
$t = array();
foreach ($realUsers as $u)
{
$t[$u['objectId']] = $u;
}
$realUsers = $t;
//var_dump($t);
?><head>
<link rel="stylesheet" href="../assets/components/library/bootstrap/css/bootstrap.min.css" />
<script>

</script>
</head>

<center><h2>View Orders by Customer</h2></center>	
<div style = 'width:100%; height:100%; padding-left:10px; padding-right:10px;'>
<table cols='50%,50%' style = 'width:100%'><tr><td>
<h5 ALIGN = 'LEFT'>(Click the row to see the details)</h5></td><td ALIGN = 'RIGHT'><h5><a href = 'javascript:void(0);' onclick = 'searchFilter();'>Clear Search Filters</a></h5></td></tr></table>
<table class="table table-bordered table-striped table-white" style = 'width:100%'>
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td>No.</td><td>Order No.</td><td>Customer E-mail Address</td><td>First Name</td><td>Last Name</td><td>Order Address</td><td>Retrival Start Date/Time</td><td>Retrival End Date/Time</td><td>Delivery Start Date/Time</td><td>Delivery End Date/Time</td><td>Personal Request</td><td>Progress</td><td>Credit Card</td><td>Promo Matched</td><td>Store Code</td>
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
foreach ($users as $user) { $ct++;

$cardnocount	=	strlen($creditCards[$user['creditCardIndex']]['number']);
$cardno		=	substr($creditCards[$user['creditCardIndex']]['number'],-4,$cardnocount);

?>
<tr style = 'border-bottom:1px solid gray; cursor:pointer' onclick = 'onDetail("<?php echo $user['objectId']; ?>");' id = 'tr_<?php echo $user['objectId'];?>'>
<input type = 'hidden' id = 'zipCode_tr_<?php echo $user['objectId']; ?>' value = '<?php echo $addresses[$user['addressID']]['zipCode']; ?>'>
<input type = 'hidden' id = 'phoneno_tr_<?php echo $user['objectId']; ?>' value = '<?php echo $realUsers[$user['userID']]['phoneNumber']; ?>'>
<?php echo "<td>$ct</td><td id = '{$user['objectId']}_orderNo'>{$user['orderNo']}</td><td>{$realUsers[$user['userID']]['username']}</td><td>{$realUsers[$user['userID']]['firstName']}</td><td>{$realUsers[$user['userID']]['lastName']}</td><td>{$addresses[$user['addressID']]['address']}</td><td>" . gettime($user['retrievalAtFrom']['iso']) . "</td><td>" . gettime($user['retrievalAtTo']['iso']) . "</td><td>" . gettime($user['deliveryAtFrom']['iso']) . "</td><td>" . gettime($user['deliveryAtTo']['iso']) . "</td><td>{$user['personalRequest']}</td><td>{$orderTypes[$user['progress']]}</td><td>xxxx-xxxx-xxxx-$cardno</td><td>{$user['promoMatched']}</td><td>{$user['storeCode']}</td>"; ?>
</tr>
<?php } ?>
</tbody>
</table>
</div>	
<div style = 'position:absolute; width:100%; height:100%; left:0px; top:0px; background-color:black; opacity:0.6'  onclick = 'document.getElementById("filterview1").style.visibility =document.getElementById("filterview").style.visibility = "hidden";' id = 'filterview'>
</div>
<div style = 'position:absolute;width:600px;opacity:1; height:360px;left:50%; top:100px; margin-left:-300px;  background-color:white; border:1px solid black' id = 'filterview1'>
&nbsp;<a href = 'javascript:void(0);' onclick = 'document.getElementById("filterview1").style.visibility =document.getElementById("filterview").style.visibility = "hidden";'>Hide</a>
<table style = 'width:100%;'>
<tr><td style = 'width:100px;' /><td style = 'width:400px' align = 'center'>
<table cols = '30%, *'>
<tr style = 'height:50px'><td style = 'width:180px'>Customer E-Mail Address</td><td><input type = email id = 'email'></tr>
<tr style = 'height:40px'><td style = 'width:180px'>Phone</td><td><input type = text id = 'phoneno'></tr>
<tr style = 'height:40px'><td style = 'width:180px'>First Name</td><td><input type = text id = 'firstname'></tr>
<tr style = 'height:40px'><td style = 'width:180px'>Last Name</td><td><input type = text id= 'lastname'></tr>
<tr style = 'height:40px'><td style = 'width:1850px'>Address</td><td><input type = text id = 'address'></tr>
<tr style = 'height:40px'><td style = 'width:1850px'>Zip Code</td><td><input type = text id = 'zipcode'></tr>
<tr style = 'height:40px'><td style = 'width:1850px'>order date</td><td><input type = date id = 'placeddate'></tr>
<tr style = 'height:40px'><td colspan = 2 align = 'center'><input type = button value = 'Search' onclick = 'searchnow();'></tr>
</table>
</td><td/></tr></table>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
function searchnow()
{
$("#tbody tr").each(function(ind, ele) {
var id = this.id;
var flag = false;
if ($("#" + id +" td")[2].innerHTML.toLowerCase().indexOf(document.getElementById('email').value.toLowerCase()) == -1) flag = true;
if ($('#phoneno_' + id)[0].value.toLowerCase().indexOf(document.getElementById('phoneno').value.toLowerCase()) == -1) flag = true;
if ($("#" + id +" td")[3].innerHTML.toLowerCase().indexOf(document.getElementById('firstname').value.toLowerCase()) == -1) flag = true;
if ($("#" + id +" td")[4].innerHTML.toLowerCase().indexOf(document.getElementById('lastname').value.toLowerCase()) == -1) flag = true;
if ($("#" + id +" td")[5].innerHTML.toLowerCase().indexOf(document.getElementById('address').value.toLowerCase()) == -1) flag = true;
if ($("#zipCode_" + id)[0].innerHTML.toLowerCase().indexOf(document.getElementById('zipcode').value.toLowerCase()) == -1) flag = true;
if ($("#" + id +" td")[6].innerHTML.toLowerCase().indexOf(document.getElementById('placeddate').value.toLowerCase()) == -1) flag = true;
this.style.visibility = (flag == true ? 'hidden' : 'visible');
});
}
function searchFilter()
{
window.location.reload(true);	
document.getElementById('filterview').style.visibility=document.getElementById('filterview1').style.visibility= 'visible';
event.preventDefault();

}
function onDetail(id)
{
window.location.href = 'detailOrder.php?id=' + id + '&orderNo=' + document.getElementById(id + '_orderNo').innerHTML;
}
</script>