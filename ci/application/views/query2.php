<!DOCTYPE html>
<html>
<head>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("button").click(function(){
    $.ajax({
    	type: "GET",
    	url: "query3",
    	cache: false,
    	datatype: 'html',
    	success: function(data){
    		$("#contents3").append(data);
    		$.ajax({
    			type: "GET",
    			url: "../../static/js/jquery.flexslider.js",
    			datatype: "script"
    		});
    		$.ajax({
    			type: "GET",
    			url: "../../static/js/x.js",
    			datatype: "script"
    		});
    		 $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 210,
    itemHeight: 5,
    itemMargin: 5,
    asNavFor: '#slider'
  });

  $('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    itemWidth:  ($(window).width()/1), // calculate slide width based on window, divide by 3 to show 3
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
  });
    	},
    	error: function(){
    		alert("error");
    	}
    })
  });
});
</script>
</head>
<body>
<div id="contents3"></div>
<button id="imp">hi</button>
<script defer src="../../static/js/jquery.flexslider.js"></script>
<script src="../../static/js/x.js"></script>

</body>
</html>