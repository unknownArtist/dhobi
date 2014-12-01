<?php
include 'header.php';
include 'navigation.php';
function sort_users($arr)
{
$count = sizeof($arr);
for ($i = 0; $i < $count - 1; $i++)
for ($j = $i + 1; $j < $count; $j++)
if ($arr[$i]['createdAt']['iso'] < $arr[$j]['createdAt']['iso'])
{
$t = $arr[$i]; $arr[$i] = $arr[$j]; $arr[$j] = $t;
}
foreach ($arr as $key => $value)
{
$arr[$key]['customerKey'] = sprintf("SYS%06d", $key + 1);
}
return $arr;
}


$result = json_decode(getUsers(), true);


$result = ($result['results']);
$result = sort_users($result);
$users = array();
if ($_SESSION['userRole'] == 0) $users = $result;
if($_SESSION['userRole']==1) 
{
	
	foreach ($result as $user)
	{
		if ($user['storeCode'] == $_SESSION['storeID']) $users[] = $user;
	}
	
	
}
else
{
	foreach ($result as $user)
	{
		if ($user['objectId'] == $_SESSION['objectId']) $users[] = $user;
	}	
}
$count = sizeof($users);
/*for ($i = 0; $i < $count - 1; $i++)
	for ($j = $i + 1; $j < $count; $j ++)
		if (strcmp('a' . $users[$i]['storeCode'], 'a' . $users[$j]['storeCode']) == 1)
		{
			$t = $users[$i]; $users[$i] = $users[$j]; $users[$j] = $t;
		} */
?>



	
<div id="content">
<center><h2>View Customer Information</h2></center>
<table class="table table-bordered table-striped table-white">
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td onclick ="sort_column(0);" style="cursor:pointer">Customer Code</td><td onclick="sort_column(1);" style="cursor:pointer">First Name</td><td  style = 'cursor:pointer' onclick = 'sort_column(2);'>Last Name</td><td style = 'cursor:pointer' onclick = 'sort_column(3);'>E-mail Address</td><td  style = 'cursor:pointer'  onclick = 'sort_column(4);' >Store Code</td><td style = 'cursor:pointer' onclick = 'sort_column(5);'>Phone Number</td>
</thead>
<tbody id = 'tbody'>
<?php 
$cou = 0;
foreach ($users as $user) { $cou++;
?>

<tr style = 'border-bottom:1px solid gray' id = 'tr_<?php echo $cou; ?>'>
<?php  echo "<td id = '{$cou}_0' >{$user['customerKey']}</td><td id = '{$cou}_1'>{$user['firstName']}</td><td id = '{$cou}_2'>{$user['lastName']}</td><td id = '{$cou}_3'>{$user['username']}</td><td id = '{$cou}_4'>{$user['storeCode']}</td><td id = '{$cou}_5'>{$user['phoneNumber']}</td>"; ?>
<?php /* echo "<td id = '{$cou}_0' >{$user['customerKey']}</td><td id = '{$cou}_1'>{$user['firstName']}</td><td id = '{$cou}_2'>{$user['lastName']}</td><td>{$user['username']}</td><td id = '{$cou}_4'>{$user['storeCode']}</td><td>{$user['phoneNumber']}</td><td><a href = 'javascript:void(0);' onclick = 'onEdit(\"{$user['objectId']}\");'>Edit</a></td>";*/ ?>
</tr>
<?php } ?>
</tbody>
</table>
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
var count = 0;


</script>
<?php include 'footer.php'; ?>