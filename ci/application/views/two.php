<!DOCTYPE html>
<html>
<head>
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
</style>
<script type="text/javascript">
function loadXMLDoc(){
//	alert("hi");
	var s = document.getElementsByName("select1[]");
//	alert(s);
//	alert(s);
	var choice = "";
	var sector = '<?=$_POST['sector']?>';
//	alert(sector);
	y={};
	for(var i=0; i<s.length; i++){
		if(s[i].checked){
			y[s[i].value]="yes";
//			alert("yes");
		}
		else{
			y[s[i].value]="no";
//			alert("no");
		}
	}
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
  //  alert("lol");
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
  }
//alert(y["2BHK"]);
//alert(y["3BHK"]);
xmlhttp.open("GET","three?2BHK="+y["2BHK"]+"&3BHK="+y["3BHK"]+"&sector="+sector,true);
xmlhttp.send();
//alert("hiiiiii");
}
</script>
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
<font color="white">
2BHK:<input type="checkbox" name="select1[]" value="2BHK" onchange="loadXMLDoc()"/>
3BHK:<input type="checkbox" name="select1[]" value="3BHK" onchange="loadXMLDoc()"/>
<br>
<font color="white">

<?php
	echo "<br>";
?>
<div id="myDiv">
<?php
foreach($first->result() as $d){
	echo $d->address;
	echo "<br>";
	echo $d->type;
	echo "<br>";
	echo $d->sector;
	echo "<br><br>";
}
?>
</div>
</div>
<div id="footer">
<! this represents example for retrieving data from controller ie year!>
<p style="text-align:center;"><font size="4" color="white">Copyright &copy Newintown.in </font></p>
</div>
</body>