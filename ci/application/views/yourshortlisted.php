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
<div id="header" style="height:65px;">
<img src="../../static/images/newintown_in.png" height="55px" width="400px">
</div>
<div id="container2">
<div id="content1">
<div id="div2" style="display:none;">
<img style="display:block;margin-left:auto;margin-right:auto;height:150px;width:150px;margin-top:15%;" src="../../static/images/loader.gif">
</div>
<div id="div1">
<?php for($i=0;$i<count($locations);$i++){?>
    <div id="<?php echo $locations[$i]->pid; ?>" style="float:left;" onclick="initdelay(this.id)"><img src="<?php echo $locations[$i]->image_1; ?>" height="100px" width="100px">
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
                <font size="2" color="#3C763D" style="font-weight: bold;">Smoking-Drinking : Allowed</font>
        <?php }else{?>
                <font size="2" color="grey">Smoking-Drinking : Not Allowed</font>
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
        <?php if($locations[$i]->security == "y"){ ?>
                <font size="2" color="#3C763D" style="font-weight: bold;">Security</font>
        <?php }else{?>
                <font size="2" color="grey">Security</font>
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
        <br>
        <br>
        <div style="width:48%;float:left;margin-left:1%;">
        <div style="height:50%;">
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
        <div style="height:50%;">
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
        $("<?php echo "#" . $locations[$i]->pid; ?>").click(function() {
                $("<?php echo "#" . $locations[$i]->pid . "_toggler"; ?>").toggle("slow", function(){
                        //Animation complete
                });
        });
    </script>

<?php } ?>
<?php for($i=0;$i<count($locations1);$i++){?>
    <div id="<?php echo $locations1[$i]->pid; ?>" style="float:left;" onclick="initdelay(this.id)"><img src="<?php echo $locations1[$i]->image_1; ?>" height="100px" width="100px">
    </div>
    <div class="container2" style="float:left;clear:left;display:none;" id="<?php echo $locations1[$i]->pid ."_toggler";?>">
        <div id="<?php echo $locations1[$i]->pid . "hider"; ?>">
  <div style="float:right;width:44.19%;height:70%;background:black;">
  <font size="5" color="#11A7F6" style="margin-top:2%;">
  <?php echo $locations[$i]->bhk_type . "BHK FLAT";?> 
  </font>
  <div style="float:right;">
  <img src="../../static/images/close.png" style="float:right;" onclick="closecurrentdiv('<?php echo $locations1[$i]->pid; ?>')">
  </div>
  <button type="button" id="<?php echo $locations1[$i]->pid . "hide";?>" class="btn btn-lg btn-danger" data-container="body" style="float:right;" onclick="hide('<?php echo $locations1[$i]->pid;?>')") >Map View</button>
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
  <font size="2" color="#3C763D" style="font-weight:bold;">AC: <?php echo $locations[$i]->ac;?></font>
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
    if($locations[$i]->$imageno != ""){?>
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
  $("<?php echo "#" . $locations1[$i]->pid; ?>").click(function() {
    $("<?php echo "#" . $locations1[$i]->pid . "_toggler"; ?>").toggle("slow", function(){
      //Animation complete
    });
  });
    </script>
<?php }?>
</div>
</div>
</div>
<div id="footer">
<! this represents example for retrieving data from controller ie year!>
<p style="text-align:center;"><font size="4" color="white">Copyright &copy Newintown.in </font></p>
</div>
<script>
function ajaxhider(){
    $('#div2').hide();
}
window.onload = ajaxhider();
</script>
</body>
</html>