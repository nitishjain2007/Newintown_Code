<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../../static/css/slider.css">
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
    url: "removeshort2",
    data: {pid: ids}
  })
    .done(function(){
      var elements = document.getElementsByClassName(classn);
      for(i=0;i<elements.length;i++){
        elements[i].innerHTML = "Shortlist";
      }
      var j = "#" + ids + "he";
      $(j).hide(); 
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
    url: "addshortflat",
    data: {pid: ids}
  })
    .done(function(value){
      if(value == "success"){
        var elements = document.getElementsByClassName(classn);
        for(i=0;i<elements.length;i++){
          elements[i].innerHTML = "Remove Shortlist";
        }
        makelinks(ids);
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
  }
  else{
    addshort1(ids);
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
//  var f = ids + "formmain";
//  document.getElementById(f).submit();
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
//  document.getElementById(formname1).submit();
  
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
</script>
</head>
<body>
<?php for($i=0;$i<count($locations);$i++){?>
    <div id="<?php echo $locations[$i]->pid; ?>" style="float:left;" onclick="initdelay(this.id)"><img src="<?php echo $locations[$i]->image_1; ?>" height="100px" width="100px">
    </div>
    <div class="container2" style="float:left;clear:left;display:none;" id="<?php echo $locations[$i]->pid ."_toggler";?>">
        <div id="<?php echo $locations[$i]->pid . "hider"; ?>">
  <div style="float:right;width:44.19%;height:70%;background:black;">
  <font size="5" color="#11A7F6" style="margin-top:2%;">
  <?php echo $locations[$i]->bhk_type . "BHK FLAT";?> 
  </font>
  <button type="button" id="<?php echo $locations[$i]->pid . "hide";?>" class="btn btn-lg btn-danger" data-container="body" style="float:right;" onclick="hide('<?php echo $locations[$i]->pid;?>')") >Map View</button>
  <button type="button" onclick="fun('<?php echo $locations[$i]->pid; ?>')" class="btn btn-lg btn-danger <?php echo $locations[$i]->pid . "shorter"; ?>" data-container="body" style="float:right;" data-toggle="popover" title="Login" data-placement="bottom" ><?php if($locations[$i]->short == "no"){ ?>Shortlist<?php }else{ ?>Remove Shortlist<?php } ?></button>
  <br>
  <br>
  <font size="3" color="white">Nearest Landmark - <?php echo $locations[$i]->nearest_landmark; ?></font>
  <br>
  <font size="3" color="white"><?php echo $locations[$i]->house_type; ?> | Available for <?php echo $locations[$i]->seeking_a; ?></font>
  <br>
  <br>
  <font size="4" color="white">Rent : Rs <?php echo $locations[$i]->rent; ?> | Security Deposit : Rs <?php echo $locations[$i]->security_deposit; ?>
  </font>
  <br>
  <br>
  <font size="3" color="white"><?php echo $locations[$i]->furnishing_type; ?></font>
  <br>
  <font size="3" color="white">Available from : Immediate</font>
  <br>
  <br>
  <div class="contents1">
  <table>
  <tr>
  <td>
  <?php if(($locations[$i]->power_backup != "") || ($locations[$i]->power_backup != " ")){?>
  <font size="2" color="grey">Power-Backup</font>
  <?php }else{ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Power-Backup: <?php echo $locations[$i]->power_backup; ?>
  </font>
  <?php }?>
  </td>
  <td>
  <?php if($locations[$i]->cupboard == "y"){?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Cupboard</font>
  <?php }else{?>
  <font size="2" color="grey">Cupboard</font>
  <?php }?>
  </td>
  <td>
  <?php if($locations[$i]->Utensils == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Cot</font>
  <?php }else{ ?>
  <font size="2" color="grey">Cot</font>
  <?php }?>
  </td>
  </tr>
  <tr>
  <td>
  <?php if($locations[$i]->ac == "n" || $locations[$i]->ac == ""){ ?>
  <font size="2" color="grey">AC</font>
  <?php }else{ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">AC: <?php echo $locations[$i]->ac;?></font>
  <?php } ?>
  </td>
  <td>
  <?php if($locations[$i]->tv == "n" || $locations[$i]->tv == ""){ ?>
  <font size="2" color="grey">TV</font>
  <?php }else{ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">TV: <?php echo $locations[$i]->tv;?></font>
  <?php } ?>
  </td>
  <td>
  <?php if($locations[$i]->ro == "y"){?>
  <font size="2" color="#3C763D" style="font-weight:bold;">RO</font>
  <?php }else{ ?>
  <font size="2" color="grey">RO</font>
  <?php } ?>
  </td>
  </tr>
  <tr>
  <td>
  <font size="2" color="#3C763D" style="font-weight:bold;">Bathrooms: <?php echo $locations[$i]->bathrooms; ?></font>
  </td>
  <td>
  <?php if($locations[$i]->fridge == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Fridge</font>
  <?php }else{ ?>
  <font size="2" color="grey">Fridge</font>
  <?php } ?>
  </td>
  <td>
  <?php if($locations[$i]->geyser == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Geyser</font>
  <?php }else{ ?>
  <font size="2" color="grey">Geyser</font>
  <?php } ?>
  </td>
  </tr>
  <tr>
  <td>
  <?php if($locations[$i]->gas_stove == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Gas Stove</font>
  <?php }else{ ?>
  <font size="2" color="grey">Gas Stove</font>
  <?php } ?>  
  </td>
  <td>
  <?php if($locations[$i]->washing_machine == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Washing Machine</font>
  <?php }else{ ?>
  <font size="2" color="grey">Washing Machine</font>
  <?php } ?>
  </td>
  <td>
  <?php if($locations[$i]->mattress == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Mattress</font>
  <?php }else{ ?>
  <font size="2" color="grey">Mattress</font>
  <?php } ?>
  </td>
  </tr>
  <tr>
  <td>
  <?php if($locations[$i]->microwave == "y"){ ?>
  <font size="2" color="#3C763D" style="font-weight:bold;">Microwave</font>
  <?php }else{ ?>
  <font size="2" color="grey">Microwave</font>
  <?php } ?>
  </td>
  <td>
  <?php if($locations[$i]->sofa == "y"){ ?>
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
  <ul class="image_slide" id="<?php echo $locations[$i]->pid . "_slider" ; ?>">
  <?php for($j=1;$j<=14;$j++){
    $imageno = "image_" . $j;
    if($locations[$i]->$imageno != ""){?>
      <li style="width: 546px;"><img src="<?php echo $locations[$i]->$imageno ;?>"></li>
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
  <div class="container" id="<?php echo $locations[$i]->pid . "form" ;?>" title="Shortlist A Property">
  <div class="row">
    <div id="<?php echo $locations[$i]->pid . "formdiv" ;?>" style="margin-left: 10%;margin-right: 10%;">
    <h4>Please Login to Continue</h4>
    <br>
      <form id="<?php echo $locations[$i]->pid . "formmain" ;?>" method="post" >
        <div class="form-group">
           <input type="text" class="form-control" name="username" id="<?php echo $locations[$i]->pid . "username" ;?>" placeholder="Username">
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" id="<?php echo $locations[$i]->pid . "password"; ?>" placeholder="Password">
        </div>
        <div class="form-group">
           <button type="button" onclick="checkuser('<?php echo $locations[$i]->pid;?>')" class="btn btn-primary">Login</button>
          <button type="button" class="btn btn-danger registerform" onclick="closedialog('<?php echo $locations[$i]->pid; ?>')">Create an Account</button>
        </div>
      </form>
    </div>
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
  <font size="6">
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
  <font size="6">
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
  <font size="6">
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
  <font size="6">
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