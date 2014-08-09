<!DOCTYPE html>
<html>
<head>
<link href="../../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../../bootstrapvalidator/dist/css/bootstrapValidator.css" rel="stylesheet">
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
<script src="../../static/js/slider.js"></script>
<script src="../../static/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="../../static/css/datepicker.css">
<link rel="stylesheet" href="../../static/css/mainpage.css">
<link rel="stylesheet" type="text/css" href="../../static/css/slider.css">
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

<style>
.house{
/* background-position: 102px 0; */
/* width: 30px; */
/* height: 29px; */
/* display: inline-block; */
/* margin-top: -2px; */
/* margin-right: 5px; */
/* float: left; */
position: absolute;
width: 320px;
margin-left: 15px;
padding: 7px;
background: #00688B;
height: 44px;
color: white;
}
.glyphicon-star{
    color:yellow;
}
</style>

<script>
$(function() {
$('.datepicker').datepicker();
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
</script>
<script>
function logout(){
        $.ajax({
                type: "POST",
                url: "logout",
        })
                .done(function(){
        		window.location="http://newintown.in/ci/index.php/controller1/main";	
                });
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
function hide(ids){
        h = "#" + ids + "hider";
        $(h).hide();
        g = h + "map";
        $(g).show();
        initialize2(ids);
}
function show(ids){
        h = "#" + ids + "hider";
        g = h + "map";
        $(g).hide();
        $(h).show();
}
function removeshort(ids){
	var hider1 = '#' + ids + "tog";
	var hider2 = '#' + ids + '_toggler';
        $.ajax({
                type: "POST",
                url: "removeshort1",
                data: {pid: ids}
        })
                .done(function(){
			$(hider1).hide();
			$(hider2).hide();
            removelinkspg(ids);
			window["currentview"] = "";
		});
}
function removeshortflat(ids){
    var hider1 = '#' + ids + "tog";
    var hider2 = '#' + ids + '_toggler';
        $.ajax({
            type: "POST",
            url:"removeshort2",
            data: {pid: ids} 
        })
            .done(function(){
                $(hider1).hide();
                $(hider2).hide();
                removelinksflat(ids);
                window["currentview"] = "";
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
                        if(values[i]!="false"){
                            makelinksflat(values[i]);
                        }
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
                alert("hello");
                document.getElementById(window["choosen"]).click();
            }
            else{
                window.location = "http://localhost/ci/index.php/controller1/viewshortlist";
            }
    });
}
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
function removelinkspg(value){
    var id = value + "he";
    var li = document.getElementById(id);
    var parent = document.getElementById("shortlistedproppg");
    parent.removeChild(li);
}
function removelinksflat(value){
    var id = value + "he";
    var li = document.getElementById(id);
    var parent = document.getElementById("shortlistedpropflat");
    parent.removeChild(li);
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

        $( "#sitevisitpopup" )
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
function closecurrentdiv(ids){
    //alert("hello");
    document.getElementById(ids).click();
}
</script>
</head>
<body>
<div id="header" style="height:65px;">
<img src="../../static/images/newintown_in.png" height="55px" width="400px">
<?php if($log == "loggedin"){?>
<button type="button" id="user" class="btn btn-lg btn-info" data-container="body" data-toggle="popover" title="username" data-placement="bottom" style="margin-top:0.8%;" >
  Welcome <?php echo " ";
                echo $user;
            ?>
</button>
<?php }?>
<div id="logindiv" style="float: right;">
<font color="white">
<button type="button" id="logoutpopup" class="btn btn-lg btn-danger" data-container="body" data-toggle="popover" title="Logout" data-placement="bottom" style = "border-radius: 0px;height:65px;width:100px;display:none;" onclick="logout()" >
  Logout 
</button>
</font>
</div>
</div>
<div id="container2">
<div id="content1" style="width:82%;float:left;">
<div id="div2" style="display:none;">
<img style="display:block;margin-left:auto;margin-right:auto;height:150px;width:150px;margin-top:15%;" src="../../static/images/loader.gif">
</div>
<div id="div1">
<?php for($i=0;$i<count($locations);$i++){?>
    <div style="float:left;margin-top: 15px;" id="<?php echo $locations[$i]->pid . "tog"; ?>" onclick="initdelay('<?php echo $locations[$i]->pid; ?>')">
    <div class="house">
        <img src="../../static/images/home.png" alt="Smiley face" width="30" height="32" style="margin-top:-2px;/* top: 100px; */">
        &nbsp;&nbsp;&nbsp;Rs.<?php echo $locations[$i]->rent; ?>
        <span class="glyphicon glyphicon-star" font-size="6" style="float:right;padding-left: 10px;padding-right: 10px;cursor:pointer;font-size:150%;" onclick="removeshort('<?php echo $locations[$i]->pid; ?>')" id="<?php echo $locations[$i]->pid . "star" ;?>"></span>
        <span style="float: right;background: #47a447;padding-left: 10px;padding-right: 10px;border-radius: 4px;"> <?php echo $locations[$i]->seeking_a; ?> </span>
    </div>
    <img src="<?php echo $locations[$i]->image_1; ?>" style='margin-left:15px;margin-top:40px;cursor:pointer;' height="200px" width="320px" id="<?php echo $locations[$i]->pid; ?>">
    <div style="margin-left: 15px;padding: 4px;width: 320px;background: white;border: 1px solid rgb(214, 210, 210);font-size: 12px;"> 
      Sharing: <span style="color: green;"> <?php echo ucfirst($locations[$i]->sharing_type); ?> Sharing</span>
     <br>
      Location :<?php echo $locations[$i]->area; ?> 
    </div>
    </div>
    <div class="container2" style="float:left;clear:left;display:none;" id="<?php echo $locations[$i]->pid ."_toggler";?>">
        <div id="<?php echo $locations[$i]->pid . "hider"; ?>">
        <div style="float:right;width:44.19%;height:70%;background:black;">
        <font size="6" color="#11A7F6">
        <?php echo $locations[$i]->seeking_a; ?> PG
        </font>
        <div style="float:right;">
        <img src="../../static/images/close.png" style="float:right;" onclick="closecurrentdiv('<?php echo $locations[$i]->pid; ?>')">
        </div>
        <button type="button" id="<?php echo $locations[$i]->pid . "hide";?>" class="btn btn-lg btn-danger" data-container="body" style="float:right;" onclick="hide('<?php echo $locations[$i]->pid;?>')") >Map View</button>
        <button type="button" class="btn btn-lg btn-danger" data-container="body" style="float:right;" onclick="removeshort('<?php echo $locations[$i]->pid;?>')") >Remove Shortlist</button>
        <br>
        <br>
        <font size="3" color="white">Nearest Landmark - <?php echo $locations[$i]->nearest_landmark; ?></font>
    <br>
    <font size="3" color="white"><?php echo ucwords($locations[$i]->sharing_type); ?> Sharing | Attached Bathroom | <?php if($locations[$i]->ac == "y"){ echo "AC";}elseif($locations[$i]->ac == "cooler"){ echo "Cooler";}?></font>
    <br>
    <br>
    <font size="4" color="white">Rent : Rs <?php echo $locations[$i]->rent; ?> | Security Deposit : Rs <?php echo $locations[$i]->security_deposit; ?>
    </font>
    <br>
    <br>
    <font size="3" color="white">Meals : <?php echo $locations[$i]->food; ?></font>
    <br>
    <font size="3" color="white">Electricity : <?php echo $locations[$i]->electricity; ?></font>
    <br>
    <br>
    <div class="contents1">
    <table>
    <tr>
    <td>
    <font size="2" color="#3C763D" style="font-weight: bold;">Power-Backup:
    <?php echo $locations[$i]->power_backup; ?>
    </font>
    </td>
    <td>
    <?php if($locations[$i]->wifi == "y"){ ?>
        <font size="2" color="#3C763D" style="font-weight: bold;">WiFi</font>
    <?php }else{?>
        <font size="2" color="grey">WiFi</font>
    <?php } ?>
    </td>
    <td>
    <?php if($locations[$i]->parking == "y"){ ?>
        <font size="2" color="#3C763D" style="font-weight: bold;">Parking</font>
    <?php }else{?>
        <font size="2" color="grey">Parking</font>
    <?php } ?>
    </td>
    </tr>
    <tr>
    <td>
    <?php if($locations[$i]->gas_stove == "y"){ ?>
        <font size="2" color="#3C763D" style="font-weight: bold;">Gas Stove</font>
    <?php }else{?>
        <font size="2" color="grey">Gas Stove</font>
    <?php } ?>
    </td>
    <td>
    <?php if($locations[$i]->fridge == "y"){ ?>
        <font size="2" color="#3C763D" style="font-weight: bold;">Fridge</font>
    <?php }else{?>
        <font size="2" color="grey">Fridge</font>
    <?php } ?>
    </td>
    <td>
    <?php if($locations[$i]->smoking == "y"){ ?>
        <font size="2" color="#3C763D" style="font-weight: bold;">Smoking : Allowed</font>
    <?php }else{?>
        <font size="2" color="grey">Smoking : Not Allowed</font>
    <?php } ?>
    </td>
    </tr>
    <tr>
    <td>
    <?php if($locations[$i]->geyser == "y"){ ?>
        <font size="2" color="#3C763D" style="font-weight: bold;">Geyser</font>
    <?php }else{?>
        <font size="2" color="grey">Geyser</font>
    <?php } ?>
    </td>
    <td>
    <?php if($locations[$i]->washing_machine == "y"){ ?>
        <font size="2" color="#3C763D" style="font-weight: bold;">Washing Machine</font>
    <?php }else{?>
        <font size="2" color="grey">Washing Machine</font>
    <?php } ?>
    </td>
    <td>
    <?php if($locations[$i]->drinking == "y"){ ?>
        <font size="2" color="#3C763D" style="font-weight: bold;">Drinking : Allowed</font>
    <?php }else{?>
        <font size="2" color="grey">Drinking : Not Allowed</font>
    <?php } ?>
    </td>
    </tr>
    <tr>
    <td>
        <font size="2" color="#3C763D" style="font-weight: bold;">Bathroom : Common</font>
    </td>
    <td>
    <?php if($locations[$i]->ac == "y"){ ?>
        <font size="2" color="#3C763D" style="font-weight: bold;">AC</font>
    <?php }else{?>
        <font size="2" color="grey">AC</font>
    <?php } ?>
    </td>
    <td>
    <?php if($locations[$i]->security == "y"){ ?>
        <font size="2" color="#3C763D" style="font-weight: bold;">Security</font>
    <?php }else{?>
        <font size="2" color="grey">Security</font>
    <?php } ?>
    </td>
    </tr>
    <tr>
    <td>
    <?php if($locations[$i]->cupboard == "y"){ ?>
        <font size="2" color="#3C763D" style="font-weight: bold;">Cupboard</font>
    <?php }else{?>
        <font size="2" color="grey">Cupboard</font>
    <?php } ?>
    </td>
    <td>
        <font size="2" color="#3C763D" style="font-weight: bold;">Food-Habits : <?php echo $locations[$i]->foodhabits; ?></font>
    </td>
    </tr>
    </table>
    </div>
    </div>
    <div class="wrapper">
    <div class="slide_wrapper">
    <ul class="image_slide" id="<?php echo $locations[$i]->pid . "_slider" ; ?>">
    <?php for($j=1;$j<=14;$j++){
        $imageno = "image_" . $j;
        if($locations[$i]->$imageno != ""){?>
            <li style="width: 700px;"><img src="<?php echo $locations[$i]->$imageno ;?>"></li>
        <?php }
    }?>
        <li></li>
    </ul>
    <span class="nvgt" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/prev.png') no-repeat center;left: 0px;" onclick="onClickPrev()"></span>
    <span class="nvgt" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/next.png') no-repeat center;right: 0px;" onclick="onClickNext()"></span>
    </div>
    </div>
    <div class="slide_wrapper1">
    <ul id="<?php echo $locations[$i]->pid . "_pager"; ?>" class="pager1">
    <table>
    <tr>
    <?php for($j=1;$j<=14;$j++){
        $imageno = "image_" . $j;
        if($locations[$i]->$imageno != ""){?>
            <td>
            <li style="width:140px;"><img src="<?php echo $locations[$i]->$imageno;?>" onclick="slideTo(<?php echo $j-1;?>)"></li>
            </td>
        <?php }
    }?>
    </tr>
    </table>
    </ul>
    <span class="nvgt1" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/prev.png') no-repeat center; left:0px;" onclick="onClickPrev1()"></span>
    <span class="nvgt1" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/next.png') no-repeat center; right:0px;" onclick="onClickNext1()"></span>
    </div>
    </div>
    <div id="<?php echo $locations[$i]->pid . "hidermap";?>" style="display:none;">
    <input type="text" value="<?php echo $locations[$i]->lati; ?>" id="<?php echo $locations[$i]->pid . "latitude"; ?>" style="display:none;"/>
    <input type="text" value="<?php echo $locations[$i]->longi; ?>" id="<?php echo $locations[$i]->pid . "longitude"; ?>" style="display:none;"/>
    <div style="width:50%;height:550px;float:left;border:5px solid white;" id="<?php echo $locations[$i]->pid . "map";?>">
    </div>
    <button type="button" id="<?php echo $locations[$i]->pid . "hide";?>" class="btn btn-lg btn-danger" data-container="body" style="float:right;" onclick="show('<?php echo $locations[$i]->pid;?>')") >
    Grid View
    </button>
    <button type="button" class="btn btn-lg btn-danger" data-container="body" style="float:right;" onclick="removeshort('<?php echo $locations[$i]->pid;?>')") >Remove Shortlist</button>
    <br>
    <br>
    <div style="width:48%;float:left;margin-left:1%;">
    <div style="height:50%;float:left;">
    <div style="width:49%;float:left;">
    <font color="white">
    <font size="4" style="font-weight:bold;">
    Nearest Markets
    </font>
    <table class="<?php echo $locations[$i]->pid . "table";?>" id="<?php echo "shoppingview" . $locations[$i]->pid;?>">
    <tr>
    <td style="font-weight:bold;">
    Place
    </td>
    <td style="font-weight:bold;">
    Distance
    </td>
    </tr>
    </table>
    </font>
    </div>
    <div style="width:50%;float:left;margin-left:1%;">
    <font color="white">
    <font size="4" style="font-weight:bold;">
    Nearest ATM's
    </font>
    <table class="<?php echo $locations[$i]->pid . "table";?>" id="<?php echo "atmview" . $locations[$i]->pid;?>">
        <tr>
        <td style="font-weight:bold;">
    Place
    </td>
    <td style="font-weight:bold;">
    Distance
    </td>
    </tr>
    </table>
    </font>
    </div>
    </div>
    <div style="height:50%;float:left;">
    <div style="width:49%;float:left;">
    <font color="white">
    <font size="4" style="font-weight:bold;">
    Nearest Metro's
    </font>
    <table class="<?php echo $locations[$i]->pid . "table";?>" id="<?php echo "metroview" . $locations[$i]->pid;?>">
    <tr>
    <td style="font-weight:bold;">
    Place
    </td>
    <td style="font-weight:bold;">
    Distance
    </td>
    </tr>
    </table>
    </font>
    </div>
    <div style="width:50%;float:left;margin-left:1%;">
    <font color="white">
    <font size="4" style="font-weight:bold;">
    Nearest Restaurants
    </font>
    <table class="<?php echo $locations[$i]->pid . "table";?>" id="<?php echo "restaurantview" . $locations[$i]->pid;?>">
    <tr>
    <td style="font-weight:bold;">
    Place
    </td>
    <td style="font-weight:bold;">
    Distance
    </td>
    </tr>
    </table>
    </font>
    </div>
    </div>
    </div>
    </div>
    </div>
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
    $( "<?php echo "#" . $locations[$i]->pid . "form";?>").dialog({
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

        $( "<?php echo "#" . $locations[$i]->pid . "popup" ;?>")
        .button()
        .click(function() {
            $( "<?php echo "#" . $locations[$i]->pid . "form" ;?>" ).dialog( "open" );
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
        $( "<?php echo "#" . $locations[$i]->pid . "form";?>").dialog({
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

        $( "<?php echo "#" . $locations[$i]->pid . "popupd" ;?>")
                .button()
                .click(function() {
                        $( "<?php echo "#" . $locations[$i]->pid . "form" ;?>" ).dialog( "open" );
                });
    });
    </script>
    <script>
    $("<?php echo "#" . $locations[$i]->pid; ?>").click(function() {
        $("<?php echo "#" . $locations[$i]->pid . "_toggler"; ?>").toggle("slow", function(){
            //Animation complete
        });
    });
    </script>

<?php } ?>
<?php for($i=0;$i<count($locations1);$i++){?>
    <div style="float:left;margin-top: 15px;" id="<?php echo $locations1[$i]->pid . "tog"; ?>" onclick="initdelay('<?php echo $locations1[$i]->pid; ?>')">
    <div class="house">
                <img src="../../static/images/home.png" alt="Smiley face" width="30" height="32" style="margin-top:-2px;/* top: 100px; */">
                &nbsp;&nbsp;&nbsp;Rs.<?php echo $locations1[$i]->rent; ?>
                <span class="glyphicon glyphicon-star" font-size="6" style="float:right;padding-left: 10px;padding-right: 10px;cursor:pointer;font-size:150%;" onclick="removeshortflat('<?php echo $locations1[$i]->pid; ?>')" id="<?php echo $locations1[$i]->pid . "star" ;?>"></span>
                <span style="float: right;background: #47a447;padding-left: 10px;padding-right: 10px;border-radius: 4px;"> <?php echo $locations1[$i]->bhk_type; ?>BHK </span>
        </div>
    <img src="<?php echo $locations1[$i]->image_1; ?>" id="<?php echo $locations1[$i]->pid; ?>" style='margin-left:15px;margin-top:40px;cursor:pointer;' height="200px" width="320px">
    <div style="margin-left: 15px;padding: 4px;width: 320px;background: white;border: 1px solid rgb(214, 210, 210);font-size: 12px;">
          Furnishing: <span style="color: green;"> <?php echo $locations1[$i]->furnishing_type; ?> </span>
         <br>
          Location :<?php echo $locations1[$i]->area; ?>
        </div>
    </div>
    <div class="container2" style="float:left;clear:left;display:none;" id="<?php echo $locations1[$i]->pid ."_toggler";?>">
        <div id="<?php echo $locations1[$i]->pid . "hider"; ?>">
  <div style="float:right;width:44.19%;height:70%;background:black;">
  <font size="5" color="#11A7F6" style="margin-top:2%;">
  <?php echo $locations1[$i]->bhk_type . "BHK FLAT";?> 
  </font>
  <div style="float:right;">
  <img src="../../static/images/close.png" style="float:right;" onclick="closecurrentdiv('<?php echo $locations1[$i]->pid; ?>')">
  </div>
  <button type="button" id="<?php echo $locations1[$i]->pid . "hide";?>" class="btn btn-lg btn-danger" data-container="body" style="float:right;" onclick="hide('<?php echo $locations1[$i]->pid;?>')") >Map View</button>
  <button type="button" class="btn btn-lg btn-danger" data-container="body" style="float:right;" onclick="removeshortflat('<?php echo $locations1[$i]->pid;?>')") >Remove Shortlist</button>
  <br>
  <br>
  <font size="3" color="white">Nearest Landmark - <?php echo $locations1[$i]->nearest_landmark; ?></font>
  <br>
  <font size="3" color="white"><?php echo $locations1[$i]->house_type; ?> | Available for <?php echo $locations1[$i]->seeking_a; ?></font>
  <br>
  <br>
  <font size="4" color="white">Rent : Rs <?php echo $locations1[$i]->rent; ?> | Security Deposit : Rs <?php echo $locations1[$i]->security_deposit; ?>
  </font>
  <br>
  <br>
  <font size="3" color="white"><?php echo $locations1[$i]->furnishing_type; ?></font>
  <br>
  <font size="3" color="white">Available from : Immediate</font>
  <br>
  <br>
  <div class="contents1">
  <table>
  <tr>
  <td>
  <?php if(($locations1[$i]->power_backup != "") || ($locations1[$i]->power_backup != " ")){?>
  <font size="2" color="grey">Power-Backup</font>
  <?php }else{ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Power-Backup: <?php echo $locations1[$i]->power_backup; ?>
  </font>
  <?php }?>
  </td>
  <td>
  <?php if($locations1[$i]->cupboard == "y"){?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Cupboard</font>
  <?php }else{?>
  <font size="2" color="grey">Cupboard</font>
  <?php }?>
  </td>
  <td>
  <?php if($locations1[$i]->Utensils == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Cot</font>
  <?php }else{ ?>
  <font size="2" color="grey">Cot</font>
  <?php }?>
  </td>
  </tr>
  <tr>
  <td>
  <?php if($locations1[$i]->ac == "n" || $locations1[$i]->ac == ""){ ?>
  <font size="2" color="grey">AC</font>
  <?php }else{ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">AC: <?php echo $locations1[$i]->ac;?></font>
  <?php } ?>
  </td>
  <td>
  <?php if($locations1[$i]->tv == "n" || $locations1[$i]->tv == ""){ ?>
  <font size="2" color="grey">TV</font>
  <?php }else{ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">TV: <?php echo $locations1[$i]->tv;?></font>
  <?php } ?>
  </td>
  <td>
  <?php if($locations1[$i]->ro == "y"){?>
  <font size="2" color="#3C763D" style="font-weight:bold;">RO</font>
  <?php }else{ ?>
  <font size="2" color="grey">RO</font>
  <?php } ?>
  </td>
  </tr>
  <tr>
  <td>
  <font size="2" color="#3C763D" style="font-weight:bold;">Bathrooms: <?php echo $locations1[$i]->bathrooms; ?></font>
  </td>
  <td>
  <?php if($locations1[$i]->fridge == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Fridge</font>
  <?php }else{ ?>
  <font size="2" color="grey">Fridge</font>
  <?php } ?>
  </td>
  <td>
  <?php if($locations1[$i]->geyser == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Geyser</font>
  <?php }else{ ?>
  <font size="2" color="grey">Geyser</font>
  <?php } ?>
  </td>
  </tr>
  <tr>
  <td>
  <?php if($locations1[$i]->gas_stove == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Gas Stove</font>
  <?php }else{ ?>
  <font size="2" color="grey">Gas Stove</font>
  <?php } ?>  
  </td>
  <td>
  <?php if($locations1[$i]->washing_machine == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Washing Machine</font>
  <?php }else{ ?>
  <font size="2" color="grey">Washing Machine</font>
  <?php } ?>
  </td>
  <td>
  <?php if($locations1[$i]->mattress == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Mattress</font>
  <?php }else{ ?>
  <font size="2" color="grey">Mattress</font>
  <?php } ?>
  </td>
  </tr>
  <tr>
  <td>
  <?php if($locations1[$i]->microwave == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Microwave</font>
  <?php }else{ ?>
  <font size="2" color="grey">Microwave</font>
  <?php } ?>
  </td>
  <td>
  <?php if($locations1[$i]->sofa == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Sofa</font>
  <?php }else{ ?>
  <font size="2" color="grey">Sofa</font>
  <?php } ?>
  </td>
  </tr>
  </table>
  </div>
  </div>
  <div class="wrapper">
  <div class="slide_wrapper">
  <ul class="image_slide" id="<?php echo $locations1[$i]->pid . "_slider" ; ?>">
  <?php for($j=1;$j<=14;$j++){
    $imageno = "image_" . $j;
    if($locations1[$i]->$imageno != ""){?>
      <li style="width: 700px;"><img src="<?php echo $locations1[$i]->$imageno ;?>"></li>
    <?php }
  }?>
      <li></li>
  </ul>
  <span class="nvgt" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/prev.png') no-repeat center;left: 0px;" onclick="onClickPrev()"></span>
  <span class="nvgt" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/next.png') no-repeat center;right: 0px;" onclick="onClickNext()"></span>
  </div>
  </div>
  <div class="slide_wrapper1">
  <ul id="<?php echo $locations1[$i]->pid . "_pager"; ?>" class="pager1">
  <table>
  <tr>
  <?php for($j=1;$j<=14;$j++){
    $imageno = "image_" . $j;
    if($locations1[$i]->$imageno != ""){?>
      <td>
      <li style="width:140px;"><img src="<?php echo $locations1[$i]->$imageno;?>" onclick="slideTo(<?php echo $j-1;?>)"></li>
      </td>
    <?php }
  }?>
  </tr>
  </table>
  </ul>
  <span class="nvgt1" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/prev.png') no-repeat center; left:0px;" onclick="onClickPrev1()"></span>
  <span class="nvgt1" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/next.png') no-repeat center; right:0px;" onclick="onClickNext1()"></span>
  </div>
  </div>
  <div id="<?php echo $locations1[$i]->pid . "hidermap";?>" style="display:none;">
  <input type="text" value="<?php echo $locations1[$i]->lati; ?>" id="<?php echo $locations1[$i]->pid . "latitude"; ?>" style="display:none;"/>
  <input type="text" value="<?php echo $locations1[$i]->longi; ?>" id="<?php echo $locations1[$i]->pid . "longitude"; ?>" style="display:none;"/>
  <div style="width:50%;height:550px;float:left;border:5px solid white;" id="<?php echo $locations1[$i]->pid . "map";?>">
  </div>
  <button type="button" id="<?php echo $locations1[$i]->pid . "hide";?>" class="btn btn-lg btn-danger" data-container="body" style="float:right;" onclick="show('<?php echo $locations1[$i]->pid;?>')") >
  Grid View
  </button>
  <button type="button" class="btn btn-lg btn-danger" data-container="body" style="float:right;" onclick="removeshortflat('<?php echo $locations1[$i]->pid;?>')") >Remove Shortlist</button>
  <br>
  <br>
  <div style="width:48%;float:left;margin-left:1%;">
  <div style="height:50%;float:left;">
  <div style="width:49%;float:left;">
  <font color="white">
  <font size="4" style="font-weight:bold;">
  Nearest Markets
  </font>
  <table class="<?php echo $locations1[$i]->pid . "table";?>" id="<?php echo "shoppingview" . $locations1[$i]->pid;?>">
  <tr>
  <td style="font-weight:bold;">
  Place
  </td>
  <td style="font-weight:bold;">
  Distance
  </td>
  </tr>
  </table>
  </font>
  </div>
  <div style="width:50%;float:left;margin-left:1%;">
  <font color="white">
  <font size="4" style="font-weight:bold;">
  Nearest ATM's
  </font>
  <table class="<?php echo $locations1[$i]->pid . "table";?>" id="<?php echo "atmview" . $locations1[$i]->pid;?>">
      <tr>
        <td style="font-weight:bold;">
  Place
  </td>
  <td style="font-weight:bold;">
  Distance
  </td>
  </tr>
  </table>
  </font>
  </div>
  </div>
  <div style="height:50%;float:left;">
  <div style="width:49%;float:left;">
  <font color="white">
  <font size="4" style="font-weight:bold;">
  Nearest Metro's
  </font>
  <table class="<?php echo $locations1[$i]->pid . "table";?>" id="<?php echo "metroview" . $locations1[$i]->pid;?>">
  <tr>
  <td style="font-weight:bold;">
  Place
  </td>
  <td style="font-weight:bold;">
  Distance
  </td>
  </tr>
  </table>
  </font>
  </div>
  <div style="width:50%;float:left;margin-left:1%;">
  <font color="white">
  <font size="4" style="font-weight:bold;">
  Nearest Restaurants
  </font>
  <table class="<?php echo $locations1[$i]->pid . "table";?>" id="<?php echo "restaurantview" . $locations1[$i]->pid;?>">
  <tr>
  <td style="font-weight:bold;">
  Place
  </td>
  <td style="font-weight:bold;">
  Distance
  </td>
  </tr>
  </table>
  </font>
  </div>
  </div>
  </div>
  </div>
    </div>
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
  $( "<?php echo "#" . $locations1[$i]->pid . "form";?>").dialog({
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

        $( "<?php echo "#" . $locations1[$i]->pid . "popup" ;?>")
    .button()
    .click(function() {
      $( "<?php echo "#" . $locations1[$i]->pid . "form" ;?>" ).dialog( "open" );
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
        $( "<?php echo "#" . $locations1[$i]->pid . "form";?>").dialog({
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

        $( "<?php echo "#" . $locations1[$i]->pid . "popupd" ;?>")
                .button()
                .click(function() {
                        $( "<?php echo "#" . $locations1[$i]->pid . "form" ;?>" ).dialog( "open" );
                });
    });
    </script>
    <script>
  $("<?php echo "#" . $locations1[$i]->pid; ?>").click(function() {
    $("<?php echo "#" . $locations1[$i]->pid . "_toggler"; ?>").toggle("slow", function(){
      //Animation complete
    });
  });
    </script>
<?php }?>
</div>
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
<div id="footer">
<! this represents example for retrieving data from controller ie year!>
<p style="text-align:center;"><font size="4" color="white">Copyright &copy Newintown.in </font></p>
</div>
        <div class="container" id="sitevisitf" title="Shortlist A Property">
        <div class="row">
                <div id="sitevisitdiv" style="margin-left: 10%;margin-right: 10%;">
                <h4>Please Fill In to Continue</h4>
                <br>
                        <form id="sitevisitform" method="post" >
                                <div class="form-group">
                                         <input type="text" class="form-control" name="username" placeholder="Name">
                                </div>
                                <div class="form-group">
                                        <input type="text" class="form-control" name="phoneno" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                        <input type="text" class="form-control datepicker" name="date" id="datepicker" placeholder="date">
                                </div>
                                <div class="form-group">
                                        <input type="text" class="form-control" name="password" placeholder="Email">
                                </div>
                                <div class="form-group">
                                         <button type="button" class="btn btn-primary">Login</button>
                                </div>
                        </form>
                </div>
        </div>
	</div>
<div class="container" id="loginform" title="Login">
    <div class="row">
        <div id="loginformdiv" style="margin-left: 10%;margin-right: 10%;">
        <form id="loginformmain" method="post" >
            <div class="form-group">
            <input type="text" class="form-control" name="username" id="username"placeholder="Email id" size="20"/>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary" onclick="requestsite()">Sign up</button>
            <button type="button" class="btn btn-danger registerform">Create an Account</button>
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
                $( "#sitevisitf" ).dialog({
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

                $( "#sitevisitpopup4" )
                        .button()
                        .click(function() {
                                $( "#sitevisitf" ).dialog( "open" );
                        });
        });
</script>
<script>
window.onload = function(){
    $('#div2').hide();
    $('#div1').show();
    getshortlistedpg();
    getshortlistedflat();
}
</script>
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
            }
        }
    });
});
</script>
</body>
</html>
