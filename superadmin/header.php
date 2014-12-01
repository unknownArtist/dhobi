<?php ob_start();
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require_once('curl.php');
error_reporting(0);
if ($_SESSION['logined'] == 1)
{
	if($_SESSION['userRole']==2)
	{
		if($_SESSION['storeID']=='')
		{
			header('location:login.php');
			
		}
	}
}

else 
{
	header('location:login.php');
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 sidebar sidebar-discover"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 sidebar sidebar-discover"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 sidebar sidebar-discover"> <![endif]-->
<!--[if gt IE 8]> <html class="ie sidebar sidebar-discover"> <![endif]-->
<!--[if !IE]><!--><html><!-- <![endif]-->
<head>
	<title>The Dhobi - Admin Panel</title>
	
	<!-- Meta -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	
	
	<!-- 
	**********************************************************
	In development, use the LESS files and the less.js compiler
	instead of the minified CSS loaded by default.
	**********************************************************
	<link rel="stylesheet/less" href="../assets/less/admin/module.admin.stylesheet-complete.less" />
	-->

		<!--[if lt IE 9]><link rel="stylesheet" href="../assets/components/library/bootstrap/css/bootstrap.min.css" /><![endif]-->
	<link rel="stylesheet" href="../assets/css/admin/module.admin.stylesheet-complete.min1.css" />
    <link rel="stylesheet" href="../assets/components/library/bootstrap/css/bootstrap.min1.css" />
    <link rel="stylesheet" href="../assets/components/library/icons/fontawesome/assets/css/font-awesome.min.css" />
    
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->



 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
	
	$("#content").hover(
		function(){
		$('.dropdown-menu').css('display', 'none'); 
		});
		
		
		$("#dropdown-toggle1").hover(
		function(){
        $('#dropdown-menu1').css('display', 'block');
		$('#dropdown-menu2').css('display', 'none'); 
		$('#dropdown-menu3').css('display', 'none'); 
		 
    });
	
	$("#dropdown-toggle2").hover(
		function(){
        $('#dropdown-menu2').css('display', 'block');
		$('#dropdown-menu1').css('display', 'none'); 
		$('#dropdown-menu3').css('display', 'none'); 
		 
    });
	
	$("#dropdown-toggle3").hover(
		function(){
        $('#dropdown-menu3').css('display', 'block');
		$('#dropdown-menu1').css('display', 'none'); 
		$('#dropdown-menu2').css('display', 'none'); 
		 
    });

	
	});
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
	<style>
	input[type="text"], input[type="password"], select, textarea {
    border-color: #E2E1E1;
    color: #000;
}
button[disabled], html input[disabled]
{ color:#000;}
	</style>
    
    
	
</head>
<body class="scripts-async" style="background-color:rgb(234, 234, 234)" onLoad="initialize();">
	<!-- Main Container Fluid -->
