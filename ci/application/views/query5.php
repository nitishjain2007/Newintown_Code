<!DOCTYPE html>
<html>
<head>
<link href="../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../bootstrapvalidator/dist/css/bootstrapValidator.css" rel="stylesheet">
<link href="../../bootstrap-timepicker/css/bootstrap-responsive.css">
<link href="../../bootstrap-timepicker/css/bootstrap-timepicker.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script type="text/javascript" src="../../bootstrapvalidator/vendor/jquery/jquery-1.10.2.min.js"></script>
<link rel="stylesheet" href="../../jquery-ui/development-bundle/themes/base/jquery.ui.all.css">
<script src="../../jquery-ui/development-bundle/jquery-1.10.2.js"></script>
<script src="../../jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
<script src="../../jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="../../jquery-ui/development-bundle/ui/jquery.ui.mouse.js"></script>
<script src="../../jquery-ui/development-bundle/ui/jquery.ui.button.js"></script>
<script src="../../jquery-ui/development-bundle/ui/jquery.ui.draggable.js"></script>
<script src="../../jquery-ui/development-bundle/ui/jquery.ui.position.js"></script>
<script src="../../jquery-ui/development-bundle/ui/jquery.ui.resizable.js"></script>
<script src="../../jquery-ui/development-bundle/ui/jquery.ui.button.js"></script>
<script src="../../jquery-ui/development-bundle/ui/jquery.ui.dialog.js"></script>
<script src="../../jquery-ui/development-bundle/ui/jquery.ui.effect.js"></script>
<script src="../../bootstrapvalidator/dist/js/bootstrapValidator.js"></script>
<script src="../../bootstrap/dist/js/bootstrap.js"></script>
<script src="../../bootstrap/js/tooltip.js"></script>
<script src="../../bootstrap/js/popover.js"></script>
<script src="../../bootstrap/js/alert.js"></script>
<script src="../../bootstrap/js/dropdown.js"></script>
<script src="../../bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1H88PyXHfW2qihya9R0VwoOF3cKmlSmY&sensor=FALSE&libraries=places">
    </script>
