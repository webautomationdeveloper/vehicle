<?php include('header.php'); 
     
?>
   <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row">
          </div>
        </div>
      </div>
    </div>
    
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row justify-content-center">
        <div class=" col ">
          <div class="card">
            <div class="card-header bg-transparent">
              <h3 class="mb-0">All Vehicles</h3>
            </div>
             <!-- Button Employe Register modal -->
          
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register_user">Add New Vehicle</button>
           
            </div>
            <div class="card-body">

            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search this blog">
                <div class="input-group-append">
                <button class="btn btn-secondary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Vehicle No</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Vehicle Name By </th>
                    <th>View</th>                   
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
              <?php
              
                
                  $sql = "SELECT vehicle_info.id, vehicle_info.vehicle_no, customers.name, vehicle_type.vehicle_name FROM vehicle_info JOIN customers ON  vehicle_info.customer_id = customers.id JOIN vehicle_type ON vehicle_info.vehicle_type_id = vehicle_type.id";
                  
                  $query1 = $conn->query($sql);
                    
                    if($query1->num_rows>0){
                      while($row = $query1->fetch_assoc()){
?>
                  <tr>
                      <td><?php echo $row['id'] ?></td>
                      <td><?php echo $row['vehicle_no']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['vehicle_name']; ?></td>
                      <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">View</button>
                      </td>
                      <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit">Edit</button>
                      </td>

                      <td>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">Delete</button>
                      </td>
                  </tr>
           <?php 
                      }
                    }else{
                      echo 'data not found';
                    }
          

              ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>



<div class="modal fade bd-example-modal-lg" id="register_user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">   
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Find Customers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="helper.php">
        <div class="modal-body">
          <div>
            <p style="margin-bottom:-31px;font-weight: bold;">Customer</p>
          </div>
          <div style="margin-left: 50%; margin-bottom: -25px;">   
            <div class="input-group">
              <div class="form-outline">
                <input type="search" name="" class="form-control" placeholder="Search Customer" id="search_name_vehicle_add">
              </div>
            </div>
          </div><hr>
          <table class="table v_customer_details">
          </table>
          <table class="table vehicle_customer_details" style="display:none;">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>State</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id="cus_name"></td>
                <td id="cus_email"></td>
                <td id="cus_phone"></td>
                <td id="cus_state"></td>
              </tr>
            </tbody>
          </table>
          
          <input type="text" name="cus_id" value="" id="cus_id">

            <div>
              <p style="margin-bottom:-31px;font-weight: bold;">Vehicle</p><hr>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="vehicle">Vehicle</label>
                  <select class="form-control" id="vehicle" name="vehiclea">
                  <?php 
                    $sql = "SELECT * FROM vehicle_type";
                    $query = $conn->query($sql);
                      
                    if($query->num_rows > 0){
                      while($row = $query->fetch_assoc()){
                    ?>
                      <option value="<?php echo $row['id']; ?>"><?php echo $row['vehicle_name']; ?></option><?php }}else{echo 'else';}?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="vno">Vehicle Number</label>
                  <input type="text" class="form-control" name="vehicle_no" id="vno">
                </div>
              </div>
            </div>  
          </div>
          <div class="modal-footer">
            <button type="submit" name="vehicle" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </from>
      </div>
    </div>
  </div>

    <?php include('footer.php'); ?>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#search_name_vehicle_add').keyup(function(){
          var c_name = ($(this).val());

          $.ajax({
            url     :'helper.php',
            type    :'POST',
            data    :{c_name:c_name},
            success :function(data){
              $('.v_customer_details').html(data);
            }
          });
          if($('#search_name_vehicle_add').val() ==''){
            $('.v_customer_details').show();
          }
        });
      });

      function setCustomerDetails_v(id){
        
        cdetail = (document.getElementById(("tdv"+id).toString()).innerText).split("|");
        //console.log(cdetail[9]);  
        $("#cus_id").val(id);
        $("#cus_name").text(cdetail[0]);
        $("#cus_email").text(cdetail[1]);
        $("#cus_phone").text(cdetail[2]);
        $("#cus_state").text(cdetail[3]);
        $('.vehicle_customer_details').show();
        $('.v_customer_details').hide();
      }

    </script>