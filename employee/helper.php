<?php 
	session_start();
	include('../helper.php');



	//==================New Customer Register=======================
		if(isset($_POST['customer_register'])){

			$name = $_POST['name'];
			$email = $_POST['email'];
			$phon = $_POST['phon'];
			$address = $_POST['address'];
			$city = $_POST['city'];
			$district = $_POST['district'];
			$state = $_POST['state'];
			$country = $_POST['country'];
			$zip = $_POST['zip'];
			$date = date('Y-m-d');
		
			$sql = "INSERT INTO customers(name, email, phon, address, city, district, state, country, zip, join_date) VALUES ('$name', '$email', '$phon', '$address', '$city', '$district', '$state', '$country', $zip, '$date')";
			$query = $conn->query($sql);
			if($conn->affected_rows){
				header('location:customers.php');
			}
		
		}

//==========================Add New Vehicle (Vehicle Page)============================

	if(isset($_POST['vehicle'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phon = $_POST['phon'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$district = $_POST['district'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$zip = $_POST['zip'];
		$date = date('Y-m-d');
		$vehicle = $_POST['vehiclea'];
		$vehicle_no = $_POST['vehicle_no'];
	
		$sql = "INSERT INTO customers(name, email, phon, address, city, district, state, country, zip, join_date) VALUES ('$name', '$email', '$phon', '$address', '$city', '$district', '$state', '$country', $zip, '$date')";
		if($conn->query($sql)){
			$last = $conn->insert_id;

			$salv = "INSERT INTO vehicle_info(customer_id, vehicle_type_id, vehicle_no) VALUES ($last, $vehicle, '$vehicle_no')";

			$queryv = $conn->query($salv);
			if($conn->affected_rows){
				header('location:vehicle.php');
			}
		}		
	}

	//============================= ----Work Order (Index page)---- ===========================


	if(isset($_POST['work_order'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phon = $_POST['phon'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$district = $_POST['district'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$zip = $_POST['zip'];
		$date = date('Y-m-d');
		$vehicle = $_POST['vehiclew'];
		$vehicle_no = $_POST['vehicle_number'];
		
	
		$sql = "INSERT INTO customers(name, email, phon, address, city, district, state, country, zip, join_date) VALUES ('$name', '$email', '$phon', '$address', '$city', '$district', '$state', '$country', $zip, '$date')";
		
		if($conn->query($sql)){
			$last = $conn->insert_id;

			$salv = "INSERT INTO vehicle_info(customer_id, vehicle_type_id, vehicle_no) VALUES ($last, $vehicle, '$vehicle_no')";

			if($conn->query($salv)){
				$vehicle_info_id = mysqli_insert_id($conn);
				$emp_id = $_SESSION['emp_id'];
				$start_date = $_POST['start_date'];
				$amount = $_POST['amount'];
				$comunt = $_POST['any_comment'];
				$work = (explode("|",$_POST['work']));;
				$setdate = $_POST['setdate'];

				$sqla = "INSERT INTO work_orders(customers_id, vehicle_info_id, work_type_id, emp_id, start_date, amount, any_comment, updated_date, end_date) VALUES($last, $vehicle_info_id, $work[0], $emp_id, '$start_date',$amount, '$comunt', '$date','$setdate')";
			
				$conn->query($sqla);
				header('location:index.php');
			}
		}
	}
		
	
//======================Find Edit Customers By Ajax=========================
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT * FROM customers WHERE id = $id";
		$query = $conn->query($sql);
		if($query->num_rows>0){
			
			while($row = $query->fetch_assoc()){
		?>
						
							<tr>
								<td>Name</td>
								<td>
									<input type="text" class="form-control" name="name" value='<?php echo $row["name"];?>'> 
								</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>
									<input type="text" class="form-control" name="email" value='<?php echo $row["email"] ?>'> 
								</td>
							</tr>
							<tr>
								<td>Phon</td>
								<td>
									<input type="text" class="form-control" name="phon" value='<?php echo $row["phon"]?>'> 
								</td>
							</tr>
							<tr>
								<td>City</td>
								<td>
									<input type="text" class="form-control" name="city" value='<?php echo $row["city"]?>'> 
								</td>
							</tr>
							<tr>
								<td>District</td>
								<td>
									<input type="text" class="form-control" name="district" value='<?php echo $row["district"]?>'> 
								</td>
							</tr>
							<tr>
								<td>State</td>
								<td>
									<input type="text" class="form-control" name="state" value='<?php echo $row["state"]?>'> 
								</td>
							</tr>
							<tr>
								<td>Country</td>
								<td>
									<input type="text" class="form-control" name="country" value='<?php echo $row["country"]?>'> 
								</td>
							</tr>
							<tr>
								<td>Zip</td>
								<td>
									<input type="text" class="form-control" name="zip" value='<?php echo $row["zip"]?>'> 
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="hidden" name="update_id" hidden id="customer_edit_id" value="<?php echo $row['id']; ?>">
									
									<button type="submit" id="customer_edit_button" class="btn btn-primary">Update</button>	
								</td>
							</tr>
							
		<?php					
			}
			
		}else{
			echo 'not find';
		}
	}

	//===========================Update Customer By Ajax==========================





?>