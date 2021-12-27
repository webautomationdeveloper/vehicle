<?php include('header.php'); ?>


    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              
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
            <div class="card-header bg-transparent">
              <h3 class="mb-0">Vehicle Type</h3>
            </div>

             <!-- Button Employe Register modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register_vehicle">Register New Vehicle</button>
            <div class="card-body">
               <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><h3>Vehicle Type</h3></th>
                    <th><h3>Edit</h3></th>
                    <th><h3>Delete</h3></th>
                  </tr>
                </thead>
                <tbody>
  <?php
    class select extends database{
      function sel(){
        $sql = "SELECT * FROM vehicle_type ORDER BY id DESC";
        $query1 = $this->connect()->query($sql);
                    
          if($query1->num_rows>0){
            while($row = $query1->fetch_assoc()){
?>
                  <tr>
                    <td><?php echo $row['vehicle_name']; ?></td>
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
                  }
                }

                $sel = new select();
                $sel->sel();

              ?>

                   </tr>
                 </tbody>
               </table>
            </div>
          </div>
        </div>
      </div>
      
    <?php include('footer.php'); ?>

<!--Employee Register Modal -->
<div class="modal fade" id="register_vehicle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Vehicle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form method="post" action="helper.php">
          <label for="vehicle">Update Vehicle</label>
          <input id="vehicle" class="form-control" type="text" name="vehicle">
          <button type="submit" name="vehicle_register" class="btn btn-neutral">Submit</button>
        </form>
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!--Vehicle Register Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Vehicle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <form method="post" action="helper.php">
        <label for="vehicle">Update Vehicle</label>
        <input id="vehicle" class="form-control" type="text" name="vehicle">
        <button type="submit" name="vehicle_register" class="btn btn-neutral">Submit</button>
      </form>
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!--Vehicle Delete Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Vehicle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form method="post" action="helper.php">
          <label for="vehicle">Delete Vehicle</label>
          <input placeholder="delete" id="vehicle" class="form-control" type="text" name="vehicle">
          <button type="submit" name="vehicle_register" class="btn btn-neutral">Submit</button>
        </form>
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
