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
<script src="../../bootstrap/js/popover.js"></script>
<script src="../../bootstrap/js/alert.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<link rel="stylesheet" href="../../static/css/mainpage.css">
<script>
function select(types){
	var clicked = document.getElementById(types);
	if(clicked.className == "notselected"){
		var notclickedid = document.getElementsByClassName('selected')[0].id;
		var notclicked = document.getElementById(notclickedid);
		notclicked.className = "notselected";
		clicked.className = "selected";		
	} 
}
function giveresultdelay(){
	setTimeout("giveresult()",10000);
}
function giveresult(){
	var lng = document.getElementById('cityLng').value;
	var lat = document.getElementById('cityLat').value;
	var type = document.getElementsByClassName('selected')[0].id;
	window.location="http://localhost/ci/index.php/controller1/query?lng="+lng+"&lat="+lat+"&type="+type;
}
function logout(){
	document.getElementById("logoutformmain").submit();
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
function h(){
	alert("hi");
	window.setTimeout(function(){
		document.forms['places'].submit();
	}, 10000);
}
</script>
<script>
window.onload=function(){
	var h = document.getElementById("logoutchecker").innerHTML;
	if(h=="yes"){
		document.getElementById("logoutpopup").click();
	}
}
</script>
</head>
<body>
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


</head>
<body>
<div id="header">
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
<button type="button" id="listpopup" class="btn btn-lg btn-primary" data-container="body" data-toggle="popover" title="List your Property" data-placement="bottom" >
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
<div style="position:absolute;margin-top:2%;" id="listbs">
<div style="float:right;margin-right:2%;" class="bs-example">
    <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        Your records recieved.
    </div>
</div>
</div>
<?php }?>
<?php if($log == "wrong"){ ?>
<div style="position:absolute;margin-top:2%;" id="bs">
<div style="float:right;margin-right:2%;" class="bs-example">
    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        The credentials are not authentic.   
    </div>
</div>
</div>
<?php }?>
<?php if($login == "yes"){ ?>
<div style="position:absolute;margin-top:2%;" id="bs">
<div style="float:right;margin-right:2%;" class="bs-example">
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Login successfull!!</strong>   
    </div>
</div>
</div>
<?php }?>
<?php if($logout == "yes"){ ?>
<div style="position:absolute;margin-top:2%;" id="bs">
<div style="float:right;margin-right:2%;" class="bs-example">
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Logout successfull!!</strong>   
    </div>
</div>
</div>
<?php }?>
</div>
</div>
<div id="container1">
<div id="content1">
<font size="6" color="white"><p style="text-align:center;">Introducing <font color="red">Easy & Convinient </font>House Hunting</p></font>
</div>
<div id="holograph">
<h1>This space is meant for carausel</h1>
</div>
<div class="main">
<div class="selected" id="pg" onclick="select(this.id)">PG</div>
<div class="notselected" id="flat" onclick="select(this.id)">Flat</div>
</div>
<input id="searchTextField" class="form-control" type="text" style="background:rgba(0,0,0,0);color: white;" onKeydown="Javascript:    if(event.keyCode==13)giveresultdelay();"><br>
<input type="hidden" id="city2" name="city2" />
<input type="hidden" id="cityLat" name="cityLat" />
<input type="hidden" id="cityLng" name="cityLng" />  
<button type="submit" onclick="giveresultdelay()">submit</button>
</div>
<div class="container" id="loginform" title="Login">
    <div class="row">
        <div id="loginformdiv" style="margin-left: 10%;margin-right: 10%;">
            <form id="loginformmain" method="post" >
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" size="20"/>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Sign up</button>
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
<div id="logoutform" style="display: none;">
	<form id="logoutformmain" method="post">
	<input type="text" name="logout" value="yes">
	</form>
</div>
<?php if($logout == "yes"){?>
<div id="logoutchecker" style="display:none;">yes</div>
<?php }else{ ?>
<div id="logoutchecker" style="dispaly:none;">no</div>
<?php } ?>
<div id="footer">
<! this represents example for retrieving data from controller ie year!>
<p style="text-align:center;"><font size="4" color="white">Copyright &copy Newintown.in </font></p>
</div>
<script>
$(function () { 
	$("a[data-toggle='popover']").popover();
	$("#loginpopup1").popover({
		html:'true',
		content: function(){
		return $('#logindivpo').html();
	}
	}); 
});
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
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
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


</body>
</html>