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
</script> 
</head>
<body>
<?php for($i=0;$i<count($locations);$i++){?>
	<div id="<?php echo $locations[$i]->pid; ?>" onclick="initdelay(this.id)"><img src ="<?php echo $locations[$i]->image_1 ?>" height="100px" width="100px">
	</div>
	<div class="container2" id="<?php echo $locations[$i]->pid . "_toggler";?>">
	<div style="float:right;width:44.19%;height:70%;background:black;">
	<font size="6" color="#11A7F6">
	<?php echo $locations[$i]->seeking_a; ?> PG
	</font>
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
		<h5 size="2" color="grey">WiFi</h5>
	<?php } ?>
	</td>
	<td>
	<?php if($locations[$i]->parking == "y"){ ?>
		<font size="2" color="#3C763D" style="font-weight: bold;">Parking</font>
	<?php }else{?>
		<font size="2" color="grey">Parking</font>
	<?php } ?>
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
	<script>
	$("<?php echo "#" . $locations[$i]->pid; ?>").click(function() {
    	$("<?php echo "#" . $locations[$i]->pid . "_toggler"; ?>").toggle("slow", function(){
		//Animation complete
		});
    });
    </script>
<?php }?>
<div id="testf" style="display: none;"></div>
</body>
</html>