<?php include('header.php'); 
    if($_POST['status'] == ('logout')){
        session_unset();
        session_destroy();
    } 
?>
    <div class="row">
        <div class="col-md-offset-5 col-md-4 text-center">            
            <form method="post" action="function.php">
                <div class="form-login"></br>
                    <h4>Login</h4>
                    </br>
                    <input type="text" id="userName" name="username" class="form-control input-sm chat-input" placeholder="username"/>
                    </br>
                    <input type="text" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="password"/></br>
                    <div class="wrapper">
    		            <span class="group-btn">
    		                <button type="submit" name="login" class="btn btn-danger btn-md">login <i class="fa fa-sign-in"></i></button>
    		            </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include('footer.php'); ?>