<?php
  session_start();
 include('header.php'); 

 $due_days = 0;
 $work_type = number_format($_GET['wtype']);
 if(isset($_GET['days'])){
  $due_days = number_format($_GET['days']);
 }
 $due_date = date('Y-m-d', strtotime($due_days.' days'));

?>
   <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
         
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
               
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row justify-content-center">
        <div class=" col ">
          <div class="card">
           
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
                    <th >Name</th>
                    <th >Email</th>
                    <th >Vehicle</th>
                    <th >Vehicle No</th>
                    <th >Work </th>
                    <th >Start Date</th>
                    <th >End Date</th>
                    <th colspan="3">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

 //==================Vehicle Type ============================
    $vehicle = "SELECT * from vehicle_type";
    $query_vehicle =dictonary( $conn->query($vehicle));
    
    //print_r($query_vehicle);
    
    function dictonary($response){
      $result = array();
      foreach ($response as $row)
    {
      $id = $row['id'];
      unset($row['id']);
      $result[$id] = $row['vehicle_name'];
      }
      return $result;
      }

                    $sql = "SELECT work_orders.start_date, work_orders.end_date, customers.name, customers.email, vehicle_info.vehicle_no, vehicle_info.vehicle_type_id, work_type.work_name  FROM work_orders JOIN customers ON work_orders.customers_id = customers.id JOIN vehicle_info ON work_orders.vehicle_info_id = vehicle_info.id JOIN work_type ON work_orders.work_type_id = work_type.id WHERE work_type.id = '$work_type' AND work_orders.end_date = '$due_date'";
                    $query = $conn->query($sql);
                    if($query->num_rows>0){
                      while($row = $query->fetch_assoc()){
                        ?>
                          <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $query_vehicle[$row['vehicle_type_id']]; ?></td>
                            <td><?php echo $row['vehicle_no']; ?></td>
                            <td><?php echo $row['work_name']; ?></td>
                            <td><?php echo $row['start_date']; ?></td>
                            <td><?php echo $row['end_date']; ?></td>
                            <td><button class="btn btn-primary">VIew</button></td>
                            <td><button class="btn btn-danger">Close</button></td>
                            <td><button class="btn btn-success">Archive</button></td>
                          </tr>
                        <?php 
                      }
                    }

                  ?>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


<!---Add New Work Item Modal -->
<div class="modal fade bd-example-modal-lg" id="add_new_work_item" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Work Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>      
        <form method="POST" action="helper.php">
          <div class="modal-body">
            <div>
              <p style="margin-bottom:-31px;font-weight: bold;">Customer</p><hr>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="c_name">Costmer Name</label>
                  <input type="text" class="form-control" name="name" id="c_name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="number" class="form-control" name="phon" id="phone">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" name="address" id="address">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" class="form-control" name="city" id="city">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="distic">Distic</label>
                  <input type="text" class="form-control" name="district" id="district">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="state">State</label>
                  <input type="text" class="form-control" name="state" id="state">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <input type="text" class="form-control" name="country" id="country">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="zip">Zip Code</label>
                  <input type="number" class="form-control" name="zip" id="zip">
                </div>
              </div>
            </div>
            <div>
              <p style="margin-bottom:-31px;font-weight: bold;">Vehicle</p><hr>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="vehicle">Vehicle</label>
                  <select class="form-control" id="vehicle" name="vehiclew">

                  <?php 
                    class vehicle extends database{
                      function sel(){
                        $sql = "SELECT * FROM vehicle_type";
                        $query = $this->connect()->query($sql);
                        if($query->num_rows > 0){
                          while($row = $query->fetch_assoc()){
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['vehicle_name']; ?></option><?php 
                          }
                        }else{
                          echo 'else';
                        }
                      }
                    }
                    $sel = new vehicle();
                    $sel->sel();
                  ?>
                  </select>
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="vn">Vehicle Number</label>
                  <input type="text" class="form-control" name="vehicle_number" id="vn">
                </div>
              </div>
            </div>
            <div>
              <p style="margin-bottom:-31px;font-weight: bold;">Work</p><hr>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="work">Work</label>
                  <select class="form-control" id="work" name="work">
            <?php 
                    $sql = "SELECT * FROM work_type";
                      $query = $conn->query($sql);
                      if($query->num_rows > 0){
                        while($row = $query->fetch_assoc()){
                          ?>
                            <option value="<?php echo $row['id'],"|", $row['count'],"|", $row['format']; ?>">
                                        <?php echo $row['work_name'], $row['count'];
                                        ?> days</option>
                              <script>
                                let count ="<?php echo $row['count'];?>";
                              </script>
                          <?php 
                        }
                      }else{
                        echo 'else';
                      }
                  ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="sdate">Start Date</label>
                  <input type="date" class="form-control" name="start_date" id="sdate" value="<?php date('Y-m-d'); ?>">
                  <script>
                    Date.prototype.addDays = function(days) {
                        var date = new Date(this.valueOf());
                        date.setDate(date.getDate() + days);
                        return date;
                    }
                    Date.prototype.addMonths = function(days) {
                        var date = new Date(this.valueOf());
                        date.setMonth(date.getMonth() + days);
                        return date;
                    }

                    Date.prototype.addYear = function(days) {
                        var date = new Date(this.valueOf());
                        date.setFullYear(date.getFullYear() + days);
                        return date;
                    }

                    $('#sdate').change(function(){
                      let date = $('#sdate').val();
                      // $("#setdate").append(date);
                      let workVal = ($("#work").val());
                      workVal = workVal.split("|");
            
                        
                      switch(workVal[2]){
                        case "0":
                        var date1 = new Date(date);
                        date1 = (date1.addDays(parseInt(workVal[1]))).addDays(-1);                       
                        break;
                        case "1":
                        var date1 = new Date(date);
                        date1 = (date1.addMonths(parseInt(workVal[1]))).addDays(-1); 
                        break;
                        case "2":
                        var date1 = new Date(date);
                        date1=date1.addYear(parseInt(workVal[1])).addDays(-1);
                        alert(date1.addYear(parseInt(workVal[1]))); 
                        break;
                      }
                       let newDate = date1.toISOString().split('T')[0];
                 //     // $("#setdate").innerHTML("");
                       //$("#setdate").append(newDate);
                       $("#setdatea").val(newDate);
                      

                    })
                  </script>
                 
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="setdatea">Expiry</label>
                 <input type="date" class="form-control" id="setdatea" value="" name="setdatea">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input type="number" class="form-control" name="amount" id="amount">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cmt">Comment</label>
                   <input type="text" class="form-control" name="any_comment" id="cmt">
                </div>
              </div>
            </div> 
          </div>     
          <div class="modal-footer">
            <button type="submit" name="work_order" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>

    <?php include('footer.php'); ?>