<!DOCTYPE html>
<html>
<body>
<?php
if($state == 1):
	foreach($second->result() as $d){
		echo $d->address;
		echo "<br>";
		echo $d->type;
		echo "<br>";
		echo $d->sector;
		echo "<br><br>";
	}
else:
	echo $second;
endif;
?>
</body>
</html>