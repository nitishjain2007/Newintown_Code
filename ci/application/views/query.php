<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
var twobhk = 0;
var threebhk = 0;
var fourbhk = 0;
var all = 0;
var ad = 0;
var advancestate = 0;
var typearray = ["twobhk", "threebhk", "fourbhk"];
function statechange(){
  alert("hi");
  document.getElementById("statechange").innerText = "RemoveAdvancefilters";
}
function loadXMLDocdelay(types){
  //alert(types);
  setTimeout("loadXMLDoc("+ types + ")",1);
}
function loadXMLDoc(types)
{
  console.log(types);
  var lng = document.getElementById("lng").innerHTML;
  var lat = document.getElementById("lat").innerHTML;
  window[types] = window[types] ^ 1;
  var type = "";
  var advance = "";
  if(types!=""){
    for(i=0;i<typearray.length;i++){
      if(window[typearray[i]] == 1){
        if(typearray[i] == "twobhk"){
          type = type + "," + "2BHK";
        }
        else if(typearray[i] == "threebhk"){
          type = type + "," + "3BHK";
        }
        else if(typearray[i] == "fourbhk"){
          type = type + "," + "4BHK";
        }
        else{
          type = type + "," + typearray[i];
        }
      }
    }
    type = type.substr(1);
    document.getElementById("types").innerHTML = type;
    //alert(type);
  }
var advancevars = document.getElementsByName("advance[]");
for(i=0;i<advancevars.length;i++){
  if(advancevars[i].checked){
    advance = advance + "," + advancevars[i].value;
  }
}
advance = advance.substr(1);
type=document.getElementById("types").innerHTML;
console.log(type);
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
    document.getElementById("getcontent").innerHTML=xmlhttp.responseText;
    }
  }
if(type == ""){
xmlhttp.open("GET","getplaces?type=all&lng="+lng+"&lat="+lat+"&advance="+advance,true);
}
else{
xmlhttp.open("GET","getplaces?type="+type+"&lng="+lng+"&lat="+lat+"&advance="+advance,true);
}
xmlhttp.send();
}
window.onload = loadXMLDocdelay("all");
</script>
<body>
<button type="button" id="twobhk" onclick="loadXMLDoc(this.id)">2BHK</button>
<button type="button" id="threebhk" onclick="loadXMLDoc(this.id)">3BHK</button>
<button type="button" id="fourbhk" onclick="loadXMLDoc(this.id)">4BHK</button>
<button type="button" id="statechange" onclick="statechange()">show advancefilters</button>
<div id="advancefilters">
  <input type="checkbox" id="ad" name="advance[]" value="ac" onchange="loadXMLDoc(this.id)"/>ac<br>
  <input type="checkbox" id="ad" name="advance[]" value="fridge" onchange="loadXMLDoc(this.id)"/>fridge<br>
  <input type="checkbox" id="ad" name="advance[]" value="microwave" onchange="loadXMLDoc(this.id)"/>microwave<br>
  <input type="checkbox" id="ad" name="advance[]" value="washing_machine" onchange="loadXMLDoc(this.id)"/>washing machine<br>
  <input type="checkbox" id="ad" name="advance[]" value="ro" onchange="loadXMLDoc(this.id)"/>ro<br>
  <input type="checkbox" id="ad" name="advance[]" value="security" onchange="loadXMLDoc(this.id)"/>security<br>
  <input type="checkbox" id="ad" name="advance[]" value="laundry" onchange="loadXMLDoc(this.id)"/>laundry<br>
  <input type="checkbox" id="ad" name="advance[]" value="gas_stove" onchange="loadXMLDoc(this.id)"/>gas stove<br>
  <input type="checkbox" id="ad" name="advance[]" value="parking" onchange="loadXMLDoc(this.id)"/>parking<br>
</div>
<div id="getcontent">
</div>
<div id="getgps" style="visibility: hidden;">
  <div id="types"></div>
  <div id="lng"><?php echo $lngstr ?></div>
  <div id="lat"><?php echo $latstr ?></div> 
  <div id="type"><?php echo $type ?></div>
</div>
</body>
</html>