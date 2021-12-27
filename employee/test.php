
<?php 
	$conn = new mysqli('localhost', 'root', 'redhat','vehicle');
	$se = "SELECT * from work_order WHERE id = 1";
	$abc = $conn->query($se);
	echo $abc;
?>