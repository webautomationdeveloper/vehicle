<?php include('header.php'); 
     
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
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">PUC</h5>
                      <span class="h2 font-weight-bold mb-0">350,897</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-active-40"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">All users</h5>
                      <span class="h2 font-weight-bold mb-0">2,356</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-chart-pie-35"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">License</h5>
                      <span class="h2 font-weight-bold mb-0">924</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-money-coins"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Pollution</h5>
                      <span class="h2 font-weight-bold mb-0">49,65%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                        <i class="ni ni-chart-bar-32"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
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
            <div class="card-header bg-transparent">
              <h3 class="mb-0">All Users</h3>
            </div>
             <!-- Button Employe Register modal -->
            <a  type="button" class="btn btn-primary" href="adwork.php" >Add New Work Item</a>

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
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Add Work</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
              <?php
                class select extends database{
                  function sel(){
                    $sql = "SELECT * FROM user ORDER BY id DESC";
                    $query1 = $this->connect()->query($sql);
                    
                    if($query1->num_rows>0){
                      while($row = $query1->fetch_assoc()){
?>
                  <tr>
                      <td><?php echo $row['fname'] .' ' .$row['lname']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['phon']; ?></td>
                      <td>
                        <form method="POST" action="adwork.php">
                          <button class="btn btn-btn-transparent" type="submit" name="adwork" >Add Work</button>
                          <input type="hidden" name="adwork_id" value="<?php echo $row['id']; ?>">
                        </form>
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
                  }
                }

                $sel = new select();
                $sel->sel();

              ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>

<!--Employee Register Modal -->
<div class="modal fade" id="register_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Register User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>      
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control"  placeholder="Name" name="search_text" id="search_text">
            </div>
          </div>

          <?php 
            class user_fetch extends database{
              function fetch($name){
                $sql = "SELECT * FROM user WHERE fname LIKE  '%".$name."%'";
                $query = $this->connect()->query($sql);
                if($query->num_rows>0){
                  while($row = $query->fetch_assoc()){
                  ?>
                    <div class="col-md-6">
                      <div class="form-group">
                        <p><?php echo $row['fname']; ?></p>
                      </div>
                    </div>
                  <?php 
                  }
                }
              }
            }

            $user_fetch = new user_fetch();

            if(isset($_POST['search'])){
              $name = $_POST['search'];
              $user_fetch->fetch($name);
            }

          ?>





        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



    <?php include('footer.php'); ?>