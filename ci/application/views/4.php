<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../static/css/slider.css">
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
function test1(){
	$(".container2").toggle("fast", function(){
		//Animation complete
	});
}
function removeshort1(ids){
	var classn = ids + "shorter";
	var elements = document.getElementsByClassName(classn);
	for(i=0;i<elements.length;i++){
		elements[i].innerHTML = "Working...";
	}
	$.ajax({
		type: "POST",
		url: "removeshort1",
		data: {pid: ids}
	})
		.done(function(){
			var elements = document.getElementsByClassName(classn);
			for(i=0;i<elements.length;i++){
			elements[i].innerHTML = "Shortlist";
			}
			var j = "#" + ids + "he";
        	$(j).hide();
        	removelinkspg(ids); 
		});
}
function addshort1(ids){
	var classn = ids + "shorter";
	var elements = document.getElementsByClassName(classn);
	for(i=0;i<elements.length;i++){
		elements[i].innerHTML = "Working...";
	}
	$.ajax({
		type: "POST",
		url: "addshort",
		data: {pid: ids}
	})
		.done(function(value){
			if(value == "success"){
				var elements = document.getElementsByClassName(classn);
				for(i=0;i<elements.length;i++){
					elements[i].innerHTML = "Remove Shortlist";
				}
				makelinkspg(ids);
			}
			else{
				alert("You Can Shortlist max 6 Properties");
				var elements = document.getElementsByClassName(classn);
				for(i=0;i<elements.length;i++){
					elements[i].innerHTML = "Shortlist";
				}
			}
		});
}				
function fun(ids){
	var classn = ids + "shorter";
	var elements = document.getElementsByClassName(classn);
	var f = elements[0].innerHTML;
	if(f == "Remove Shortlist"){
		removeshort1(ids);
		var star = ids + "star";
		document.getElementById(star).className = "glyphicon glyphicon-star-empty"; 
	}
	else{
		addshort1(ids);
		var star = ids + "star";
		document.getElementById(star).className = "glyphicon glyphicon-star";
	}
}
function closedialog(ids){
	var formname = "#" + ids + "form";
	$(formname).dialog('close');
}
function addshort(ids){
	var user = ids + "username";
	var username = document.getElementById(user).value;
	$.ajax({
		type: "POST",
		url: "addshort",
		data: {username: username,pid: ids}
	})
		.done(function(value){
			if(value == "success"){
				alert("Shortlisted");
				var f = ids + "formmain";
				document.getElementById(f).submit();
			}
			else{
				alert("You Can Shortlist max 6 Properties");
			}
		});
}
function loginuser(ids){
	var formname = "#" + ids + "form";
	$(formname).dialog('close');
	addshort(ids);
//	var f = ids + "formmain";
//	document.getElementById(f).submit();
}
function checkuser(ids){
	var user = ids + "username";
	var pass = ids + "password";
	var username = document.getElementById(user).value;
	var password = document.getElementById(pass).value;
	$.ajax({
		type: "POST",
		url: "checkuser",
		data: {username: username,password: password}
	})
		.done(function(value){
		if(value == "success"){
			loginuser(ids);
		}
		else{
			alert("wrong username/password");
		}
		});
}
function fun3(ids){
	var formname = "#" + ids + "form";
	$(formname).dialog('close');
	var formname1 = ids + "formmain";
	$.ajax({
		type: "POST",
		url: "six",
		data: {name: "akhilbatra", password: "akhil" }
	})
		.done(function(value){
		alert(value);
		});	
//	document.getElementById(formname1).submit();
	
}
</script>
<script>
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
function closecurrentdiv(ids){
	//alert("hello");
	document.getElementById(ids).click();
}
</script>
</head>
<body>
<?php for($i=0;$i<count($locations);$i++){?>
    <div style="float:left;margin-top: 15px;">
	<div class="house">
		<img src="../../static/images/home.png" alt="Smiley face" width="30" height="32" style="margin-top:-2px;/* top: 100px; */">
  		&nbsp;&nbsp;&nbsp;Rs.<?php echo $locations[$i]->rent; ?>
  		<span <?php if($locations[$i]->short == "no"){?> class="glyphicon glyphicon-star-empty" <?php }else{ ?>class="glyphicon glyphicon-star" <?php } ?> font-size="6" style="float:right;padding-left: 10px;padding-right: 10px;cursor:pointer;font-size:150%;" onclick="fun('<?php echo $locations[$i]->pid; ?>')" id="<?php echo $locations[$i]->pid . "star" ;?>"></span>
		<span style="float: right;background: #47a447;padding-left: 10px;padding-right: 10px;border-radius: 4px;"> <?php echo $locations[$i]->seeking_a; ?> </span>
	</div>
	<img src="<?php echo $locations[$i]->image_1; ?>" style='margin-left:15px;margin-top:44px;cursor:pointer;' height="200px" width="320px" id="<?php echo $locations[$i]->pid; ?>" onclick="initdelay('<?php echo $locations[$i]->pid; ?>')">
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
	<button type="button" id="<?php echo $locations[$i]->pid . "hide";?>" class="btn btn-lg btn-danger" data-container="body" style="float:right;margin-right:2px;" onclick="hide('<?php echo $locations[$i]->pid;?>')") >Map View</button>
	<button type="button" onclick="fun('<?php echo $locations[$i]->pid; ?>')" class="btn btn-lg btn-danger <?php echo $locations[$i]->pid . "shorter"; ?>" data-container="body" style="float:right;" data-toggle="popover" title="Login" data-placement="bottom" ><?php if($locations[$i]->short == "no"){ ?>Shortlist<?php }else{ ?>Remove Shortlist<?php } ?></button>
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
        <button type="button" onclick="fun('<?php echo $locations[$i]->pid; ?>')" class="btn btn-lg btn-danger <?php echo $locations[$i]->pid . "shorter"; ?>" data-container="body" style="float:right;" data-toggle="popover" title="Login" data-placement="bottom" >
        <?php if($locations[$i]->short == "no"){ ?>Shortlist<?php }else{ ?>Remove Shortlist<?php } ?></button>
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
<?php }?>
<div id="testf">
<div id="userdetails" style="display:none;"><?php if($log == "loggedin"){ echo $user; }?></div>
</div>
</body>
</html>
