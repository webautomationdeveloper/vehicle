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
		$customer_id = $_POST['cus_id'];
		$date = date('Y-m-d');
		$vehicle = $_POST['vehiclea'];
		$vehicle_no = $_POST['vehicle_no'];

		$salv = "INSERT INTO vehicle_info(customer_id, vehicle_type_id, vehicle_no) VALUES ($customer_id, $vehicle, '$vehicle_no')";
		$queryv = $conn->query($salv);
			if($conn->affected_rows){
				header('location:vehicle.php');
			}				
	}

	//============================= ----Work Order (Index page)---- ===========================

	if(isset($_POST['work_order'])){
		$customer_id = $_POST['c_id'];
		$vehicle_id = $_POST['v_id'];
		$work = (explode("|",$_POST['work']));;
		$emp_id = $_SESSION['emp_id'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['update_date'];
		$updated_date = date('Y-m-d');

		$due_date=date('Y-m-d', strtotime( -$work[3].' day', strtotime($end_date)));

		$sqla = "INSERT INTO work_orders(customers_id, vehicle_info_id, work_type_id, emp_id, start_date, end_date, updated_date,amount) 
								  VALUES($customer_id, $vehicle_id, $work[0], $emp_id, '$start_date', '$end_date','$updated_date','$due_date')";

			$conn->query($sqla);
			header('location:index.php');
	}


		/*if(isset($_POST['work_order'])){
			$customer_id = $_POST['c_id'];
			$vehicle_id = $_POST['v_id'];
			$update_date = date('Y-m-d');
			$emp_id = $_SESSION['emp_id'];
			$start_date = $_POST['start_date'];
		//	$amount = $_POST['amount'];
		//	$comunt = $_POST['any_comment'];
			$work = (explode("|",$_POST['work']));;
			$setdate = $_POST['setdate'];

			$sqla = "INSERT INTO work_orders(customers_id, vehicle_info_id, work_type_id, emp_id, start_date,  updated_date, end_date) VALUES($customer_id, $vehicle_id, $work[0], $emp_id, '$start_date', '$update_date','$setdate')";
		
			$conn->query($sqla);
			header('location:index.php');
				}
			}
		}*/

//======================Show Exsits Customer Details=========================
if(isset($_POST['name'])){
	$name = trim($_POST['name']);
	
	$exsits = "SELECT *, 
				vehicle_info.vehicle_no, 
				vehicle_info.customer_id,
				vehicle_info.id AS vehicle_id, 
				vehicle_info.vehicle_type_id 
				FROM customers 
				JOIN vehicle_info ON customers.id =  vehicle_info.customer_id 
				WHERE (customers.name = '$name' OR vehicle_info.vehicle_no = '$name') AND vehicle_info.vehicle_no != ''";
	$query2 = $conn->query($exsits);
	if($query2->num_rows>0){
		?>
			</tbody>
			
		<?php
		while($row = $query2->fetch_assoc()){
			?>
			<tr>
				<td>
					<?php echo $row["vehicle_id"];?>, 
					<?php echo $row["customer_id"];?>,
					<?php echo $row["name"];?>,
					<?php echo $row["email"];?>,
					<?php echo $row["phon"];?>,
					<?php echo $row["address"];?>,
					<?php echo $row["city"];?>,
					<?php echo $row["state"];?>,
					<?php echo $row['vehicle_no'];?>

					<span id="td<?php echo $row['id']; ?>" style="display: none;"><?php echo $row["name"];?>|<?php echo $row["email"] ?>|<?php echo $row["phon"]?>|<?php echo $row['address']; ?>|<?php echo $row['city']; ?>|<?php echo $row['district']; ?>|<?php echo $row['state']; ?>|<?php echo $row['country']; ?>|<?php echo $row['zip']; ?>|<?php echo $row['vehicle_no']; ?>|<?php echo $row['vehicle_id']; ?>|<?php echo $row['id']; ?>|<?php echo $row['customer_id']; ?></span>
				</td>
				<td>	
					<span class="btn btn-primary" onclick="setCustomerDetails(
					<?php echo $row['id']; ?>)">SELECT</span> 	
				</td>
			</tr>
<?php
		}
	}
}		
/*---====================For Vehicle Page Customer detalis===============---*/

	if(isset($_POST['c_name']) AND !empty($_POST['c_name'])){
		$name = trim($_POST['c_name']);
		$sqc_name = "SELECT * FROM customers WHERE name LIKE '%$name%' OR email LIKE '%$name%'";
		$query3 = $conn->query($sqc_name);

		if($query3->num_rows>0){
			while($rowa = $query3->fetch_assoc()){
			?>
				<tr>
					<td>
						<?php echo $rowa["name"];?>, 
						<?php echo $rowa["email"];?>,
						<?php echo $rowa["phon"];?>,
						<?php echo $rowa['state']; ?>

						<span id="tdv<?php echo $rowa['id']; ?>" style="display: none;"><?php echo $rowa["name"];?>|<?php echo $rowa["email"] ?>|<?php echo $rowa["phon"]?>|<?php echo $rowa["state"];?>|</span>
					</td>
					<td>
						<span class="btn btn-primary" onclick="setCustomerDetails_v(<?php echo $rowa['id'];?>)">Select</span>
					</td>
				</tr>
				<?php 
			}
		}else{
			echo 'data not found';
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

									<input type="text" class="form-control ce_name" name="name" value='<?php echo $row["name"];?>'> 
								</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>
									<input type="text" class="form-control ce_email" name="email" value='<?php echo $row["email"] ?>'> 
								</td>
							</tr>
							<tr>
								<td>Phon</td>
								<td>
									<input type="text" class="form-control ce_phon" name="phon" value='<?php echo $row["phon"]?>'> 
								</td>
							</tr>
							<tr>
								<td>Address</td>
								<td>
									<input type="text" name="address" class="form-control ce_address" value="<?php echo $row['address']; ?>">
								</td>
							</tr>
							<tr>
								<td>City</td>
								<td>
									<input type="text" class="form-control ce_city" name="city" value='<?php echo $row["city"]?>'> 
								</td>
							</tr>
							<tr>
								<td>District</td>
								<td>
									<input type="text" class="form-control ce_district" name="district" value='<?php echo $row["district"]?>'> 
								</td>
							</tr>
							<tr>
								<td>State</td>
								<td>
									<input type="text" class="form-control ce_state" name="state" value='<?php echo $row["state"]?>'> 
								</td>
							</tr>
							<tr>
								<td>Zip</td>
								<td>
									<input type="text" class="form-control ce_zip_update" name="zip" value='<?php echo $row["zip"]?>'> 
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="hidden" name="update_id" id="customer_edit_id" value="<?php echo $row['id']; ?>">
									
									<button type="button" data-uid="<?php echo $row['id']; ?>" id="customer_edit_button_sdfsfsdfsdf" class="btn btn-primary customer_edit_button">Update</button>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    

<!-- ====================Edit Customer Script ===================== -->
	<script type="text/javascript">
		$('#customer_edit_button_sdfsfsdfsdf').click(function(){
			var name = ($('.ce_name').val());
			var email = ($('.ce_email').val());
			var phon = ($('.ce_phon').val());
			var address = ($('.ce_address').val());
			var city = ($('.ce_city').val());
			var district = ($('.ce_district').val());
        	var state = ($('.ce_state').val());
        	var zip = ($('.ce_zip_update').val());
        	var id = ($('#customer_edit_id').val());
      	
        	$.ajax({
        		url 	: 'helper.php',
        		type 	: 'POST',
        		data 	:{updateid:id, name:name, email:email, phon:phon, address:address, city:city, district:district, state:state, zip:zip},
        		success:function(data){
        			$('#emp_custmoer_edit').modal('hide');
        		}
        	});
      	});
	</script>
<!-- ====================End Edit Customer Script ===================== -->
								</td>
							</tr>							
		<?php					
			}
			
		}else{
			echo 'not find';
		}
	}

	//===========================Update Customer By Ajax==========================

	if(isset($_POST['updateid'])){
		$id = $_POST['updateid'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phon = $_POST['phon'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$district = $_POST['district'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $customer_update = "UPDATE customers SET name = '$name', email = '$email', phon = '$phon', address ='$address', city = '$city', district = '$district', state ='$state', zip=$zip WHERE id = $id";
        $c_update_query = $conn->$customer_update;
	}


?>