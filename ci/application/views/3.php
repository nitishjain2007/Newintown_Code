<!DOCTYPE html>
<html>
<head>
<script>
$("#toggler").click(function() {
      $("#testd").toggle( "slow", function() {
        // Animation complete.
      });
    });
function test1(){
	$(".container2").toggle("fast", function(){
		//Animation complete
	});
}
</script>
<link rel="stylesheet" type="text/css" href="../../static/css/slider.css">
</head>
<body>
<div id="toggler" onclick="initdelay(this.id)"><img src="<?php echo $locations[0]->image_1;?>" height="100px" width="100px"></div>
<div class="container2" id="testd">
<div style="float:right;width:44.19%;height:72.5%;background:black;border: 2px solid white;">
<font style="float: left;color: white;margin-left:2px;">text goes here</font>
</div>
<div class="wrapper">
<div class="slide_wrapper">
<ul class="image_slide" id="toggler_slider">
<li style="width: 700px;"><img src="../../static/images/image1.jpeg"></li>
<li style="width: 700px;"><img src="../../static/images/image2.jpeg"></li>
<li style="width: 700px;"><img src="../../static/images/image3.jpeg"></li>
<li style="width: 700px;"><img src="../../static/images/image4.jpeg"></li>
<li style="width: 700px;"><img src="../../static/images/image5.jpeg"></li>
<li style="width: 700px;"><img src="../../static/images/image6.jpeg"></li>
<li style="width: 700px;"><img src="../../static/images/image7.jpeg"></li>
<li style="width: 700px;"><img src="../../static/images/image8.jpeg"></li>
<li style="width: 700px;"><img src="../../static/images/image9.jpeg"></li>
<li></li>
</ul>
<span class="nvgt" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/prev.png') no-repeat center;left: 0px;" onclick="onClickPrev()"></span>
<span class="nvgt" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/next.png') no-repeat center;right: 0px;" onclick="onClickNext()"></span>
</div>
</div>
<div class="slide_wrapper1">
<ul id="toggler_pager" class="pager1">
<table>
<tr>
<td>
<li style="width:140px;"><img src="../../static/images/image1.jpeg" onclick="slideTo(0)"></li>
</td>
<td>
<li style="width:140px;"><img src="../../static/images/image2.jpeg" onclick="slideTo(1)"></li>
</td>
<td>
<li style="width:140px;"><img src="../../static/images/image3.jpeg" onclick="slideTo(2)"></li>
</td>
<td>
<li style="width:140px;"><img src="../../static/images/image4.jpeg" onclick="slideTo(3)" ></li>
</td>
<td>
<li style="width:140px;"><img src="../../static/images/image5.jpeg" onclick="slideTo(4)" ></li>
</td>
<td>
<li style="width:140px;"><img src="../../static/images/image6.jpeg" onclick="slideTo(5)" ></li>
</td>
<td>
<li style="width:140px;"><img src="../../static/images/image7.jpeg" onclick="slideTo(6)" ></li>
</td>
<td>
<li style="width:140px;"><img src="../../static/images/image8.jpeg" onclick="slideTo(7)" ></li>
</td>
<td>
<li style="width:140px;"><img src="../../static/images/image9.jpeg" onclick="slideTo(8)" ></li>
</td>
</tr>
</table>
</ul>
<span class="nvgt1" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/prev.png') no-repeat center; left:0px;" onclick="onClickPrev1()"></span>
<span class="nvgt1" style="background: #000 url('https://dl.dropboxusercontent.com/u/65639888/image/next.png') no-repeat center; right:0px;" onclick="onClickNext1()"></span>
</div>
</div>
<div id="toggler"><img src="../../static/images/image2.jpeg" height="100px" width="100px"></div>
</body>
</html>
