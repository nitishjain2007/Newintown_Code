<!DOCTYPE html>
<html>
<head>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
<script>
function gdelay(){
	setTimeout("g()",2000);
}
function g(){
	//alert("hi");
	var lng = document.getElementById('cityLng').value;
	var lat = document.getElementById('cityLat').value;
	window.location="http://localhost/ci/index.php/controller1/four?lng="+lng+"&lat="+lat;
}
function initialize(){
var defaultBounds = new google.maps.LatLngBounds(
	new google.maps.LatLng(28.459496500000000000, 77.026638300000060000)
	);
//document.getElementById('searchTextField').innerHTML += ' gurgaon';
//document.getElementById('searchTextField').innerHTML =
var input1 = document.getElementById('searchTextField');
//var input2 = document.getElementById('3');
//input3 = input1 + input2;
//alert(input3);
var options = {
	//types: ['administrative_area1': 'gurgoan'],
	bounds: defaultBounds,
	componentRestrictions: {country: 'in'}
};
var autocomplete = new google.maps.places.Autocomplete(input1, options);
google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            document.getElementById('city2').value = place.name;
            document.getElementById('cityLat').value = place.geometry.location.lat();
            document.getElementById('cityLng').value = place.geometry.location.lng();
        });
}
google.maps.event.addDomListener(window, 'load', initialize);
function h(){
	alert("hi");
	window.setTimeout(function(){
		document.forms['places'].submit();
	}, 10000);
}
</script>
<style>
#body{
	margin-left:auto;
    margin-right:auto;
    height:auto; 
    width:auto;
}
#header{
	margin-top: -0.7%;
	background-color: black;
	margin-left: -0.7%;
	padding-top: 0px;
	width: 101.4%;
	position: fixed;
}
#holograph{
	height: 20%;
	width: 35%;
	background-color: rgba(0,0,0,0.3);
	border-radius:15px;
	margin-left: 32%;
}
#container{
	background-image: url(../../images/image.jpg);
	margin-left:-0.7%;
	width: 101.4%;
	height:900px;
	overflow:auto;
}
#content1{
	margin-top: 15%;
}
#footer{
	background-color: black;
	width: 101.4%;
	margin-left:-0.7%;
	margin-top: -1.4%;
	margin-bottom: -1.4%;
}
.pac-item: hover{background-color: brown! important;}
</style>
</head>
<body>
<div id="header">
<img src="../../images/newintown_in.png" height="75px" width="400px">
</div>
<div id="container">
<div id="content1">
<font size="6" color="white"><p style="text-align:center;">Introducing <font color="red">Easy & Convinient </font>House Hunting</p></font>
</div>
<div id="holograph">
<h1>This space is meant for carausel</h1>
</div>
<!--sector: <input type="text" name="sector" placeholder="sector"><br>-->
<input id="searchTextField" type="text" size="50" style="background:rgba(0,0,0,0);color: white;" onKeydown="Javascript:    if(event.keyCode==13)gdelay();"><br>
<input type="hidden" id="city2" name="city2" />
<input type="hidden" id="cityLat" name="cityLat" />
<input type="hidden" id="cityLng" name="cityLng" />  
<button type="submit" onclick="gdelay()">submit</button>
</div>
<div id="footer">
<! this represents example for retrieving data from controller ie year!>
<p style="text-align:center;"><font size="4" color="white">Copyright &copy Newintown.in </font></p>
</div>
</body>