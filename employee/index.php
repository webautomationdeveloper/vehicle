<?php
  session_start();
 include('header.php'); 
  //==================Vehicle Type ============================
    $vehicle = "SELECT * from vehicle_type";
    $query_vehicle =dictonary($conn->query($vehicle));
    
    //print_r($query_vehicle);

    function dictonary($response){
      $result = array();
  
      foreach ($response as $row){  
        $id = $row['id'];
        unset($row['id']);
        $result[$id] = $row['vehicle_name'];
      }
        return $result;
      }

     
?>
   <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
         
          <!-- Card stats -->
          <div class="row">
          <?php 
              $work = "SELECT * from work_type";
              $work_vehicle =($conn->query($work));

          foreach ($work_vehicle  as $row1) {
            $id = $row1['id'];
            $due_date = date('Y-m-d', strtotime('0 days'));
            $orders = "SELECT * from work_orders WHERE work_type_id = '$id' AND work_orders.end_date = '$due_date'";
          $query_vorders = mysqli_num_rows($conn->query($orders));         
  ?>

            <div class="col-xl-2 col-md-4">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">

                      <a target="_blank" href="due_service.php?wtype=<?php echo $id.'&days=0' ?>">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0"><?php echo $row1['work_name']; ?></h5>
                      <span class="h2 font-weight-bold mb-0"><?php echo ($query_vorders); ?></span>
                    </div>
                      </a>
                    
                  </div>
                </div>
              </div>
            </div>
           <?php } ?>
           
           

          </div>
        </div>
      </div>
    </div>
    
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row justify-content-center">
        <div class=" col ">
          <div class="card">
            <button type="button" class="btn btn-transparent" data-toggle="modal" data-target="#add_new_work_item">Add New Work Item</button>
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
                    <th >Edit</th>
                    <th >Close</th>
                    <th >Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 

                    $sql = "SELECT work_orders.start_date, work_orders.end_date, customers.name, customers.email, vehicle_info.vehicle_no, vehicle_info.vehicle_type_id, work_type.work_name FROM work_orders 
                      JOIN customers ON work_orders.customers_id = customers.id 
                      JOIN vehicle_info ON work_orders.vehicle_info_id = vehicle_info.id 
                      JOIN work_type ON work_orders.work_type_id = work_type.id";

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
                            <td><button class="btn btn-primary">Edit</button></td>
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
              <p style="margin-bottom:-31px;font-weight: bold;">Customer / Vehicle</p>

              <div style="margin-left: 50%;">   
                <div class="input-group">
                  <div class="form-outline">
                    <input type="search" name="" class="form-control" placeholder="Search Customer" id="search_name">
                  </div>
                </div>
              </div>
              <hr>
            </div>
           
            <div class="for_exists_customer_show" style="display:none;">
              <table class="exsits_customer table">
                      
              </table>  
            </div>
            <table class="table for_exists_customer_hide" style="display:none;">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Address</th>
                  <th>City</th>
                  <th>Vehicle</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td id="name"></td>
                  <td id="email"></td>
                  <td id="phone"></td>
                  <td id="address"></td>
                  <td id="city"></td>
                  <td id="vehicle_number"></td>
                </tr>
              </tbody>
            </table>
            <div>
              <p style="margin-bottom:-31px;font-weight: bold;">Vehicle</p><hr>
            </div>

            <div class="row" id="vehicle_div">
             <!--  <div class="col-md-6">
                <div class="form-group">
                  <label for="v_id">Vehicle Id</label>
                  <input type="text" class="form-control" name="vehicle_id" id="v_id">
                </div>
              </div> -->
              <div class="col-md-6">
                <div class="form-group">
                  <label for="vn">Vehicle Number</label>
                  <input type="text" class="form-control" name="vehicle_number" id="vehicle_number" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="vehicle">Vehicle</label>
                  <select class="form-control" id="vehicle" name="vehiclew" required>

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
              
            </div>
            <div>
              <p style="margin-bottom:-31px;font-weight: bold;">Work</p><hr>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="work">Work</label>
                  <select class="form-control" id="work" name="work" required>
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
                  <input type="date" class="form-control" name="start_date" id="sdate" value="<?php date('Y-m-d'); ?>" required>
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
                      //  alert(date1.addYear(parseInt(workVal[1]))); 
                        break;
                      }
                        let newDate = date1.toISOString().split('T')[0];
                        // $("#setdate").innerHTML("");
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

<!-- ==============================Modal for exists customer ======================== -->


<script type="text/javascript">
  $(document).ready(function(){
    $('#search_name').keyup(function(){
      var name = $('#search_name').val();
      $('.for_exists_customer_hide').hide();
      $('.for_exists_customer_show').show();

      $.ajax({
        url   :'helper.php',
        type  :'POST',
        data  :{name:name},
        success:function(data){
          $('.exsits_customer').html(data); 
        }
      });
     
     if($('#search_name').val() == ''){
      $('.for_exists_customer_hide').show();
     }
    });
  });


  function setCustomerDetails(id){

    cdetail = (document.getElementById(("td"+id).toString()).innerText).split("|");
 //   console.log(cdetail[9]); 

$datajj = cdetail[10];

    $("#c_id").val(id);
    $("#name").text(cdetail[0]);
    $("#email").text(cdetail[1]);
    $("#phone").text(cdetail[2]);
    $("#address").text(cdetail[3]);
    $("#city").text(cdetail[4]+'/'+cdetail[5]);
    $("#vehicle_number").text(cdetail[9]);
    alert(query_vehicle
      );


    $('.for_exists_customer_hide').show();
    $('.for_exists_customer_show').hide();  

  }

</script>


    <?php include('footer.php'); ?>