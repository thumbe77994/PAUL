<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Google Maps JavaScript API v3 Example: Geocoding Simple</title>


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var geocoder;
var map;
function initialize() {
geocoder = new google.maps.Geocoder();
var myOptions = {
zoom: 15,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
codeAddress();
}

function codeAddress() {
var address = '<?php echo $_GET['id']?>'
if (geocoder) {
geocoder.geocode({ 'address': address }, function(results, status) {
if (status == google.maps.GeocoderStatus.OK) {
map.setCenter(results[0].geometry.location);
var marker = new google.maps.Marker({
map: map,
position: results[0].geometry.location
});
} else {
alert("Geocode was not successful for the following reason: " + status);
}
});
}
}
</script>
<style type="text/css">
<!--
.style1 {color: #666666}
-->
</style>
</head>

<body style="margin:0px; padding:0px;" onLoad="initialize()">
<center>
  <span class="style1"><?php echo $_GET['id']?> <a href="Javascript:OnClick=history.back()">回上頁</a></span>
</center>
<form name="form1" method="post" action="maps2.php">
  <div align="center">
     
       
     
  </div>
</form>
 
<div id="map_canvas" style="width:100%; height:90%"></div>
 

</body>
</html>