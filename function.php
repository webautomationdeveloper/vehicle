<?php 
	session_start();
	include('helper.php');

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sel = "SELECT * FROM office_record WHERE email = '$username' AND password = '$password'";
		$result = $conn->query($sel);

		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				if($row['role_id'] == 1){
					$_SESSION['admin_id'] = $row['id'];
					header('location:admin/index.php');
				}elseif($row['role_id']==2){
					$_SESSION['emp_id'] = $row['id'];
					header('location:employee/index.php');
				}
			}
		}else{
			echo 'Server Problem';
		}
	}




/*
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$abc->getdata($username, $password);
		
		$sel = "SELECT * FROM office_record WHERE email = '$user' AND password = '$password'";
		$result = $conn->query($sel);
		
		if($result->num_rows>0){
			while($row = $result->fetch_assoc()){
				if($row['role_id'] == 1){
					$_SESSION['admin_id'] = $row['name'];
					header('location:admin/index.php');
				}elseif($row['role_id']==2){
					header('location:employee/index.php');
				}
			}
		}else{
			echo 'Server Problem';
		}
	}
*/

?>