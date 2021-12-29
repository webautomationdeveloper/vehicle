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
              <h3 class="mb-0">All Users</h3>
            </div>
             <!-- Button Employe Register modal -->
          
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register_customer">Register New User</button>
            <!-- Large modal -->
           
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
                    <th scope="col">Address</th>
                    <th scope="col">City</th>
                    <th scope="col">District</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
              <?php
               
                    $sql = "SELECT * FROM customers ORDER BY id DESC";
                    $query1 = $conn->query($sql);
                    
                    if($query1->num_rows>0){
                      while($row = $query1->fetch_assoc()){
?>
                      <tr>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['phon']; ?></td>
                      <td><?php echo $row['address']; ?></td>
                      <td><?php echo $row['city']; ?></td>
                      <td><?php echo $row['district']; ?></td>
                      <td>
                        
                        <button type="button" class="btn btn-primary edit-profile" data-eid="<?php echo $row['id'];?>" id="emp_custmoer_edit">Edit</button>
                      </td>
                      <td>

                        <input type="hidden" name="" value=("<?php echo $row['id']; ?>") id="cus_delete" >
                      
                        <button type="button" onclick="deleteFunction('<?php echo $row['id']; ?>')" class="btn btn-danger delete_modal" id="delete_modal">Delete</button>
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


 <!-------------=====================Delete Custmoer=====================------------->
<div class="modal fade" id="#delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-------------=====================Edit Custmoer=====================------------->
<div class="modal fade bd-example-modal-lg-view" id="view_customer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">   
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">View Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_customer_details">
        <table class="table">
          
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       </div>
    </div>
  </div>
</div>




<!-------------=====================Edit Custmoer=====================------------->
<div class="modal fade bd-example-modal-lg" id="edit_customer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">   
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="customer_fetch">
        <table class="table">
          
        </table>
      </div>
    </div>
  </div>
</div>

<!----------==================New Customers Register==================--------------->
<div class="modal fade bd-example-modal-lg" id="register_customer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">   
    <div class="modal-content">
      <div class="modal-body">
        <form method="POST" action="helper.php">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="c_name">Costmer Name</label>
                  <input type="text" name="name" class="form-control automComplete_Text" name="name" id="name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">Email</label>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                  <input type="email" class="form-control" name="email" id="email">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="number" class="form-control" id="phone" name="phon">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" id="address" name="address">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" class="form-control" id="city" name="city">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="district">District</label>
                  <input type="text" class="form-control" id="district" name="district">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="state">State</label>
                  <input type="text" class="form-control" id="state" name="state">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <input type="text" class="form-control" id="country" name="country">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="zip">Zip Code</label>
                  <input type="number" class="form-control" id="zip" name="zip">
                </div>
              </div>
             </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" type="submit" name="customer_register">Save</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    <div class="modal fade" id="delete_modal_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2>Are you sure deleted?</h2>
        <form method="POST" action="helper.php">
          <input type="hidden" id="customer_delete_id" name="customer_delete_id" value="">
          <button type="submit" name="customer_delete" class="btn btn-danger">Yes</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        </form>
      </div>
     
      </div>
    </div>
  </div>
</div>




    <?php include('footer.php'); ?>


<script type="text/javascript">
   $(document).ready(function(){
      $('.edit-profile').click(function(){
        var ed = $(this).data('eid');
        
        $.ajax({
          url:'./helper.php',
          type:'POST',
          data:{id:ed},
          success:function(data){
            $('#customer_fetch table').html(data);
          }
        });
      $('#edit_customer').modal('show');
      });
    });

   function deleteFunction(id){
    $('#delete_modal_show').modal('show');
    $('#customer_delete_id').val(id);
  //  alert(id);
   }
</script>