<script src="../../static/js/viewer.js"></script>
<script src="../../static/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="../../static/css/datepicker.css">
<link rel="stylesheet" href="../../static/css/mainpage.css">
<style>
.dropdown-menu{
    min-width: 0px;
}
</style>
<style>
.btn-popover-container {
    display: inline-block;
}
.btn-popover-container .btn-popover-title, .btn-popover-container .btn-popover-content {
    display: none;
}
</style>
<script>
$(function() {
$('.datepicker').datepicker();
});
</script>
<script>
function logout(){
    document.getElementById("logoutformmain").submit();
}
function n(){
	$('#registerpop').show();
}
function h(){
    window.setTimeout(function(){
        document.forms['places'].submit();
    }, 10000);
}
function giveresultdelay(){
	$('#div1').hide();
	$('#div2').show();
    setTimeout("giveresult()",10000);
}
function giveresult(){
    var lng = document.getElementById('cityLng').value;
    var lat = document.getElementById('cityLat').value;
    if(lng == ""){
	alert("Please enter a Valid Address");
    }
    else{
    var type = "pg";
    window.location="http://newintown.in/ci/index.php/controller1/query?lng="+lng+"&lat="+lat+"&type="+type;
}
}
function makesitevisit(){
    var username = document.getElementById("username5").value;
    var name = document.getElementById("name5").value;
    var phone = document.getElementById("phoneno5").value;
    var pickdate = document.getElementById("datepicker1").value;
    var picktime = document.getElementById("timepicker1").value;
    var pickplace = document.getElementById("pickpoint5").value;
    $.ajax({
                type: "POST",
                url: "makesitevisit",
                data: {username: username,name: name,phone: phone,pickdate: pickdate,picktime: picktime,pickplace: pickplace}
        })
                .done(function(value){
                    if(value == "failure"){
                        alert("Already registered for Site Visit");
                    }
                    else if(value == "wrong"){
                        alert("Please Shortlist first");
                    }
                    else{
                        alert("Registered for Site Visit");
                    }
                });
}
function createuser(){
    $("#register").dialog('close');
    var name = document.getElementById("name1").value;
    var user = document.getElementById("username1").value;
    var password = document.getElementById("password1").value;
    var phoneno = document.getElementById("phoneno1").value;
    $.ajax({
        type: "POST",
        url: "createuser",
        data: {name: name, username: user, password: password, phoneno: phoneno}
    });
}
function register(){
    $( "#loginform" ).dialog( "close" );
    var user = document.getElementById("username1").value;
    $.ajax({
        type: "POST",
        url: "validate",
        data: {username: user}
    })
        .done(function(value){
        if(value == "success"){
            createuser();
            alert("You are Registered");
        }
        else{
            alert("Username exists");
            $("#register").dialog('close');
        }
        });
}
function initialize(){
var defaultBounds = new google.maps.LatLngBounds(
    new google.maps.LatLng(28.459496500000000000, 77.026638300000060000)
    );
var input1 = document.getElementById('searchTextField');
var options = {
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
</script>
<script>
window.onload=function(){
    document.getElementById("button2").click();
    var h = document.getElementById("logoutchecker").innerHTML;
    if(h=="yes"){
        document.getElementById("logoutpopup").click();
    }
}
</script>
<script>
    $(function() {
        var name = $( "#name" ),
            email = $( "#email" ),
            password = $( "#password" ),
            allFields = $( [] ).add( name ).add( email ).add( password ),
            tips = $( ".validateTips" );

        function updateTips( t ) {
            tips
                .text( t )
                .addClass( "ui-state-highlight" );
            setTimeout(function() {
                tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        }
        $( "#listform" ).dialog({
            autoOpen: false,
            height: 350,
            width: 400,
            modal: true,
            buttons: {
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });

        $( "#listpopup" )
            .button()
            .click(function() {
                $( "#listform" ).dialog( "open" );
            });
    });
</script>
<script>
    $(function() {
        var name = $( "#name" ),
            email = $( "#email" ),
            password = $( "#password" ),
            allFields = $( [] ).add( name ).add( email ).add( password ),
            tips = $( ".validateTips" );

        function updateTips( t ) {
            tips
                .text( t )
                .addClass( "ui-state-highlight" );
            setTimeout(function() {
                tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        }
        $( "#loginform" ).dialog({
            autoOpen: false,
            height: 300,
            width: 350,
            modal: true,
            buttons: {
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            },
            close: function() {
                allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });

        $( "#loginpopup" )
            .button()
            .click(function() {
                $( "#loginform" ).dialog( "open" );
            });
    });
</script>
<script>
    $(function() {
        var name = $( "#name" ),
        email = $( "#email" ),
        password = $( "#password" ),
        allFields = $( [] ).add( name ).add( email ).add( password ),
        tips = $( ".validateTips" );

        function updateTips( t ) {
            tips
                .text( t )
                .addClass( "ui-state-highlight" );
            setTimeout(function() {
                tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        }
        $( "#register").dialog({
            autoOpen: false, 
            height: 500, 
            width: 400,
            modal: true,
            buttons: {
                Cancel: function() {
                        $( this ).dialog( "close" );
                }
            },
            close: function() {
                allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });

        $( ".registerform")
                .button()
                .click(function() {
                        $( "#register" ).dialog( "open" );
                });
    });
</script>
<script>
var currentview = "";
function closecurrent(ids){
  var state = 0;
  if(window["currentview"]!=""){
    var h = "#" + window["currentview"] + "_toggler";
    if(window["currentview"]!=ids){
      $(h).toggle("slow", function(){
          //Animation complete
      });
    }
  }
  if(window["currentview"] == ids){
    window["currentview"] = "";
    state=1;
  }
  if(state==0){
    window["currentview"] = ids;
  }
}
function viewshort(ids){
    $.ajax({
        type: "POST",
        url: "checkifshort"
    })
        .done(function(value){
            if(value == "success"){
               window.location = "http://localhost/ci/index.php/controller1/viewshortlist"; 
            }
            else{
                alert("PLease Shortlist a Property First");
            }
        });  
}
function checkshort(){
	var user = document.getElementById("shortusernamevar").value;
	var password = document.getElementById("shortpasswordvar").value;
//	alert(user);
//	alert(password);
        $.ajax({
                type: "POST",
                url: "checkuser",
                data: {username: user,password: password}
        })
                .done(function(value){
                if(value == "success"){
			document.getElementById("shortinusername").value = user;
			document.getElementById("shortin").submit();
		}
                else{
                        alert("wrong username/password");
                }
                });	
}
</script>
<script>
var furnishing = ["Unfurnished","Semi furnished","Fully furnished"];
var sharing = ["1","2","3,4"];
var furnishingtype = "all";
var sharingtype = "all";
var advance = "";
function furnishingchange(ids){
	alert("hi");
    var clicked = document.getElementById(ids);
    if(clicked.className == "btn btn-default"){
        clicked.className = "btn btn-primary";
    }
    else if(clicked.className == "btn btn-primary"){
        clicked.className = "btn btn-default";
    }
    window["furnishingtype"] = "";
    for(i=0;i<furnishing.length;i++){
    	alert(furnishing[i]);
        var temp = document.getElementById(furnishing[i]);
        if(temp.className == "btn btn-primary"){
            window["furnishingtype"] = window["furnishingtype"] + "," + furnishing[i];
        }
    }
    if(window["furnishingtype"]!=""){
        window["furnishingtype"] = window["furnishingtype"].substr(1);
    }
    //alert(window["furnishingtype"]);
    changecontent();
}
function sharingchange(ids){
    var clicked = document.getElementById(ids);
    if(clicked.className == "btn btn-default"){
        clicked.className = "btn btn-primary";
    }
    else if(clicked.className == "btn btn-primary"){
        clicked.className = "btn btn-default";
    }
    window["sharingtype"] = "";
    for(i=0;i<sharing.length;i++){
        var temp = document.getElementById(sharing[i]);
        if(temp.className == "btn btn-primary"){
            window["sharingtype"] = window["sharingtype"] + "," + sharing[i];
        }
    }
    if(window["sharingtype"]!=""){
        window["sharingtype"] = window["sharingtype"].substr(1);
    }
    //alert(window["sharingtype"]);
    changecontent();
}
function addedclass(){
    var li=document.createElement('h5');
    li.innerHTML = "hi";
    li.id = "yup"
    $('#shortlistedprop').append(li);
    $('#yup').on('click', function(){
        alert("hello");
    });
}
function advancechange(){
    var advancevars = document.getElementsByName("advance[]");
    window["advance"] = "";
    for(i=0;i<advancevars.length;i++){
      if(advancevars[i].checked){
        window["advance"] = window["advance"] + "," + advancevars[i].value;
      }
    }
    if(window["advance"]!=""){
        window["advance"] = window["advance"].substr(1);
    }
    changecontent();
}
function changetopg(){
    var lng = '<?php echo $lng; ?>';
    var lat = '<?php echo $lat; ?>';
    window.location="http://newintown.co.in/ci/index.php/controller1/query?lng="+ lng + "&lat=" + lat + "&type=pg";
}
function changecontent(){
	$('#div1').hide();
	$('#div2').show();
    var lng = document.getElementById("lng").innerHTML;
    var lat = document.getElementById("lat").innerHTML;
    <?php if($log == "loggedin"){?>
	var user = "<?php echo $user; ?>";
    <?php }else{ ?>
	var user = "";
    <?php } ?> 
    $("#div1").load("five?lng=" + lng + "&lat=" + lat + "&furnishing=" + window["furnishingtype"] + "&sharing=" + window["sharingtype"] + "&advance=" + window["advance"] + "&logstatus=" + "<?php echo $log; ?>" + "&user=" + user,function(){$('#div1').show();$('#div2').hide();});
}
</script>


<script type="text/javascript" src="../../static/js/slider.js"></script>
<script>
function getshortlistedpg(){
    $.ajax({
                type: "POST",
                url: "getcurrentshortlistedpg"
        })
                .done(function(value){
                    var values = value.split(",");
                    for(i=0;i<values.length;i++){
                        if(values[i]!="false"){
                            makelinkspg(values[i]);
                        }
                    }
                });
}
function makelinkspg(value){
        var li=document.createElement('h5');
        li.innerHTML = value;
        li.id = value + "he";
        ids = '#' + value + "he";
        $('#shortlistedproppg').append(li);
        $(document).on('click', ids, function(){
            window["choosen"] = li.id.slice(0,-2);
            var h = document.getElementById(window["choosen"]);
            if(h != null){
                document.getElementById(window["choosen"]).click();
            }
            else{
                window.location = "http://localhost/ci/index.php/controller1/viewshortlist";
            }
    });
}
function getshortlistedflat(){
    $.ajax({
                type: "POST",
                url: "getcurrentshortlistedflat"
        })
                .done(function(value){
                    var values = value.split(",");
                    for(i=0;i<values.length;i++){
                        makelinksflat(values[i]);
                    }
                });
}
function makelinksflat(value){
        var li=document.createElement('h5');
        li.innerHTML = value;
        li.id = value + "he";
        ids = '#' + value + "he";
        $('#shortlistedpropflat').append(li);
        $(document).on('click', ids, function(){
            window["choosen"] = li.id.slice(0,-2);
            var h = document.getElementById(window["choosen"]);
            if(h != null){
                document.getElementById(window["choosen"]).click();
            }
            else{
                window.location = "http://localhost/ci/index.php/controller1/viewshortlist";
            }
    });
}
function removelinksflat(value){
    var id = value + "he";
    var li = document.getElementById(id);
    var parent = document.getElementById("shortlistedpropflat");
    parent.removeChild(li);
}
$(document).ready(function(){
  $(document).on("click","#button2", function(){
    var lng = document.getElementById("lng").innerHTML;
    var lat = document.getElementById("lat").innerHTML;
    <?php if($log == "loggedin"){?>
        var user = "<?php echo $user; ?>";
    <?php }else{ ?>
        var user = "";
    <?php } ?> 

    $("#div1").load("five?lng=" + lng + "&lat=" + lat + "&furnishing=all&sharing=all&adavance=" + window["advance"] + "&logstatus=" + "<?php echo $log; ?>" + "&user=" + user,function(){$('#div1').show();$('#div2').hide();getshortlistedpg();getshortlistedflat();});
  });
});
</script>
<script>
  function j(){
    var f = document.getElementById("testf");
    if(!f){
        console.log("not found");
      setTimeout(j, 50);
    }
    else{
      test1();
    }
  }
</script>
<script>
function test(){
  var d = document.getElementById("testf");
  if(!d){
    setTimeout(test, 50);
  }
  else{
    j();
  }
}
</script>
<script type="text/javascript"> $(document).ready(function () { $('.dropdown-toggle').dropdown(); }); </script>



</head>
<body>
<div id="header">
<a href="http://newintown.in/ci/index.php/controller1/main"><img src="../../static/images/newintown_in.png" height="55px" width="250px"></a>
<?php if($log == "loggedin"){?>
<button type="button" id="user" class="btn btn-lg btn-info" data-container="body" data-toggle="popover" title="username" data-placement="bottom" style="margin-top:0.8%;" >
  Welcome <?php echo " ";
                echo $user;
            ?>
</button>
<?php }?>   
<div id="logindiv" style="float: right;">
<font color="white">
<button type="button" id="listpopup" class="btn btn-lg btn-primary" data-container="body" style="height:65px;"data-toggle="popover" title="List your Property" data-placement="bottom" >
List your Property
</button>                               
<?php if($log == "loggedout" || $log == "wrong"){ ?>
<button type="button" id="loginpopup" class="btn btn-lg btn-danger" data-container="body" data-toggle="popover" title="Login" data-placement="bottom" >
  Login
</button>
<?php }else{?>
<button type="button" id="logoutpopup" class="btn btn-lg btn-danger" data-container="body" data-toggle="popover" title="Logout" data-placement="bottom" style = "border-radius: 0px;height:65px;width:100px;" onclick="logout()" >
  Logout
</button>
<?php }?>
</font>
<?php if($list == "yes"){ ?>
<div style="position:absolute;margin-top:6%;" id="listbs">
<div style="float:right;margin-right:2%;" class="bs-example">
    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        Your records recieved.
    </div>
</div>
</div>
<?php }?>
<?php if($log == "wrong"){ ?>
<div style="position:absolute;margin-top:4%;" id="bs">
<div style="float:right;margin-right:2%;" class="bs-example">
    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        The credentials are not authentic.   
    </div>
</div>
</div>
<?php }?>
<?php if($login == "yes"){ ?>
<div style="position:absolute;margin-top:6%;" id="bs">
<div style="float:right;margin-right:2%;" class="bs-example">
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Login successfull!!</strong>   
    </div>
</div>
</div>
<?php }?>
<?php if($logout == "yes"){ ?>
<div style="position:absolute;margin-top:6%;" id="bs">
<div style="float:right;margin-right:2%;" class="bs-example">
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Logout successfull!!</strong>   
    </div>
</div>
</div>
<?php }?>
<div style="position:absolute;margin-top:6%;" id="registerbs">
<div style="float:right;margin-right:2%;" class="bs-example">
    <div class="alert alert-warning" id="registerpop" style="display:none;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        You are Registered. Now You can Login.
    </div>
</div>
</div>
</div>
<div id="plk" style="background-color: #EFEFF2;height: 70px;width:100%;margin-top:0.84%;">
    <div style="left: 0;float:left;">
        <button type="button" class="btn btn-default" id="Unfurnished" style="height:50px;margin-top:10px;border-radius:0px;" onclick="furnishingchange(this.id)">Unfurnished</button>
        <button type="button" class="btn btn-default" id="Semi furnished" style="height:50px;margin-top:10px;border-radius:0px;margin-left:-4px;" onclick="furnishingchange(this.id)">Semi Furnished</button>
        <button type="button" class="btn btn-default" id="Fully furnished" style="height:50px;margin-top:10px;border-radius:0px;margin-left:-4px;" onclick="furnishingchange(this.id)">Fully Furnished</button>
    </div>
    <div style="float:left;margin-left:2.5%;">
        <button type="button" class="btn btn-default" id="1" style="height:50px;margin-top:10px;border-radius:0px;" onclick="sharingchange(this.id)">1BHK</button>
        <button type="button" class="btn btn-default" id="2" style="height:50px;margin-top:10px;border-radius:0px;margin-left:-4px;" onclick="sharingchange(this.id)">2BHK</button>
        <button type="button" class="btn btn-default" id="3,4" style="height:50px;margin-top:10px;border-radius:0px;margin-left:-4px" onclick="sharingchange(this.id)">3+BHK</button>
    </div>
    <div style="float:left;margin-left:2.5%;">
        <input id="searchTextField" class="form-control" type="text" style="background:rgba(0,0,0,0);margin-top:18px;" placeholder="Search Here" onKeydown="Javascript:    if(event.keyCode==13)giveresultdelay();">
        <input type="hidden" id="city2" name="city2" />
        <input type="hidden" id="cityLat" name="cityLat" />
        <input type="hidden" id="cityLng" name="cityLng" /> 
    </div>
    <div style="float:left;margin-left:0.5%;">
	        <button type="button" class="btn btn-primary" onclick="giveresultdelay()" style="height: 30px;margin-top:20px;float:left;">Go</button>
    </div>
    <div style="float:left;margin-left:2.5%;">
        <button type="button" class="btn btn-primary" id="<?php if($log == "loggedin"){echo "shortink";}else{echo "shortout";}?>" onclick="viewshort(this.id)" style="height:50px;margin-top:10px;border-radius:0px;">View Shortlist</button>
    </div>
    <div style="float:left;margin-left:1%" class="btn-toolbar">
    <div class="btn-group">
        <button type="button" class="btn btn-primary" style="height:50px;margin-top:10px;border-radius:0px;">Advance Filters</button>
        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" style="height:50px;margin-top:10px;border-radius:0px;margin-left:-4px;"><span class="caret"></span></button>
        <div class="dropdown-menu">
            <div id="hj" style="padding:10px;">
            <input type="checkbox" id="ad" name="advance[]" value="fridge" onchange="advancechange()"/>fridge<br>
            <input type="checkbox" id="ad" name="advance[]" value="sofa" onchange="advancechange()"/>sofa<br>
            <input type="checkbox" id="ad" name="advance[]" value="microwave" onchange="advancechange()"/>microwave<br>
            <input type="checkbox" id="ad" name="advance[]" value="washing_machine" onchange="advancechange()"/>washing machine<br>
            <input type="checkbox" id="ad" name="advance[]" value="ro" onchange="advancechange()"/>ro<br>
            <input type="checkbox" id="ad" name="advance[]" value="mattress" onchange="advancechange()"/>mattress<br>
            <input type="checkbox" id="ad" name="advance[]" value="gas_stove" onchange="advancechange()"/>gas stove<br>
            </div>
        </div>
        </div>
    </div>
    <div style="float: left;margin-left:1%;" class="btn-toolbar">
        <div class="btn-group">
        <button type="button" class="btn btn-primary" style="height:50px;margin-top:10px;border-radius:0px;">Type</button>
        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" style="height:50px;margin-top:10px;border-radius:0px;margin-left:-4px;"><span class="caret"></span></button>
        <ul class="dropdown-menu">
            <li><a href="#" onclick="changetopg()">PG</a></li>
            <li><a href="#">Rent</a></li>
        </ul>
        </div>
    </div>
</div>
</div>
<div id="container2">
<div id="content1" style="width:82%;float:left;">
<div id="div1" style="display:none;">
</div>
<div id="div2">
<img style="display:block;margin-left:auto;margin-right:auto;height:150px;width:150px;margin-top:15%;" src="../../static/images/loader.gif">
</div>
<button id="button2" style="display: none;">Get External Content</button>
</div>
<div style="float:left;min-height:900px;max-height:7000px;width:18%;background-color:#EFEFF2;">
<button type="button" id="listpopup" class="btn btn-lg btn-primary" data-container="body" style="height:65px;width:100%;"data-toggle="popover" title="List your Property" data-placement="bottom" >
Site Visit Form
</button>
<br>
<br>
<div id="shortlistedprop" style="margin-left:5%;float:left;">
<h5 >Your shortlisted properties</h5>
<div id="shortlistedproppg" style="width:50%;float:left;">
<h4>PG</h4>
</div>
<div id="shortlistedpropflat" style="width:50%;float:left;">
<h4>FLAT</h4>
</div>
</div>
<br>
<div class="container" id="sitevisitform" title="Sitevisit" style="width:90%;float:left;margin-left:5%;">
    <div class="row">
        <div id="sitevisitformdiv">
        <form id="sitevisitformmain" method="post" >
        <div class="form-group">
            <input type="text" class="form-control" name="name" id="name5" placeholder="Name" size="20"/>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="username" id="username5" placeholder="Email" size="20"/>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="phoneno" id="phoneno5" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <input id="datepicker1" type="text" class="form-control datepicker" name="date" placeholder="Pick Up Date">
        </div> 
        <div class="input-append bootstrap-timepicker form-group">
            <input id="timepicker1" type="text" class="input-small form-control" placeholder="Pick Up Time">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="point" id="pickpoint5" placeholder="Pick Up Point">
        </div>
        <div class="form-group">
            <button type="button" onclick="makesitevisit()" class="btn btn-danger">Visit</button>
        </div> 
        </form>
    </div>
    </div>
</div>
<script type="text/javascript">
$('#timepicker1').timepicker();
</script>
</div>
</div>
<div style="display:none;">
	<form id="shortin" method="post" action="viewshortlist">
		<input type="text" name="username" id="shortinusername">
	</form>
</div>
<div class="container" id="loginform" title="Login">
    <div class="row">
        <div id="loginformdiv" style="margin-left: 10%;margin-right: 10%;">
	    <form id="loginformmain" method="post" >
	    	<div class="form-group">
			<input type="text" class="form-control" name="username" placeholder="Email" size="20"/>
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="password" placeholder="Password">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Sign up</button>
			<button type="button" class="btn btn-danger registerform">Create an Account</button>
		</div>
	    </form>
	</div>
    </div>
</div>
<div class="container" id="listform" title="List your Property">
    <div class="row">
        <div id="listformdiv" style="margin-left: 10%;margin-right: 10%;">
	    <form id="listformmain" method="post" >
		<div class="form-group">
		    <input type="text" class="form-control" name="name" placeholder="Name">
		</div>
		<div class="form-group">
		    <input type="text" class="form-control" name="phoneno" placeholder="Phone Number">
		</div>
		<div class="form-group">
		    <input type="text" class="form-control" name="email" placeholder="Email">
		</div>
		<div class="form-group">
		    <button type="submit" class="btn btn-primary">Sign up</button>
		</div>
	    </form>
	</div>
    </div>
</div>
<div class="container" id="register" title="Create an Account">
        <div class="row">
                <div id="registerformdiv" style="margin-left: 10%;margin-right: 10%;">
                <h4>Please Fill In the Form to continue</h4>
                <br>
                        <form id="registerformmain" method="post" >
                                <div class="form-group">
                                         <input type="text" class="form-control" name="name" id="name1" placeholder="Name">
                                </div>
                                <div class="form-group">
                                         <input type="text" class="form-control" name="username" id="username1" placeholder="Email id">
                                </div>
                                <div class="form-group">
                                        <input type="password" class="form-control" name="password" id="password1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                        <input type="text" class="form-control" id="phoneno1" name="phoneno" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                        <button type="button" onclick="register()"  class="btn btn-danger">Register</button>
                                </div>
                        </form>
                </div>
        </div>
</div>
<div id="usercontentsform" style="display:none;">
	<input type="text" <?php if($log == "loggedin"){ ?> value="<?php echo $user; ?>" <?php } ?> id="username">
</div>
<div id="logoutform" style="display: none;">
    <form id="logoutformmain" method="post">
        <input type="text" name="logout" value="yes">
    </form>
</div>
<?php if($logout == "yes"){?>
<div id="logoutchecker" style="display:none;">yes</div>
<?php }else{ ?>
<div id="logoutchecker" style="display:none;">no</div>
<?php } ?>
<div id="lng" style="display: none;"><?php echo $lng; ?></div>
<div id="lat" style="display: none;"><?php echo $lat; ?></div>
<div id="footer">
<! this represents example for retrieving data from controller ie year!>
<p style="text-align:center;"><font size="4" color="white">Copyright &copy Newintown.in </font></p>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#loginformmain').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Email is required and can\'t be empty'
                    },        
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    }
                }
            }
        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#registerformmain').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The Name is required and can\'t be empty'
                    }
                }
            },
            phoneno:{
                validators: {
                    notEmpty: {
                        message: 'Phone no is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 10,
                        max: 10,
                        message: 'The phone number should consist of 10 digits'
                    },
                    digits: {
                        message: 'Phone number should consists of digits only'
                    }
                }
            },
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Email is required and can\'t be empty'
                    },        
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    }
                }
            }
        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#sitevisitformmain').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The Name is required and can\'t be empty'
                    }
                }
            },
            phoneno:{
                validators: {
                    notEmpty: {
                        message: 'Phone no is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 10,
                        max: 10,
                        message: 'The phone number should consist of 10 digits'
                    },
                    digits: {
                        message: 'Phone number should consists of digits only'
                    }
                }
            },
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Email is required and can\'t be empty'
                    },        
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            }
        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#listformmain').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required and can\'t be empty'
                    },        
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'The username can only consist of only alphabets'
                    }
                }
            },
            phoneno:{
                validators: {
                    notEmpty: {
                        message: 'Phone no is required and can\'t be empty'
                    },
                    stringLength: {
                        min: 10,
                        max: 10,
                        message: 'The phone number should consist of 10 digits'
                    },
                    digits: {
                        message: 'Phone number should consists of digits only'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                }
            }
        }
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#loginformshort').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            username: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and can\'t be empty'
                    },        
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    }
                }
            }
        }
    });
});
</script>
</body>
</html>