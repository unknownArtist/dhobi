<?php
include 'header.php';
include 'navigation.php';

	$result = json_decode(getObjectsInClass('StoreAdmin','{}'), true);
	$results	=	$result['results'];
?>

	
<div id="content">
<center><h2>View Store Admin Information</h2></center>
<table class="table table-bordered table-striped table-white">
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td onclick = 'sort_column(0);' style = 'cursor:pointer'>No.</td><td onclick = 'sort_column(1);' style = 'cursor:pointer'>Store Admin Name</td><td onclick = 'sort_column(2);' style = 'cursor:pointer'>E-mail Address</td><td  style = 'cursor:pointer'  onclick = 'sort_column(4);' >Store ID</td>
</thead>
<tbody id = 'tbody'>
<?php 
$cou = 1;
foreach ($results as $user) { 
?>

<tr style = 'border-bottom:1px solid gray' id = 'tr_<?php echo $cou; ?>'>
<?php  echo "<td>{$cou}</td><td id = '{$cou}_1'>{$user['fullname']}</td><td id = '{$cou}_2'>{$user['username']}</td><td id = '{$cou}_3'>{$user['storeID']}</td>"; ?>
<?php /* echo "<td id = '{$cou}_0' >{$user['customerKey']}</td><td id = '{$cou}_1'>{$user['firstName']}</td><td id = '{$cou}_2'>{$user['lastName']}</td><td>{$user['username']}</td><td id = '{$cou}_4'>{$user['storeCode']}</td><td>{$user['phoneNumber']}</td><td><a href = 'javascript:void(0);' onclick = 'onEdit(\"{$user['objectId']}\");'>Edit</a></td>";*/ ?>
</tr>
<?php $cou++;} ?>
</tbody>
</table>
</div>	
<script>
var sortFlag = [1,1,1,0,1];
var data = <?php echo json_encode($users); ?>;
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

function onEdit(id)
{
window.location.href = 'editcustomerinfo.php?id=' + id;
}
</script>
<?php include 'footer.php'; ?>