<?php 
	include('../helper.php');
	
	if(isset($_POST['register_employee'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phon = $_POST['phone'];
		$password = $_POST['password'];
		$date = date('Y-m-d');
	
		$sql = "INSERT INTO emp_record(name, email, phone, password, join_date) VALUES('$name','$email','$phon','$password','$date')";
		$query= $conn->query($sql);

		if($conn->affected_rows){
			header('location:employee.php');
		}else{
			header('location:employee.php');
		}
	}


	if(isset($_POST['work_register'])){
		$work_name = $_POST['work_name'];
		$days = $_POST['days'];
			
		$sql = "INSERT INTO work_type(work_name, days) VALUES('$work_name','$days')";
		$query= $conn->query($sql);

		if($conn->affected_rows){
			header('location:work.php');
		}else{
			header('location:work.php');
		}

	}

	if(isset($_POST['vehicle_register'])){
		$vehicle = $_POST['vehicle'];
					
		$sql = "INSERT INTO vehicle_type(vehicle_name) VALUES('$vehicle')";
		$query= $conn->query($sql);

		if($conn->affected_rows){
			header('location:vehicle_type.php');
		}else{
			header('location:vehicle_type.php');
		}

	}






?>