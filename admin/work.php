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
              <h3 class="mb-0">Work Type</h3>
            </div>
              <!-- Button Employe Register modal -->
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#register_work">Register New Work Type</button>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"><h3>Work Type</h3></th>
                    <th scope="col"><h3>Validity</h3> </th>
                    <th><h3>Edit</h3></th>
                    <th><h3>Delete</h3></th>
                  </tr>
                </thead>
                <tbody>

  <?php
    class select extends database{
      function sel(){
        $sql = "SELECT * FROM work_type ORDER BY id DESC";
        $query1 = $this->connect()->query($sql);
                    
          if($query1->num_rows>0){
            while($row = $query1->fetch_assoc()){
?>
                   <tr id="<?php echo $row['id']; ?>">                   
                    <td data-target="work_name"><?php echo $row['work_name']; ?></td>
                    <td data-target="days"><?php echo $row['days']; ?>
                    <td>
                      <a href="#" data-role="[update]" data-id="<?php echo $row['id']; ?>" class="btn btn-primary work_edit"> Edit</a>
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger delete_work" data-toggle="modal" >Delete</button>
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
                        
                    </div><br>
                  </div>
                </div>
              </div>
            </div>
          </div>

<!--Work Edit Modal -->
<div class="modal fade" id="edit_work" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Register Work</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
         <form method="post" action="">
          <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Work Name :- </span>
              </div>
              <input class="form-control" id="work_name" placeholder="Work Type" name="name" type="text">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">Validity :- </span>
              </div>
              <input class="form-control" id="work_days" placeholder="Validity" type="text" name="email">
            </div>
          </div>
          <input type="text" name="work_id" id="input">
      </div>
      <div class="modal-footer">
         <a href="#" id="work_save" class="btn btn-success pull-right">Update</a>
        <button type="button" class="btn btn-secondary pull-left " data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!--Work Delete Modal -->
<div class="modal fade" id="delete_work" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Work Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
         <form method="post" action="helper.php">
          <div class="form-group">
            <div class="input-group input-group-merge input-group-alternative mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
              </div>
              <input class="form-control" placeholder="Delete" name="name" type="text">
            </div>
          </div>
          
          <div class="text-center">
            <button type="submit" name="register_employee" class="btn btn-primary mt-4">Work Delete</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


    <!--work Register Modal -->
<div class="modal fade" id="register_work" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Register Work</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" action="helper.php">
          <label for="vehicle">Add New Work Type</label>
          <input id="vehicle" class="form-control" id="work_name" type="text" name="work_name"><br>

          <label for="days">Validity</label>
          <select class='selectpicker'>
            <option selected>Days</option>
            <option >Months</option>
            <option>Yeas</option>
          </select>
          <input  class="form-control" type="text" name="days"><br>
          <button type="submit" name="work_register" class="btn btn-neutral">Submit</button>
        </form>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <?php include('footer.php'); ?>