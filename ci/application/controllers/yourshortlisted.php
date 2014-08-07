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
</script>
</head>
<body>
<div id="header" style="height:65px;">
<img src="../../static/images/newintown_in.png" height="55px" width="400px">
</div>
<div id="container1">
<div id="content1">
<div id="div2">
HELLO
<img style="display:block;margin-left:auto;margin-right:auto;height:150px;width:150px;margin-top:50%;" src="../../static/images/loader.gif">
</div>
</div>
</div>
<script>
function ajaxhider(){
	$('#div2').hide();
}
//window.onload = ajaxhider();
</script>
</body>
</html>