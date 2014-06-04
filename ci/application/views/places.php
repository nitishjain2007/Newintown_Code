<!DOCTYPE html>
<html>
<body>
<h1>This is for the test and the test is succesfull</h1>
<?php
foreach($locations as $variable){
	echo $variable->gps;
	echo "<br>";
	echo $variable->address;
	echo "<br>";
	echo $variable->rent;
	echo "<br>";
}
?>
</body>
</html>