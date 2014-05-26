<!DOCTYPE html>
<html>
<head>
<style>
#body{
	margin-left:auto;
    margin-right:auto;
    height:auto; 
    width:auto;
}
#header{
	margin-top: -0.7%;
	background-color: black;
	margin-left: -0.7%;
	padding-top: 0px;
	width: 101.4%;
	position: fixed;
}
#holograph{
	height: 20%;
	width: 35%;
	background-color: rgba(0,0,0,0.3);
	border-radius:15px;
	margin-left: 32%;
}
#container{
	background-image: url(../../images/image.jpg);
	margin-left:-0.7%;
	width: 101.4%;
	height:900px;
	overflow:auto;
}
#content1{
	margin-top: 15%;
}
#footer{
	background-color: black;
	width: 101.4%;
	margin-left:-0.7%;
	margin-top: -1.4%;
	margin-bottom: -1.4%;
}
</style>
</head>
<body>
<div id="header">
<img src="../../images/newintown_in.png" height="75px" width="400px">
</div>
<div id="container">
<div id="content1">
<font size="6" color="white"><p style="text-align:center;">Introducing <font color="red">Easy & Convinient </font>House Hunting</p></font>
</div>
<div id="holograph">
<h1>This space is meant for carausel</h1>
</div>
<form method="post" name="contact" action="two">
sector: <input type="text" name="sector" placeholder="sector"><br>
<input type="submit" value="submit">
</form>
</div>
<div id="footer">
<! this represents example for retrieving data from controller ie year!>
<p style="text-align:center;"><font size="4" color="white">Copyright &copy Newintown.in </font></p>
</div>
</body>