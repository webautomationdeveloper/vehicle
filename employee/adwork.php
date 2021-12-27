<?php include('header.php'); 
     
?>
   <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
         
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
             <!-- Search form -->
            <form class="form-inline active-cyan-4">
              Name <input class="form-control " id="search_text" type="text" placeholder="Search" aria-label="Search" autocomplete="off">

              Mobile No <input class="form-control" id="search_text" type="text" placeholder="Search" aria-label="Search" autocomplete="off">  

              Name <input class="form-control " id="search_text" type="text" placeholder="Search" aria-label="Search" autocomplete="off">

              Mobile No <input class="form-control" id="search_text" type="text" placeholder="Search" aria-label="Search" autocomplete="off">   

              <i class="fas fa-search" aria-hidden="true"></i>
            </form >   
            <div class="card-body">
              <div id="result">
                
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    <?php include('footer.php'); ?>