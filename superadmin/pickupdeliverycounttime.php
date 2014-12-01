<?php
include 'header.php';
include 'navigation.php';
function gettime($t)
{
	$str = new DateTime($t['iso']);
	return $str->format("m/d/Y H:i");
}


$stores = array();
if($_SESSION['userRole']==0)
{
	$orders = json_decode(getObjectsInClass('Order', '{}'), true);
}
else
{
	$orders = json_decode(getObjectsInClass('Order', '{"storeCode":"'.$_SESSION['storeID'].'"}'), true);
}


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
	$drivers = $stores;
}
else
{
	$result = json_decode(getObjectsInClass('Driver', '{"storeCode":"' . $_SESSION['storeID'] .  '"}'), true);
	$stores = $result['results'];
}


if($_REQUEST['msg']==2)
{
	?>
    <script>
    alert("Sucessfully Update");
	window.location.href = 'http://thedhobi.com/superadmin/pickupdeliverycounttime.php?id=0';	
    </script>
    
 <?php   
}
?>
<div id="content">
<center><h2>Driver Statistics</h2></center>	
<div>

<table class="table table-bordered table-striped table-white" style = 'width:100%' id="mainTable">
<thead style = " background-color: #3695d5; font-weight:bold; color:white">
<td>No.</td><td onclick = 'sort_column(0);' style = 'cursor:pointer'>First Name</td><td onclick = 'sort_column(1);'  style = 'cursor:pointer'>Last Name</td><td onclick = 'sort_column(2);'  style = 'cursor:pointer'>Store Code</td><td onclick = 'sort_column(3);'  style = 'cursor:pointer'>Unique Code</td><td onclick = 'sort_column(4);'  style = 'cursor:pointer'>Number of Pickups/Delivery</td><td>Pickup/Delivery Times</td><td>Action</td>
</thead>
<tbody id = 'tbody'>
<?php 
$ct = 0;

foreach ($drivers as $store) { $ct++;
?>
<tr  id = 'tr_<?php echo $ct; ?>'>
<?php 


$countPickup	= json_decode(getObjectsInClass('Order', '{"driverCode":"'.$store['userCode'].'"}'), true);


$count =	count($countPickup['results']);

$times = '';
//var_dump($timesArr);
//	foreach ($timesArr[$store['userCode']] as $t)
//		$times .= gettime($t['updatedAt']) . '<br>';

$times =  (new DateTime($countPickup['updatedAt']))->format('m/d/Y H:i');
	echo "<td>$ct</td><td id = '{$ct}_0'>{$store['firstName']}</td><td id = '{$ct}_1'>{$store['lastName']}</td><td id = '{$ct}_2'>{$store['storeCode']}</td>";
	echo "<td id = '{$ct}_3'>{$store['userCode']}</td> ";
	echo "<td id = '{$ct}_4'>{$count}</td> ";
	echo "<td id = '{$ct}_5'>{$times}</td>";
	echo "<td id ='td_{$store['objectId']}'><a href='removedriver.php?id={$store['objectId']}'><input type = button value = 'Delete' ></td>";	
	?>
</tr>
<?php }  exit; ?>
</tbody>
</table>

<?php
for($l=0;$l<count($orders);$l++)
{
	$status	=	$orders[$l]['progress'];
	if($status	!=	"5")
	{
		
	
	
	$status1[]	=	$status;	
	$add = json_decode(getObjectsInClass('Address', '{"objectId":"'.$orders[$l]['addressID'].'"}'), true);
	$addresult[]	=	$add['results'][0];
	}
}


if(count($addresult)=='0')
{
	
	$lat1	=	"40.7113616";
	$long1	=	"-74.00784519999999";
}
else
{
	$lat1	=	$addresult[0]['latitude'];
	$long1	=	$addresult[0]['longitude'];
	
}

$orderTypes = array("Placed",
 "Retrieved",
 "Cleaning",
 "OnRoute",
 "HandDelivered",
 "Confirmed");



?>
<div id="map" style=" height:500px">
</div>
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
var count = 0;

</script>
 <script>
 function initialize() {
	 
	 	var lat	= <?php echo $lat1; ?>;
		 var long = <?php echo $long1; ?>;
		
		var secheltLoc = new google.maps.LatLng(lat,long),
			markers,
		 	myMapOptions = { 
			zoom: 8,
			center: secheltLoc,
            mapTypeId: google.maps.MapTypeId.ROADMAP
		},
		
		 map = new google.maps.Map(document.getElementById("map"), myMapOptions);
		function initMarkers(map, markerData) {
        var newMarkers = [],
            marker;
			
			
			 for(var i=0; i<markerData.length; i++) {
            marker = new google.maps.Marker({
                map: map,
                draggable: false,
                position: markerData[i].latLng,
                visible: true
            }),
            boxText = document.createElement("div"),
            //these are the options for all infoboxes
            infoboxOptions = {
                 content: boxText,
                disableAutoPan: false,
                maxWidth: 0,
                pixelOffset: new google.maps.Size(-140, 0),
                zIndex: null,
                boxStyle: {
                    background: "url('http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/examples/tipbox.gif') no-repeat",
                    opacity: 0.75,
                    width: "280px"
                },
                closeBoxMargin: "12px 4px 2px 2px",
                closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
                infoBoxClearance: new google.maps.Size(1, 1),
                isHidden: false,
                pane: "floatPane",
                enableEventPropagation: false
            };
            
            newMarkers.push(marker);
            //define the text and style for all infoboxes
            boxText.style.cssText = "border: 1px solid black; margin-top: 8px; background:#333; color:#FFF; font-family:Arial; font-size:12px; padding: 5px; border-radius:6px; -webkit-border-radius:6px; -moz-border-radius:6px;";
            boxText.innerHTML = markerData[i].address + "<br>" + markerData[i].state;
            //Define the infobox
            newMarkers[i].infobox = new InfoBox(infoboxOptions);
            //Open box when page is loaded
           // newMarkers[i].infobox.open(map, marker);
            //Add event listen, so infobox for marker is opened when user clicks on it.  Notice the return inside the anonymous function - this creates
            //a closure, thereby saving the state of the loop variable i for the new marker.  If we did not return the value from the inner function, 
            //the variable i in the anonymous function would always refer to the last i used, i.e., the last infobox. This pattern (or something that
            //serves the same purpose) is often needed when setting function callbacks inside a for-loop.
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    newMarkers[i].infobox.open(map, this);
                    map.panTo(markerData[i].latLng);
                }
            })(marker, i));
        }
        
        return newMarkers;
    }
    
    //here the call to initMarkers() is made with the necessary data for each marker.  All markers are then returned as an array into the markers variable
    markers = initMarkers(map, [
	 <?php
  for ($s = 0; $s < count($addresult); $s++) {
	  ?>
        { latLng: new google.maps.LatLng(<?php echo $addresult[$s]['latitude']; ?>, <?php echo $addresult[$s]['longitude']; ?>), address: "Address: <?php echo $addresult[$s]['address']; ?>", state: "Status: <?php echo $orderTypes[$status1[$s]]; ?>" },
       
		<?php } ?>
    ]);
}
	google.maps.event.addDomListener(window, 'load', initialize);
      </script>
    
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js? key=AIzaSyB3is760vHXhki9vS_LpiWAig8a33GP3CY&sensor=false"></script>  
      
 <script type="text/javascript" src="infobox.js"></script>

 <?php include 'footer.php'; ?>